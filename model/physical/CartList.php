<?php

namespace model\physical;

class CartList extends ModelBase {

    public function get() {
        $wants = array(
            "product",
            "fileName",
            "title",
            "price"
        );
        $where["id"] = $this->user_id;
        return $this->getRows($wants, $where);
    }

}