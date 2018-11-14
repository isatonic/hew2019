<?php

namespace model\physical;

use PDO;

interface ModelBaseInterface {
    public function __construct(PDO $pdo, string $user = null);
    // public function setSql(array $want = array("*"), array $where = null, array $order = null);
}

/**
 * DBに関する基本処理をまとめたクラス
 *
 * @package model\physical
 */
abstract class ModelBase implements ModelBaseInterface {

    /** @var PDO $db DB接続用PDO */
    protected $db;
    /** @var string $table_name テーブル名格納用変数 */
    protected $table_name;
    /** @var string $user_id ユーザID */
    protected $user_id;
    protected $sql;
    /** @var \PDOStatement */
    protected $stmt;
    protected $rows;


    /**
     * コンストラクタ: オブジェクト生成時に自動実行
     *
     * @param PDO $pdo
     * @param string|null $user
     */
    public function __construct(PDO $pdo, string $user = null) {
        $this->db = $pdo;
        $this->table_name = get_class($this);

        if ($user != null) {
            $this->user_id = $user;
        }
    }

    protected function setSql(array $want = array("*"), array $where = null, array $order = null) {
        $sql = sprintf("SELECT %s FROM %s", implode(", ", $want), $this->table_name);
        if ($where != null) {
            $sql .= " WHERE ";
            $condition = array();
            foreach ($where as $key => $val) {
                $condition[] = "$key = $val";
            }
            foreach ($condition as $val2) {
                $sql .= implode("and ", $val2);
            }
        }
        if ($order != null) {
            $sql .= " ORDER BY ";
            $set = array();
            foreach ($order as $key3 => $val3) {
                $set[] = "$key3 $val3";
            }
            foreach ($set as $val4) {
                $sql .= implode(", ", $val4);
            }
        }
        $this->sql = $sql;
    }

    /**
     * @param string|null $sql
     *
     * @return void
     */
    protected function exec(string $sql = null) {
        if ($sql == null) {
            $sql = $this->sql;
        }
        $stmt = $this->db->prepare($sql);
        $stmt->execute();

        $this->stmt = $stmt;
    }

    protected function getAssoc() {
        $rows = array();
        while ($row = $this->stmt->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        $this->rows = $rows;
    }

    protected function getRows() {
        return $this->rows;
    }

    /**
     * INSERTを実行
     *
     * @param array $data
     *
     * @return bool
     */
    protected function insert(array $data) {
        $fields = array();
        $values = array();
        foreach ($data as $key => $val) {
            $fields[] = $key;
            $values[] = ':' . $key;
        }
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->table_name,
            implode(',', $fields),
            implode(',', $values)
        );
        $stmt = $this->db->prepare($sql);
        foreach ($data as $key => $val) {
            $stmt->bindValue(':' . $key, $val);
        }
        $res = $stmt->execute();

        return $res;
    }

    /**
     * DELETEを実行
     *
     * @param string    $where
     * @param array     $params
     *
     * @return bool
     */
    protected function delete(string $where, array $params = array()) {
        $sql = sprintf("DELETE FROM %s", $this->table_name);
        if ($where != "") {
            $sql .= " WHERE " . $where;
        }
        $stmt = $this->db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $res = $stmt->execute();

        return $res;
    }

    /**
     * UPDATEを実行
     *
     * @param mixed[] $data {
     *      "列名": 更新値
     * }
     *
     * @param string $where
     *      条件("WHERE ..."の"...")
     *
     * @return bool
     */
    protected function update(array $data, string $where) {
        $keyval = array();
        foreach ($data as $key => $val) {
            $keyval[] = "${key}=${val}";
        }
        $sql = sprintf("UPDATE $this->table_name SET %s", implode(", ", $keyval));
        if ($where != "") {
            $sql .= " WHERE " . $where;
        }
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute();
        return $res;
    }

    /**
     * ランダム文字列を生成
     *
     * @param int $length 文字数 Default: 4
     *
     * @return string
     */
    protected function makeRandStr(int $length = 4) {
        static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= $chars[mt_rand(0, strlen($chars)-1)];
        }

        return $str;
    }

    /**
     * 期限日時を設定
     *
     * @param int $minute 制限までの時間(分) Default: 30
     *
     * @return string (YYYY-MM-DD HH:mm:SS)
     */
    protected function setLimit(int $minute = 30) {
        return date('Y-m-d H:i:s', strtotime("+ $minute minute"));
    }

    /**
     * ユーザIDが引数にあるか判定し, 無ければ $this->user_id を返す
     *
     * @param string|null $user
     *
     * @return string
     */
    protected function setUser(string $user = null) {
        if ($user == null) {
            return $this->user_id;
        } else {
            return $user;
        }
    }

}