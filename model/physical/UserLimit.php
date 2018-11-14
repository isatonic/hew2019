<?php

namespace model\physical;

/**
 * UserLimitテーブル操作クラス
 *
 * @package model\physical
 */
class UserLimit extends ModelBase {

    /**
     * 制限を追加
     *
     * @param string   $target      ユーザID
     * @param string   $limitType   制限区分
     * @param string   $reason      制限理由
     * @param int|null $duration    制限期間
     *
     * @return bool
     */
    public function add(string $target, string $limitType, string $reason, int $duration = null) {
		$data = array(
				"user" => $target,
				"limitType" => $limitType,
				"reason" => $reason
		);
		if ($duration != null) {
			$data["limitEnd"] = date('Y-m-d H:i:s', strtotime("+ $duration hour"));
		}

		return $this->insert($data);
	}

    /**
     * 特定ユーザの制限履歴を全て取得
     *
     * @param string $user ユーザID
     *
     * @return array {
     *      @type string[] {
     *          @type string "limitType"
     *          @type string "limitStart"
     *          @type string "limitEnd"
     *          @type string "reason"
     *      }
     * }
     */
    public function fetch(string $user) {
        $wants = array(
            "limitType",
            "limitStart",
            "limitEnd",
            "reason"
        );
        $where = ["user" => $user];
        $this->setSql($wants, $where);
        $this->exec();
        $this->getAssoc();

        return $this->getRows();
    }

    /**
     * 制限状態の有無をチェック
     *
     * @param string $user ユーザID
     *
     * @return true|int 制限無し:true, 制限あり:残り時間(h)
     */
    public function check(string $user) {
        $wants = ["limitEnd"];
        $where = ["user" => $user];
        $order = ["limitEnd" => "DESC"];
        $this->setSql($wants, $where, $order);
        $this->exec();
        $this->getAssoc();
        $rows = $this->getRows();
        if ($rows != null) {
            $limit = new \DateTime($rows[0]["limitEnd"]);
            $now = new \DateTime();
            if ($limit >= $now) {
                $diff = $now->diff($limit);
                return (int)$diff->format('%h');
            }
        }

        return true;
    }

}
