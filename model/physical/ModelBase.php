<?php

namespace model\physical;

use PDO;
use PDOException;

/**
 * DBに関する基本処理をまとめたクラス
 *
 * @package model\physical
 */
class ModelBase {

    /** @var PDO $db DB接続用PDO */
    protected $db;
    /** @var string $table_name テーブル名格納用変数 */
    protected $table_name;
    /** @var string $user_id ユーザID */
    protected $user_id;


    /**
     * コンストラクタ: オブジェクト生成時に自動実行
     *
     * @param string|null $user
     */
    public function __construct(string $user = null) {
        $this->initDB();

        if ($this->table_name == null) {
            $this->setTableName();
        }

        if ($user != null) {
            $this->user_id = $user;
        }
    }

    /**
     * DBへ接続
     *
     * メンバ変数$db <- PDO
     */
    public function initDB() {
        try {
            $this->db = new PDO('mysql:host=db;dbname=isatonic', 'root', 'root', array(PDO::ATTR_PERSISTENT => true));
        } catch (PDOException $e) {
            die();
        }
    }

    /**
     * テーブル名を設定
     *
     * メンバ変数$table_name <- テーブル名 (=クラス名)
     */
    public function setTableName() {
        $this->table_name = get_class($this);
    }

    /**
     * SELECTの結果を取得
     *
     * @param string    $sql
     * @param array     $params
     *
     * @return mixed[]
     */
    public function query(string $sql, array $params = array()) {
        $stmt = $this->db->prepare($sql);
        if ($params != null) {
            foreach ($params as $key => $val) {
                $stmt->bindValue(':' . $key, $val);
            }
        }
        $stmt->execute();
        $rows = array();
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }

        return $rows;
    }

    /**
     * INSERTを実行
     *
     * @param array $data
     *
     * @return bool
     */
    public function insert(array $data) {
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
    public function delete(string $where, array $params = array()) {
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
    public function update(array $data, string $where) {
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