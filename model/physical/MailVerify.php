<?php

namespace model\physical;

/**
 * MailVerifyテーブル操作クラス
 *
 * @package model\physical
 */
class MailVerify extends ModelBase {

    /**
     * メール認証を追加
     *
     * @param string $email メールアドレス
     *
     * @return bool
     */
    public function add(string $email) {
        $data = array(
            "email" => $email,
            "verifycode" => $this->makeRandStr(4),
            "verifyLimit" => $this->setLimit()
        );

        return $this->insert($data);
    }

    /**
     * fetchCode: コードを取得
     *
     * @param string $email メールアドレス
     *
     * @return array {
     *      @type string "verifycode"   認証コード
     *      @type string "verifyLimit"  認証期限
     * }
     */
    public function fetchCode(string $email) {
        $sql = "SELECT verifycode, verifyLimit FROM MailVerify WHERE email LIKE :email ORDER BY verifyLimit DESC";
        $params = array(
            "email" => $email
        );
        $res = $this->query($sql, $params);

        return $res[0];
    }

}