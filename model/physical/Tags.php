<?php

namespace model\physical;

/**
 * Tagsテーブル操作クラス
 *
 * @package model\physical
 */
class Tags extends ModelBase {

    /**
     * 商品用タグを全て取得
     *
     * @return array {
     *      @type array {
     *          @type string "id"
     *          @type string "name"
     *      }
     * }
     */
    public function getAll() {
        $wants = ["id", "name"];
        $order = ["id" => "ASC"];

        return $this->getRows($wants, null, $order);
    }

    /**
     * 商品用タグを新規追加
     *
     *
     * @param string $name タグ名
     *
     * @return bool
     */
    public function add(string $name) {
        $wants = ["id", "name"];
        $order = ["id" => "DESC"];
        $rows = $this->getRows($wants, null, $order);

        if ($rows == null) {
            $id = "T00001";
        } else {
            $newIdNum = (int)substr($rows[0]["id"], -5) + 1;
            $id = "T" . (string)$newIdNum;
        }

        if (strlen($id) <= 5) {
            $data = array(
                "id" => $id,
                "name" => $name
            );
            return $this->execInsert($data);
        } else {
            return false;
        }
    }

    /**
     * 特定のタグのタグ名を取得
     *
     * 引数に指定したIDのタグが存在しない場合`false`を返す
     *
     * @param string $id タグID
     *
     * @return bool|string
     */
    public function getName(string $id) {
        $wants = ["name"];
        $where = ["id" => $id];
        $rows = $this->getRows($wants, $where);

        if ($rows == null) {
            return false;
        } else {
            return $rows[0]["name"];
        }
    }

}