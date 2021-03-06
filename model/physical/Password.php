<?php

namespace model\physical;

/**
 * Passwordテーブル操作クラス
 *
 * パスワード認証は`model\physical\Login`を使う
 *
 * @package model\physical
 */
class Password extends ModelBase {

    /**
     * パスワード登録
     *
     * ユーザ登録時に同一トランザクション内で
     *      Users.regist()
     *      UserDetails.regist() (一般ユーザの場合)
     *      Password.regist()
     *      MailVerify.add()
     * の順に実行
     *
     * @param string      $pass パスワード
     * @param string|null $id ユーザID
     *
     * @return bool
     */
    public function regist(string $pass, string $id = null) {
        $id = $this->setUser($id);
        $data = array(
            "id" => $id,
            "pass" => password_hash($pass, PASSWORD_DEFAULT)
        );

        $esc_data = [];
        foreach ($data as $key => $val) {
            $esc_data[$key] = $this->db->quote($val);
        }
        return $this->execInsert($esc_data);
    }

    /**
     * パスワード変更
     *
     * @param string        $pass 新しいパスワード
     * @param string|null   $user ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function change(string $pass, string $user = null) {
        $user = $this->setUser($user);
        $data = array(
            "pass" => password_hash($pass, PASSWORD_DEFAULT)
        );
        $where["id"] = $user;

        $esc_data = [];
        foreach ($data as $key => $val) {
            $esc_data[$key] = $this->db->quote($val);
        }
//        $esc_where = [];
//        foreach ($where as $key => $val) {
//            $esc_where[$key] = $this->db->quote($val);
//        }
        return $this->execUpdate($esc_data, $where);
    }

}