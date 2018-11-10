<?php

namespace model\physical;

/**
 * Loginテーブル操作クラス
 *
 * @package model\physical
 */
class Login extends ModelBase {

    /**
     * パスワード登録
     *
     * ユーザ登録時に同一トランザクション内で
     *      Users.regist()
     *      UserDetails.regist() (一般ユーザの場合)
     *      Login.regist()
     *      MailVerify.add()
     * の順に実行
     *
     * @param string        $pass   パスワード
     * @param string        $email  メールアドレス
     * @param string|null   $id     ユーザID
     *
     * @return bool
     */
    public function regist(string $pass, string $email, string $id = null) {
        $id = $this->setUser($id);
        $data = array(
            "id" => $id,
            "pass" => password_hash($pass, PASSWORD_DEFAULT),
            "email" => $email
        );
        $res = $this->insert($data);

        return $res;
    }

    /**
     * パスワード照合
     *
     * @param string $email メールアドレス
     * @param string $pass  パスワード
     *
     * @return bool
     */
    public function check(string $email, string $pass) {
        $sql = "SELECT pass FROM Login WHERE email LIKE :email";
        $params["email"] = $email;
        $res = $this->query($sql, $params);
        $hash = $res[0]["pass"];

        return password_verify($pass, $hash);
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
        $where = "user LIKE $user";
        $res = $this->update($data, $where);

        return $res;
    }

}