<?php

namespace model\physical;

/**
 * ContactReplyテーブル操作クラス
 *
 * @package model\physical
 */
class ContactReply extends ModelBase {

    /**
     * お問い合わせへの返信を登録
     *
     * @param int    $source お問い合わせID
     * @param string $detail 内容
     *
     * @return bool
     */
    public function add(int $source, string $detail) {
        $data = array(
            "source" => $source,
            "operator" => $this->user_id,
            "detail" => $detail
        );
        return $this->execInsert($data);
    }

    /**
     * お問い合わせへの返信履歴を全て取得
     *
     * @return mixed[]
     */
    public function getAll() {
        $wants = array(
            "id",
            "source",
            "operator",
            "date",
            "detail"
        );
        return $this->getRows($wants);
    }

    /**
     * 特定のお問い合わせに対する返信を取得
     *
     * @param int $source お問い合わせID
     *
     * @return array { 連想配列を値として持つ添字配列
     *      @type int       "id"        返信ID
     *      @type string    "date"      返信した日付
     *      @type string    "detail"    内容
     * }
     */
    public function getReply(int $source) {
        $wants = array(
            "id",
            "date",
            "detail"
        );
        $where["source"] = $source;
        return $this->getRows($wants, $where);
    }

    /**
     * 特定の返信を取得
     *
     * @param int $id 返信ID
     *
     * @return array
     */
    public function get(int $id) {
        $wants = array(
            "source",
            "date",
            "detail"
        );
        $where["id"] = $id;
        $rows = $this->getRows($wants, $where);

        return $rows[0];
    }

    /**
     * 特定の管理者による返信を取得
     *
     *
     * @param string|null $who 管理者ID (Default: ログイン中の管理者ID)
     *
     * @return mixed[]
     */
    public function getOperator(string $who = null) {
        $who = $this->setUser($who);
        $wants = array(
            "id",
            "source",
            "date",
            "detail"
        );
        $where["who"] = $who;

        return $this->getRows($wants, $where);
    }

}