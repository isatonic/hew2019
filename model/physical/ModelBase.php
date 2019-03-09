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
    /** @var \PDOStatement */
    protected $result;
    protected $rows;


    /**
     * コンストラクタ: オブジェクト生成時に自動実行
     *
     * @param PDO $pdo
     * @param string|null $user
     */
    public function __construct(PDO $pdo, string $user = null) {
        $this->db = $pdo;
        $this->table_name = substr(get_class($this), strrpos(get_class($this), '\\') + 1);

        if ($user != null) {
            $this->user_id = $user;
        }
    }

    /**
     * @param array|null  $params
     *
     * @param string|null $sql
     *
     * @return void
     */
    protected function exec(array $params = null, string $sql = null) {
        if ($sql == null) {
            $sql = $this->sql;
        }
//        $stmt = $this->db->prepare($sql);

//        if ($params != null) {
//            $arr = [];
//            foreach ($params as $key => $val) {
//                $this->stmt->bindValue(':' . $key, $val);
////                $arr[":{$key}"] = $val;
//            }
////            $this->result = $stmt->execute($arr);
//            $this->result = $this->db->query($stmt);
//        } else {
//            $this->result = $stmt->execute();
//        }

        $this->result = $this->db->query($sql);
    }

    protected function setAssoc() {
        $rows = array();
        while ($row = $this->result->fetch(PDO::FETCH_ASSOC)) {
            $rows[] = $row;
        }
        $this->rows = $rows;
    }

    protected function getResult() {
        return $this->result;
    }

    protected function returnRows() {
        return $this->rows;
    }

    protected function getRows(array $want, array $where = null, array $order = null) {
        $this->selectSql($want, $where, $order);
        $this->exec($where);
        $this->setAssoc();
//        $this->returnRows();
        return $this->rows;
    }

    protected function execInsert(array $data) {
        $this->insertSql($data);
        $this->exec($data);
        return $this->getResult();
    }

    protected function execDelete(array $params) {
        $this->deleteSql($params);
        $this->exec($params);
        return $this->getResult();
    }

    protected function execUpdate(array $new, array $param) {
        $this->updateSql($new, $param);
        $this->exec($param);
        return $this->getResult();
    }


    protected function selectSql(array $want = array("*"), array $where = null, array $order = null) {
        $sql = sprintf("SELECT %s FROM %s", implode(", ", $want), $this->table_name);
        if ($where != null) {
            $sql .= $this->addWhere($where);
        }
        if ($order != null) {
            $sql .= " ORDER BY ";
            $set = array();
            foreach ($order as $key3 => $val3) {
                $set[] = "$key3 $val3";
            }
            $sql .= implode(", ", $set);
        }
        $this->sql = $sql;
    }

    /**
     * INSERT文を準備
     *
     * @param array $data
     */
    protected function insertSql(array $data) {
        $fields = array();
        $values = array();
        foreach ($data as $key => $val) {
            $fields[] = $key;
            $values[] = $val;
        }
        $sql = sprintf(
            "INSERT INTO %s (%s) VALUES (%s)",
            $this->table_name,
            implode(', ', $fields),
            implode(', ', $values)
        );
        $this->sql = $sql;
    }

    /**
     * DELETE文を準備
     *
     * @param array $where
     */
    protected function deleteSql(array $where) {
        $sql = sprintf(/** @lang text */
            "DELETE FROM %s", $this->table_name);
        if ($where != null) {
            $sql .= $this->addWhere($where);
        }
        $this->sql = $sql;
    }

    /**
     * UPDATE文を準備
     *
     * @param mixed[] $data {
     *      "列名": 更新値
     * }
     *
     * @param array   $where
     *      条件("WHERE ..."の"...")
     */
    protected function updateSql(array $data, array $where) {
        $keyval = array();
        foreach ($data as $key => $val) {
            $keyval[] = "${key}=${val}";
        }
        $sql = sprintf(/** @lang text */
            "UPDATE $this->table_name SET %s", implode(", ", $keyval));
        if ($where != null) {
            $sql .= $this->addWhere($where);
        }
        $this->sql = $sql;
    }

    protected function addWhere(array $where, string $andor = "and") {
        $add = " WHERE ";
        $condition = array();
        foreach ($where as $key => $val) {
            $condition[] = "$key LIKE '$val'";
        }
        if (count($condition) > 1) {
            $add .= implode(" ${andor} ", $condition);
        } else {
            $add .= $condition[0];
        }

        return $add;
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
        if ($user === null) {
            return $this->user_id;
        } else {
            return $user;
        }
    }

}