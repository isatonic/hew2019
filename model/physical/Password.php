<?php

class Password extends ModelBase {

    /**
     * パスワード登録
     *      ユーザ登録時にUsers.registと同トランザクション内で実行
     *
     * @param $user
     * @param $pass
     *
     * @return bool
     */
    public function regist($user, $pass) {
        $data = array(
            "user" => $user,
            "pass" => password_hash($pass, PASSWORD_DEFAULT)
        );
        $res = $this->insert($data);

        return $res;
    }

    /**
     * パスワード照合
     *
     * @param $user
     * @param $pass
     *
     * @return bool
     */
    public function check($user, $pass) {
        $sql = "SELECT pass FROM Password WHERE user LIKE :user";
        $params["user"] = $user;
        $res = $this->query($sql, $params);
        $hash = $res[0]["pass"];

        return password_verify($pass, $hash);
    }

    /**
     * パスワード変更
     *
     * @param $user
     * @param $pass
     *      新しいパスワード
     *
     * @return bool
     */
    public function change($user, $pass) {
        $data = array(
            "pass" => password_hash($pass, PASSWORD_DEFAULT)
        );
        $where = "user LIKE $user";
        $res = $this->update($data, $where);

        return $res;
    }

}