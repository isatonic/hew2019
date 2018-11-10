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

    /**
     * ユーザ情報を取得
     *
     * ユーザが存在しない場合は`false`を返す
     *
     * @param string|null $id ユーザID (Default: ログイン中ID)
     *
     * @return bool|array {
     * @type string "regDate"   登録日時
     * @type string "birth"     生年月日
     * @type string "firstName" 名(本名)
     * @type string "lastName"  氏(本名)
     * @type string "flag"      利用状況
     * }
     */
    public function get(string $id = null) {
        $id = $this->setUser($id);
        $sql = "SELECT regDate, birth, firstName, lastName, flag FROM Users WHERE id LIKE :id";
        $params = array(
            "id" => $id
        );
        $rows = $this->query($sql, $params);
        if (!is_null($rows)) {
            return $rows[0];
        } else {
            return false;
        }
    }

    /**
     * ユーザの利用状況のみ取得
     *
     * ユーザが存在しない場合は`false`を返す
     *
     * @param string|null $id ユーザID (Default: ログイン中ID)
     *
     * @return bool|string
     */
    public function getStatus(string $id = null) {
        $id = $this->setUser($id);
        $sql = "SELECT flag FROM Users WHERE id LIKE :id";
        $params = array(
            "id" => $id
        );
        $rows = $this->query($sql, $params);
        if (!is_null($rows) or $rows) {
            return $rows[0]["flag"];
        } else {
            return false;
        }
    }

}