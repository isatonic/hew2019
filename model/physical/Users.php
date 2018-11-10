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
     *
     * @param string $email
     * @param string $firstName
     * @param string $lastName
     * @param string $birth
     * @param bool   $isAdmin 一般ユーザ => false, 管理者 => true (Default: false)
     *
     * @return bool|string
     */
    public function regist(string $email, string $firstName, string $lastName, string $birth, bool $isAdmin = false) {
        if ($isAdmin) {
            $prefix = "A";
        } else {
            $prefix = "U";
        }
        $prefix .= substr($email, 0, 1);
        $data["id"] = uniqid($prefix, true);
        $data = array(
            "email" => $email,
            "firstName" => $firstName,
            "lastName" => $lastName,
            "birth" => $birth
        );
        if ($this->insert($data)) {
            return $data["id"];
        } else {
            return false;
        }
    }

    /**
     * ユーザ情報変更
     *
     * @param array         $data   ["変更する列名"] = 更新値
     * @param string|null   $who    ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function changeInfo(array $data, string $who = null) {
        $who = $this->setUser($who);
        $where = sprintf("id LIKE %s", $who);
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
     * @param string $who ユーザID
     *
     * @return bool
     */
    public function changeStatus(string $to, string $who) {
        $data['flag'] = $to;
        $res = $this->changeInfo($data, $who);
        return $res;
    }

}