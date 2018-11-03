<?php

class Purchase extends ModelBase {

    /**
     * buy: 購入履歴の追加
     *
     * @param $user
     * @param $product
     *
     * @return bool
     */
    public function buy($user, $product) {
        $data = array(
            "buyer" => $user,
            "product" => $product
        );

        return $this->insert($data);
    }

}