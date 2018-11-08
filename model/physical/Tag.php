<?php

namespace model\physical;

use Exception;

/**
 * Tagテーブル操作クラス
 *
 * @package model\physical
 */
class Tag extends ModelBase {

    /**
     * 商品にタグ付けする
     *
     * @param string    $product    商品ID
     * @param string[]  $tag        タグIDを値とする配列
     *
     * @return bool
     */
    public function putTagOn(string $product, array $tag = array()) {
        if ($tag == null) {
            return false;
        } else {
            $data["product"] = $product;
            try {
                $this->db->beginTransaction();
                foreach ($tag as $val) {
                    $data["tagID"] = $val;
                    $this->insert($data);
                }
                $this->db->commit();
                return true;
            } catch (Exception $e) {
                $this->db->rollBack();
                return false;
            }
        }
    }

    /**
     * 商品からタグを外す
     *
     * @param string    $product    商品ID
     * @param string[]  $tag        タグIDを値とする配列
     *
     * @return bool
     */
    public function takeTagOff(string $product, array $tag = array()) {
        if ($tag == null) {
            return false;
        } else {
            $where = "product LIKE :product and tagID LIKE :tag";
            $res[] = array();
            foreach ($tag as $val) {
                $params = array(
                    "product" => $product,
                    "tag" => $val
                );
                $res[] = $this->delete($where, $params);
            }
            return in_array(false, $res, true) ? false: true;
        }
    }

    /**
     * タグから商品IDを検索
     *
     * @param string[] $tag タグIDを値とする配列
     *
     * @return string[] 商品IDの配列
     */
    public function searchTag(array $tag) {
        $sql = "SELECT product FROM Tag WHERE tagID in (:tags)";
        $params = array(
            "tags" => implode(", ", $tag)
        );
        $rows = $this->query($sql, $params);
        $ret = array();
        foreach ($rows as $row) {
            $ret[] = $row["product"];
        }
        return $ret;
    }

}