<?php

namespace model\physical;

/**
 * Purchaseテーブル操作クラス
 *
 * @package model\physical
 */
class Purchase extends ModelBase {

    /**
     * 購入履歴の追加
     *
     * @param string        $product 商品ID
     * @param string|null   $user ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function buy(string $product, string $user = null) {
        $user = $this->setUser($user);
        $data = array(
            "buyer" => $user,
            "product" => $product
        );

        return $this->execInsert($data);
    }

    /**
     * 購入履歴を取得
     *
     * @param string|null $user ユーザID (Default: ログイン中ID)
     *
     * @return array {
     *      @type string[] {
     *          @type string "purchaseDate" 購入日時
     *          @type string "product"      購入した商品のID
     *      }
     * }
     */
    public function get(string $user = null) {
        $user = $this->setUser($user);
        $wants = ["purchaseDate", "product"];
        $where = ["buyer" => $user];

        return $this->getRows($wants, $where);
    }

}