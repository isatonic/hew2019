<?php

/**
 * DBに関する基本処理をまとめたクラス
 */
class ModelBase {

    /** @var PDO $db DB接続用PDO */
    protected $db;
    /** @var string $table_name テーブル名格納用変数 */
    protected $table_name;


    /**
     * コンストラクタ: オブジェクト生成時に自動実行
     */
    public function __construct() {
        $this->initDB();

        if ($this->table_name == null) {
            $this->setTableName();
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
}