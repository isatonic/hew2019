<?php

namespace model;

class JSONenc {

    private $phpArray;
    private $json;

    public function __construct(array $arr) {
        $this->phpArray = $arr;
        $this->encode();
    }

    private function encode() {
        $this->json = json_encode($this->phpArray);
    }

    public function ret() {
        return $this->json;
    }

}