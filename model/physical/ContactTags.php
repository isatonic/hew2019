<?php

namespace model\physical;

/**
 * ContactTagsテーブル操作クラス
 *
 * @package model\physical
 */
class ContactTags extends ModelBase {

    /**
     * お問い合わせ種別を全て取得
     *
     * @return array {
     *      @type array {
     *          @type string "id"
     *          @type string "name
     *      }
     * }
     */
    public function getAll() {
        $sql = "SELECT id, name FROM ContactTags ORDER BY id ASC";
        return $this->query($sql);
    }

    /**
     * お問い合わせ種別を新規追加
     *
     *
     * @param string $name 種別名
     *
     * @return bool
     */
    public function add(string $name) {
        $sql = "SELECT id, name FROM ContactTags ORDER BY id DESC";
        $rows = $this->query($sql);

        if ($rows == null) {
            $id = "C0001";
        } else {
            $newIdNum = (int)substr($rows[0]["id"], -4) + 1;
            $id = "C" . (string)$newIdNum;
        }

        if (strlen($id) <= 5) {
            $data = array("id" => $id,
                "name" => $name
            );
            return $this->insert($data);
        } else {
            return false;
        }

    }

    /**
     * 特定の種別の種別名を取得
     *
     * 引数に指定したIDの種別が存在しない場合`false`を返す
     *
     * @param string $id 種別ID
     *
     * @return bool|string
     */
    public function getName(string $id) {
        $sql = "SELECT name FROM ContactTags WHERE id LIKE :id";
        $params = array(
            "id" => $id
        );
        $rows = $this->query($sql, $params);

        if ($rows == null) {
            return false;
        } else {
            return $rows[0]["name"];
        }
    }

}