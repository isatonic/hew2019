<?php

class PointCharge extends ModelBase {

    /**
     * Tポイントチャージ履歴を保存
     *
     * @param $user
     * @param $point
     *      追加分ポイント
     *
     * @return bool
     */
    public function charge($user, $point) {
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
     * @param      $user
     * @param null $start
     *      検索したい期間の開始日時(option)
     * @param null $end
     *      検索したい期間の終了日時(option)
     *
     * @return mixed
     */
    public function getLog($user, $start = null, $end = null) {
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