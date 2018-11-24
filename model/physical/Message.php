<?php
namespace model\physical;


class Message extends ModelBase {

    public function add(string $from, string $to, string $message) {
        $data = array(
            "sender" => $from,
            "destination" => $to,
            "message" => $message
        );
        return $this->execInsert($data);
    }

    public function get(string $from, string $to) {
        $wants = ["sender", "destination", "message", "sendDate"];
        $where = ["sender" => $from, "destination" => $to];
        $order = ["sendDate" => "ASC"];
        return $this->getRows($wants, $where, $order);
    }

}