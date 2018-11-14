<?php

namespace model\physical;

/**
 * PassResetテーブル操作クラス
 *
 * @package model\physical
 */
class PassReset extends ModelBase {

    /**
     * パスワードリセット要求を設定
     *
     * @param string $email     メールアドレス
     * @param string $newPass   新しいパスワード
     *
     * @return bool
     */
    public function add(string $email, string $newPass) {
        $data = array(
            "email" => $email,
            "newpass" => $newPass,
            "code" => $this->makeRandStr(4),
            "resetLimit" => $this->setLimit(30)
        );

        return $this->insert($data);
    }

    /**
     * 最新のリセット要求を取得
     *
     * @param string $email メールアドレス
     *
     * @return string[]
     */
    public function get(string $email) {
        $sql = "SELECT code, resetLimit FROM PassReset WHERE email LIKE :email ORDER BY resetLimit DESC";
        $params = array(
            "email" => $email
        );
        $rows = $this->query($sql, $params);
        $ret = array(
            "code" => $rows[0]["code"],
            "limit" => $rows[0]["resetLimit"]
        );

        return $ret;
    }

}