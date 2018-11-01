<?php

class Tag extends ModelBase {

    /**
     * putTagOn: 商品にタグ付けする
     *
     * @param       $product
     * @param array $tag
     *      タグIDを値とする配列
     *
     * @return bool
     */
    public function putTagOn($product, array $tag = array()) {
        if ($tag == null) {
            return false;
        } else {
            $data["product"] = $product;
            $res = array();
            foreach ($tag as $val) {
                $data["tagID"] = $val;
                $res[] = $this->insert($data);
            }
            return in_array(false, $res, true) ? false : true;
        }
    }

    /**
     * takeTagOff: 商品からタグを外す
     *
     * @param       $product
     * @param array $tag
     *      タグIDを値とする配列
     *
     * @return bool
     */
    public function takeTagOff($product, array $tag = array()) {
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
     * searchTag: タグから商品IDを検索
     *
     * @param $tag
     *      タグIDを値とする配列
     *
     * @return mixed
     *      [0..*]["product"] = 商品ID
     */
    public function searchTag($tag) {
        $sql = "SELECT product FROM Tag WHERE tagID LIKE :tag";
        $params = array(
            "tag" => $tag
        );
        $rows = $this->query($sql, $params);

        return $rows;
    }

}