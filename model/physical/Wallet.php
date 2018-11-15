<?php

namespace model\physical;

/**
 * Walletテーブル操作クラス
 *
 * @package model\physical
 */
class Wallet extends ModelBase {

    /**
     * ユーザを追加
     *
     * 一般ユーザの新規登録時に実行
     *
     * @param string|null $id
     *
     * @return bool
     */
    public function init(string $id = null) {
        $data["user"] = $id;
        return $this->execInsert($data);
    }

    /**
     * ウォレット(所持Tポイント)を取得
     *
     * @param string|null $user ユーザID (Default: ログイン中ID)
     *
     * @return int
     */
    public function checkWallet(string $user = null) {
        $user = $this->setUser($user);
        $wants = ["point"];
        $where = ["user" => $user];
        $rows = $this->getRows($wants, $where);
        $point = $rows[0]["point"];

        return $point;
    }

    /**
     * Tポイントをウォレットに追加
     *
     * @param int           $point  追加分ポイント
     * @param string|null   $user   ユーザID (Default: ログイン中ユーザ)
     *
     * @return bool
     */
    public function charge(int $point, string $user = null) {
        $user = $this->setUser($user);
        $newPoint = $this->checkWallet($user) + $point;
        $data = array(
            "point" => $newPoint
        );
        $where["user"] = $user;

        return $this->execUpdate($data, $where);
    }

    /**
     * Tポイントを消費
     *
     * @param int           $point  消費分ポイント
     * @param string|null   $user   ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function usePoint(int $point, string $user = null) {
        $user = $this->setUser($user);
        $newPoint = $this->checkWallet($user) - $point;
        if ($newPoint >= 0) {
            $data = array(
                "point" => $newPoint
            );
            $where["user"] = $user;
            return $this->execUpdate($data, $where);
        }

        return false;

    }
}