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

    public function check(string $user, string $target) {
        $want = ["lastCheck"];
        $where = ["user" => $user, "target" => $target];
        $rows = $this->getRows($want, $where);
        return $rows[0]["lastCheck"];
    }

}