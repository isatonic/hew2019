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
        $this->insertSql($data);
        $this->exec($data);

        return $this->getResult();
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
        $wants = ["verifycode", "verifyLimit"];
        $where = ["email" => $email];
        $order = array("verifyLimit" => "DESC");
        $res = $this->getRows($wants, $where, $order);

        return $res[0];
    }

}