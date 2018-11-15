<?php

namespace model\physical;

/**
 * Cartテーブル操作クラス
 *
 * @package model\physical
 */
class Cart extends ModelBase {

    /**
     * カートに商品を追加
     *
     * @param string      $product 商品ID
     * @param string|null $who ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function add(string $product, string $who = null) {
        $who = $this->setUser($who);
        $data = array(
            "product" => $product,
            "user" => $who
        );

        return $this->execInsert($data);
    }

    /**
     * カートから商品を削除
     *
     * @param string      $product 商品ID
     * @param string|null $who ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function remove(string $product, string $who = null) {
        $who = $this->setUser($who);
        $params = array(
            "user" => $who,
            "product" => $product
        );

        return $this->execDelete($params);
    }

    /**
     * カート内の商品のIDを一覧取得
     *
     * @param string|null $who ユーザID (Default: ログイン中ID)
     *
     * @return string[] 商品IDの配列
     */
    public function get(string $who = null) {
        $who = $this->setUser($who);
        $wants = array("product");
        $where = array("user" => $who);
        $rows = $this->getRows($wants, $where);
        $array = array();
        foreach ($rows as $row) {
            $array[] = $row["product"];
        }

        return $array;
    }

}