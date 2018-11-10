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

        return $this->insert($data);
    }

}