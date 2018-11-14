<?php

namespace model\physical;

/**
 * Limitsテーブル操作クラス
 *
 * @package model\physical
 */
class Limits extends ModelBase {

    /**
     * 制限の一覧を取得
     *
     * @return mixed[]
     */
    public function getAll() {
        $sql = "SELECT id, duration, title FROM Limits";
        $rows = $this->query($sql);
        return $rows;
    }

    /**
     * 特定の制限の情報を取得
     *
     * @param string $id
     *
     * @return bool|array
     */
    public function get(string $id) {
        $sql = "SELECT duration, title FROM Limits WHERE id = :id";
        $params = array(
            "id" => $id
        );
        $rows = $this->query($sql, $params);
        if ($rows != null) {
            return $rows[0];
        } else {
            return false;
        }
    }

    /**
     * 制限を新規作成
     *
     * @param array $add
     *
     * @return bool
     */
    public function add(array $add) {
        $data = array(
            "id" => $add["id"],
            "duration" => $add["duration"],
            "title" => $add["title"]
        );

        return $this->insert($data);
    }

}