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
        $this->insertSql($data);
        $this->exec($data);

        return $this->getResult();
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
        $where = "user LIKE :user and product LIKE :product";
        $params = array(
            "user" => $who,
            "product" => $product
        );
        $this->deleteSql($where);
        $this->exec($params);

        return $this->getResult();
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
        $this->selectSql($wants, $where);
        $this->exec();
        $this->getAssoc();
        $rows = $this->getRows();
        $array = array();
        foreach ($rows as $row) {
            $array[] = $row["product"];
        }

        return $array;
    }

}