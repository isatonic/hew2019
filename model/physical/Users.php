<?php

namespace model\physical;

/**
 * Usersテーブル操作クラス
 *
 * @package model\physical
 */
class Users extends ModelBase {

    /**
     * ユーザ登録
     *
     * @param mixed[] $data {
     *      @type string "email"
     *      @type string "id"
     *      @type string "userName"
     *      @type string "firstName"
     *      @type string "birth"
     *      @type string "icon"
     * }
     *
     * @return bool
     */
    public function regist(array $data) {
        $data["flag"] = "verifying";
        $res = $this->insert($data);
        return $res;
    }

    /**
     * ユーザ情報変更
     *
     * @param array     $data   ["変更する列名"] = 更新値
     * @param string    $who    メールアドレス
     *
     * @return bool
     */
    public function changeInfo(array $data, string $who) {
        $where = sprintf("email LIKE %s", $who);
        $res = $this->update($data, $where);
        return $res;
    }

    /**
     * 利用状況変更
     *
     * @param string $to
     *      メール認証完了 -> "active"
     *      退会           -> "unsubscribed"
     *      一時利用停止   -> "paused"
     *      BAN            -> "banned"
     *
     * @param string $who メールアドレス
     *
     * @return bool
     */
    public function changeStatus(string $to, string $who) {
        $data['flag'] = $to;
        $res = $this->changeInfo($data, $who);
        return $res;
    }

}