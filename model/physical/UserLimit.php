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
     * @param string   $who         ユーザのメールアドレス
     * @param string   $limitType   制限区分
     * @param string   $reason      制限理由
     * @param int|null $duration    制限期間
     *
     * @return bool
     */
    public function add(string $who, string $limitType, string $reason, int $duration = null) {
		$data = array(
				"user" => $who,
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
     * @param string $user ユーザのメールアドレス
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
        $sql = "SELECT limitType, limitStart, limitEnd, reason from UserLimit WHERE user LIKE :user";
        $params = array(
            "user" => $user
        );

        return $this->query($sql, $params);
    }

    /**
     * 制限状態の有無をチェック
     *
     * @param string $user メールアドレス
     *
     * @return true|int 制限無し:true, 制限あり:残り時間(h)
     */
    public function check(string $user) {
        $sql = "SELECT limitEnd from UserLimit WHERE user LIKE :user ORDER BY limitEnd DESC";
        $params = array(
            "user" => $user
        );
        $rows = $this->query($sql, $params);
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
