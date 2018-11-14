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
        $wants = ["code", "resetLimit"];
        $where = ["email" => $email];
        $order = ["resetLimit" => "DESC"];
        $this->setSql($wants, $where, $order);
        $this->exec();
        $this->getAssoc();
        $rows = $this->getRows();
        $ret = array(
            "code" => $rows[0]["code"],
            "limit" => $rows[0]["resetLimit"]
        );

        return $ret;
    }

}