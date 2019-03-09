<?php

namespace model\physical;

class MessageCheck extends ModelBase {

    public function new(string $user, string $target) {
        $data = array(
            "user" => $user,
            "target" => $target
        );
        return $this->execInsert($data);
    }

    public function open(string $user, string $target) {
        $new = ["lastCheck" => date('Y-m-d H:i:s')];
        $where = array(
            "user" => $user,
            "target" => $target
        );
        return $this->execUpdate($new, $where);
    }

    public function check(string $user) {
        $now = date('Y-m-d H:i:s');
        $want = ["count(*) as count"];
        $where = ["user" => $user];
        $this->selectSql($want, $where);
        $this->sql .= " and lastCheck < $now";
        $this->setAssoc();
        $ret = $this->returnRows();
        return (int)$ret[0]["count"];
    }

}