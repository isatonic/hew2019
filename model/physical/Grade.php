<?php

class Grade extends ModelBase {

    /**
     * getPoint: 現在のグレード, グレードポイントを取得
     *
     * @param $user
     *
     * @return array
     *      ["grade"]   => グレード
     *      ["gpoint"]  => グレードポイント
     */
    public function getPoint($user) {
        $sql = "SELECT gpoint FROM Grade WHERE user LIKE :user";
        $params = array(
            "user" => $user
        );
        $rows = $this->query($sql, $params);
        $gpoint = $rows[0]["gpoint"];
        $grade = 0;
        if ($gpoint < 100) {
            $grade = 1;
        } else if ($gpoint >= 100 and $gpoint < 200) {
            $grade = 2;
        } else if ($gpoint >= 200 and $gpoint < 300) {
            $grade = 3;
        } else if ($gpoint >= 300 and $gpoint < 400) {
            $grade = 4;
        } else if ($gpoint >= 400 and $gpoint < 500) {
            $grade = 5;
        } else if ($gpoint >= 500) {
            $grade = 6;
        }

        return array(
            "grade" => $grade,
            "gpoint" => $gpoint
        );
    }

    /**
     * addPoint: グレードポイントを追加
     *
     * @param $user
     * @param $point
     *      追加分のポイント
     *
     * @return bool
     */
    public function addPoint($user, $point) {
        $nowPoint = $this->getPoint($user);
        $data["gpoint"] = $point + $nowPoint["gpoint"];
        $where = "WHERE user LIKE $user";
        $res = $this->update($data, $where);

        return $res;
    }

}