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
        return $this->insert($data);
    }

    /**
     * お問い合わせへの返信履歴を全て取得
     *
     * @return mixed[]
     */
    public function getAll() {
        $sql = "SELECT id, source, operator, date, detail FROM ContactReply";
        return $this->query($sql);
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
        $sql = "SELECT id, date, detail FROM ContactReply WHERE source = :source";
        $params = array(
            "source" => $source
        );

        return $this->query($sql, $params);
    }

    /**
     * 特定の返信を取得
     *
     * @param int $id 返信ID
     *
     * @return array
     */
    public function get(int $id) {
        $sql = "SELECT source, date, detail FROM ContactReply WHERE id = :id";
        $params = array(
            "id" => $id
        );
        $rows = $this->query($sql, $params);

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
        $sql = "SELECT id, source, date, detail FROM ContactReply WHERE operator LIKE :who";
        $params = array(
            "operator" => $who
        );

        return $this->query($sql, $params);
    }

}