<?php

class ModelBase {

    /**
     * @var PDO
     */
    protected $db;
    protected $table_name;

    // コンストラクタ (オブジェクト作成時自動実行)
    public function __construct() {
        $this->initDB();

        if ($this->table_name == null) {
            $this->setTableName();
        }
    }

    // DB接続
    public function initDB() {
        try {
            $this->db = new PDO('mysql:host=localhost;dbname=isatonic', 'root', 'root', array(PDO::ATTR_PERSISTENT => true));
        } catch (PDOException $e) {
            die();
        }
    }

    // テーブル名の設定
    public function setTableName() {
        $this->table_name = get_class($this);
    }

    // SELECTを実行
    /**
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
        $rows = $stmt->fetch(PDO::FETCH_ASSOC);

        return $rows;
    }

    // INSERTを実行
    /**
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

    // DELETEを実行
    /**
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

}