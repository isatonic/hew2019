<?php

namespace model\physical;

/**
 * PointChargeテーブル操作クラス
 *
 * @package model\physical
 */
class PointCharge extends ModelBase {

    /**
     * Tポイントチャージ履歴を保存
     *
     * @param int           $point  追加分ポイント
     * @param string|null   $user   ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function charge(int $point, string $user = null) {
        $user = $this->setUser($user);
        $data = array(
            "user" => $this->db->quote($user),
            "point" => $point
        );

        return $this->execInsert($data);
    }

    /**
     * チャージ履歴を取得
     *
     * @param string        $user   ユーザID
     * @param string|null   $start  検索したい期間の開始日時(option, 例:"2018-10-03 23:01:10")
     * @param string|null   $end    検索したい期間の終了日時(option 例:"2018-10-03 23:01:10")
     *
     * @return array {
     *      @type array {
     *          @type int       "point"     チャージしたポイント量
     *          @type string    "datetime"  チャージした日付(例:"2018-10-02 01:01:01")
     *      }
     * }
     */
    public function getLog(string $user, string $start = null, string $end = null) {
        $sql = "SELECT point, datetime FROM PointCharge WHERE user LIKE $user";
        if ($start != null and $end == null) {
            $sql .= " and datetime >= $start";
        } else if ($start == null and $end != null) {
            $sql .= " and datetime <= $end";
        } else if ($start != null and $end != null) {
            $sql .= " and datetime BETWEEN $start and $end";
        }
        $this->exec(null, $sql);
        $this->setAssoc();
        $rows = $this->returnRows();

        return $rows;
    }

}