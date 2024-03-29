<?php

namespace model\physical;

/**
 * Gradeテーブル操作クラス
 *
 * @package model\physical
 */
class Grade extends ModelBase {

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
        $esc_data = [];
        foreach ($data as $key => $val) {
            $esc_data[$key] = $this->db->quote($val);
        }
        return $this->execInsert($esc_data);
    }

    /**
     * 現在のグレード, グレードポイントを取得
     *
     * @param string|null $user ユーザID (Default: ログイン中ID)
     *
     * @return array {
     *      @type "grade"   グレード
     *      @type "gpoint"  グレードポイント
     * }
     */
    public function getPoint(string $user = null) {
        $user = $this->setUser($user);
        $wants = ["gpoint"];
        $where = ["user" => $user];
        $rows = $this->getRows($wants, $where);
        $gpoint = (int) $rows[0]["gpoint"];
        $grade = 0;
        if ($gpoint < 100) {
            $grade = 6;
        } else if ($gpoint >= 100 and $gpoint < 300) {
            $grade = 5;
        } else if ($gpoint >= 300 and $gpoint < 700) {
            $grade = 4;
        } else if ($gpoint >= 700 and $gpoint < 1500) {
            $grade = 3;
        } else if ($gpoint >= 1500 and $gpoint < 3100) {
            $grade = 2;
        } else if ($gpoint >= 3100) {
            $grade = 1;
        }

        return array(
            "grade" => $grade,
            "gpoint" => $gpoint
        );
    }

    /**
     * グレードポイントを追加
     *
     * @param int           $point  追加分のポイント
     * @param string|null   $user   ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function addPoint(int $point, string $user = null) {
        $user = $this->setUser($user);
        $nowPoint = $this->getPoint($user);
        $data["gpoint"] = $point + $nowPoint["gpoint"];
        $where["user"] = $this->db->quote($user);

        return $this->execUpdate($data, $where);
    }

}