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
     * @param string $user      ユーザのメールアドレス
     * @param string $product   商品ID
     *
     * @return bool
     */
    public function add(string $user, string $product) {
        $data = array(
            "product" => $product,
            "user" => $user
        );
        $res = $this->insert($data);

        return $res;
    }

    /**
     * カートから商品を削除
     *
     * @param string $user      メールアドレス
     * @param string $product   商品ID
     *
     * @return bool
     */
    public function remove(string $user, string $product) {
        $where = "user LIKE :user and product LIKE :product";
        $params = array(
            "user" => $user,
            "product" => $product
        );
        $res = $this->delete($where, $params);

        return $res;
    }

    /**
     * カート内の商品のIDを一覧取得
     *
     * @param string $user メールアドレス
     *
     * @return string[] 商品IDの配列
     */
    public function get(string $user) {
        $sql = "SELECT product FROM Cart WHERE user LIKE :user";
        $params = array(
            "user" => $user
        );
        $array = array();
        $rows = $this->query($sql, $params);
        foreach ($rows as $row) {
            $array[] = $row["product"];
        }

        return $array;
    }

}