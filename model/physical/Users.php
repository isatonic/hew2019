<?php

namespace model\physical;

use PDO;

/**
 * Usersテーブル操作クラス
 *
 * @package model\physical
 */
class Users extends ModelBase {

    public function __construct(PDO $pdo, ?string $user = null) {
        parent::__construct($pdo, $user);
    }

    /**
     * ユーザ登録
     *
     * @param array $data {
     *      "email"     メールアドレス
     *      "firstName" 氏名(名)
     *      "lastName"  氏名(氏)
     *      "birth"     生年月日
     * }
     * @param bool $isAdmin 一般ユーザ => false, 管理者 => true (Default: false)
     *
     * @return bool|string
     */
    public function regist(array $data, bool $isAdmin = false) {
        if ($isAdmin) {
            $prefix = "A";
        } else {
            $prefix = "U";
        }
        $prefix .= substr($data["email"], 0, 1);
        $Data = array(
            "id" => str_replace('.', '-', uniqid($prefix, true)),
            "birth" => $data["birth"],
            "gender" => $data["gender"],
            "firstName" => $data["firstName"],
            "lastName" => $data["lastName"],
            "email" => $data["email"],
            "flag" => "active"
        );
        $esc_data = array();
        foreach ($Data as $key => $val) {
            $esc_data["$key"] = $this->db->quote($val);
        }
        if ($this->execInsert($esc_data)) {
            return $Data["id"];
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
        $where["id"] = $who;

        return $this->execUpdate($data, $where);
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
     * @type string "email"     メールアドレス
     * @type string "flag"      利用状況
     * }
     */
    public function get(string $id = null) {
        $id = $this->setUser($id);
        $wants = array(
            "regDate",
            "birth",
            "firstName",
            "lastName",
            "email",
            "flag"
        );
        $where = array(
            "id" => $id
        );
        $rows = $this->getRows($wants, $where);
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
        $wants = array(
            "flag"
        );
        $where = array(
            "id" => $id
        );
        $rows = $this->getRows($wants, $where);
        if (!is_null($rows) or $rows) {
            return $rows[0]["flag"];
        } else {
            return false;
        }
    }

    public function getIdByMail(string $email) {
        $want = ["id"];
        $where = ["email" => $email];
        $rows = $this->getRows($want, $where);
        return $rows[0]["id"];
    }

}