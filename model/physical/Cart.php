<?php

class Cart extends ModelBase {

    /**
     * カートに商品を追加
     *
     * @param $user
     * @param $product
     *
     * @return bool
     */
    public function add($user, $product) {
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
     * @param $user
     * @param $product
     *
     * @return bool
     */
    public function remove($user, $product) {
        $where = "user LIKE :user and product LIKE :product";
        $params = array(
            "user" => $user,
            "product" => $product
        );
        $res = $this->delete($where, $params);

        return $res;
    }

}