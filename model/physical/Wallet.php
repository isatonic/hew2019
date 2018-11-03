<?php

class Wallet extends ModelBase {

    /**
     * ウォレット(所持Tポイント)を取得
     *
     * @param string $user メールアドレス
     *
     * @return int
     */
    public function checkWallet(string $user) {
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
     * @param string    $user   メールアドレス
     * @param int       $point  追加分ポイント
     *
     * @return bool
     */
    public function charge(string $user, int $point) {
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
     * @param string    $user   メールアドレス
     * @param int       $point  消費分ポイント
     *
     * @return bool
     */
    public function usePoint(string $user, int $point) {
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