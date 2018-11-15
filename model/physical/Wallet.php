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
        $this->insertSql($data);
        $this->exec($data);
        return $this->getResult();
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
        $this->selectSql($wants, $where);
        $this->exec();
        $this->getAssoc();
        $rows = $this->getRows();
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
        $where = "user LIKE $user";
        $res = $this->update($data, $where);

        return $res;
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