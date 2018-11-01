<?php

class ModelBase {

    /** @var PDO */
    protected $db;
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
     *  initDB: DBへ接続
     *
     * メンバ変数$db <- PDO
     */
    public function initDB() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=isatonic', 'root', 'root', array(PDO::ATTR_PERSISTENT => true));
        } catch (PDOException $e) {
            die();
        }
    }

    /**
     * setTableName: テーブル名を設定
     *
     * メンバ変数$table_name <- テーブル名 (=クラス名)
     */
    public function setTableName() {
        $this->table_name = get_class($this);
    }

    /**
     * SELECTの結果を取得
     *
     * @param       $sql
     * @param array $params
     *
     * @return mixed
     */
    public function query($sql, array $params = array()) {
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
     * @param $data
     *
     * @return bool
     */
    public function insert($data) {
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
     * @param      $where
     * @param null $params
     *
     * @return bool
     */
    public function delete($where, $params = null) {
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
     * @param $data:    ["列名"] = 更新値
     * @param $where:   条件(WHERE ...)
     *
     * @return bool
     */
    public function update($data, $where) {
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