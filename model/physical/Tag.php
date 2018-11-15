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
                    $this->execInsert($data);
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
            try {
                $this->db->beginTransaction();
                foreach ($tag as $val) {
                    $params = array(
                        "product" => $product,
                        "tag" => $val
                    );
                    $this->execDelete($params);
                }
                $this->db->commit();
                return true;
            } catch (\PDOException $d) {
                return false;
            }
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
        $tags = implode(", ", $tag);
        $sql = "SELECT product FROM Tag WHERE tagID in ({$tags})";
        $this->exec(null, $sql);
        $this->setAssoc();
        $rows = $this->returnRows();
        $ret = array();
        foreach ($rows as $row) {
            $ret[] = $row["product"];
        }
        return $ret;
    }

}