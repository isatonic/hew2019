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
     * @param string $who       ユーザのメールアドレス
     * @param string $newPass   新しいパスワード
     *
     * @return bool
     */
    public function add(string $who, string $newPass) {
        $data = array(
            "user" => $who,
            "newpass" => $newPass,
            "code" => $this->makeRandStr(4),
            "resetLimit" => $this->setLimit(30)
        );

        return $this->insert($data);
    }

    /**
     * 最新のリセット要求を取得
     *
     * @param string $who ユーザのメールアドレス
     *
     * @return string[]
     */
    public function get(string $who) {
        $sql = "SELECT newpass, code, resetLimit FROM PassReset WHERE user LIKE :user ORDER BY resetLimit DESC";
        $params = array(
            "user" => $who
        );
        $rows = $this->query($sql, $params);
        $ret = array(
            "newPass" => $rows[0]["newpass"],
            "code" => $rows[0]["code"],
            "limit" => $rows[0]["resetLimit"]
        );

        return $ret;
    }

}