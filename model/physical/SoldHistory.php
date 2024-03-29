<?php

namespace model\physical;

class SoldHistory extends ModelBase {

    public function getHistory() {
        $this->user_id = $this->db->quote($this->user_id);
        $this->sql = <<<SQL
            SELECT 
                pr.id           as id,
                pr.title        as title,
                pr.filename     as file,
                pr.price        as price,
                pu.purchaseDate as date
            FROM Purchase pu
            INNER JOIN Products pr ON pu.product = pr.id
            WHERE pr.author = $this->user_id
            ORDER BY date ASC;
SQL;
        $this->exec();
        $this->setAssoc();
        return $this->rows;
    }
}