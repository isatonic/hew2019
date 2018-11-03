<?php

class Wallet extends ModelBase {

    /**
     * ウォレット(所持Tポイント)を取得
     *
     * @param $user
     *
     * @return int
     */
    public function checkWallet($user) {
        $sql = "SELECT point FROM Wallet WHERE user LIKE :user";
        $params = array(
            "user" => $user
        );
        $rows = $this->query($sql, $params);
        $point = $rows[0]["point"];

        return $point;
    }

    /**
     * Tポイントをウォレットに追加
     *
     * @param $user
     * @param $point
     *      追加分ポイント
     *
     * @return bool
     */
    public function charge($user, $point) {
        $newPoint = $this->checkWallet($user) + $point;
        $data = array(
            "point" => $newPoint
        );
        $where = "user LIKE $user";
        $res = $this->update($data, $where);

        return $res;
    }

    /**
     * Tポイントを消費
     *
     * @param $user
     * @param $point
     *      消費分ポイント
     *
     * @return bool
     */
    public function usePoint($user, $point) {
        $newPoint = $this->checkWallet($user) - $point;
        if ($newPoint < 0) {
            $res = false;
        } else {
            $data = array(
                "point" => $newPoint
            );
            $where = "user LIKE $user";
            $res = $this->update($data, $where);
        }

        return $res;

    }
}