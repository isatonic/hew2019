<?php
namespace model;

interface DataInterface {
    public function __construct(array $data);
    public function get() : array;
    public function extend(string $target);
}

class Data implements DataInterface {

    private $arr;

    public function __construct(array $data) {
        $this->arr = $data;
    }

    public function get() : array {
        return $this->arr;
    }

    public function extend(string $target) {
        return $this->arr["$target"];
    }

}