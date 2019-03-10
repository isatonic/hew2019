<?php

namespace model\physical;

/**
 * UserDetailsテーブル操作クラス
 *
 * @package model\physical
 */
class UserDetails extends ModelBase {

    /**
     * ユーザ登録
     *
     * @param string      $userName アプリ内で公開されるユーザ名
     *
     * @return bool
     */
    public function regist(string $userName) {
        $data = array(
            "id" => $this->user_id,
            "userName" => $userName
        );
        $esc_data = [];
        foreach ($data as $key => $val) {
            $esc_data[$key] = $this->db->quote($val);
        }

        return $this->execInsert($esc_data);
    }

    /**
     * ユーザ情報変更
     *
     * @param array       $data ["変更する列名"] = 変更値
     * @param string|null $id   ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function changeInfo(array $data, string $id = null) {
        $id = $this->setUser($id);
        $where["id"] = $id;

        $esc_data = [];
        foreach ($data as $key => $val) {
            $esc_data[$key] = $this->db->quote($val);
        }
        return $this->execUpdate($esc_data, $where);
    }

    /**
     * ユーザ情報を取得
     *
     * ユーザが存在しない場合は`false`を返す
     *
     * @param string|null $id ユーザID (Default: ログイン中ID)
     *
     * @return string アプリケーション中で公開されるユーザ名
     */
    public function getUserName(string $id = null) {
        $id = $this->setUser($id);
        $wants = ["userName", "icon"];
        $where = ["id" => $id];
        $rows = $this->getRows($wants, $where);
        if (!is_null($rows)) {
            return $rows[0]["userName"];
        } else {
            return false;
        }
    }

}