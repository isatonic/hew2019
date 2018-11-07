<?php

/**
 * PointChargeテーブル操作クラス
 */
class PointCharge extends ModelBase {

    /**
     * Tポイントチャージ履歴を保存
     *
     * @param string    $user   ユーザのメールアドレス
     * @param int       $point  追加分ポイント
     *
     * @return bool
     */
    public function charge(string $user, int $point) {
        $data = array(
            "user" => $user,
            "point" => $point
        );
        $res = $this->insert($data);

        return $res;
    }

    /**
     * チャージ履歴を取得
     *
     * @param string        $user   ユーザのメールアドレス
     * @param string null   $start  検索したい期間の開始日時(option, 例:"2018-10-03 23:01:10")
     * @param string null   $end    検索したい期間の終了日時(option 例:"2018-10-03 23:01:10")
     *
     * @return array {
     *      @type array {
     *          @type int       "point"     チャージしたポイント量
     *          @type string    "datetime"  チャージした日付(例:"2018-10-02 01:01:01")
     *      }
     * }
     */
    public function getLog(string $user, string $start = null, string $end = null) {
        $sql = "SELECT point, datetime FROM PointCharge WHERE user LIKE :user";
        $params["user"] = $user;
        if ($start != null and $end == null) {
            $sql .= " and datetime >= :start";
            $params["start"] = $start;
        } else if ($start == null and $end != null) {
            $sql .= " and datetime <= :end";
            $params["end"] = $end;
        } else if ($start != null and $end != null) {
            $sql .= " and datetime BETWEEN :start and :end";
            $params += array(
                "start" => $start,
                "end" => $end
            );
        }
        $rows = $this->query($sql, $params);

        return $rows;
    }

}