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
        $wants = ["verifycode", "verifyLimit"];
        $where = ["email" => $email];
        $order = array("verifyLimit" => "DESC");
        $this->setSql($wants, $where, $order);
        $this->exec();
        $this->getAssoc();
        $res = $this->getRows();

        return $res[0];
    }

}