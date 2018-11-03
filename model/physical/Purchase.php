<?php

class Purchase extends ModelBase {

    /**
     * 購入履歴の追加
     *
     * @param string $user ユーザのメールアドレス
     * @param string $product 商品ID
     *
     * @return bool
     */
    public function buy(string $user, string $product) {
        $data = array(
            "buyer" => $user,
            "product" => $product
        );

        return $this->insert($data);
    }

}