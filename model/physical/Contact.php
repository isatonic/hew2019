<?php

class Contact extends ModelBase {

    /**
     * お問い合わせ登録
     *
     * @param string[] $data {
     *      @type string "name"     名前
     *      @type string "email"    メールアドレス
     *      @type string "title"    タイトル
     *      @type string "tag"      種別タグのタグID(->ContactTags.id)
     *      @type string "detail"   詳細
     * }
     *
     * @return bool
     */
    public function add(array $data) {
        $data["flag"] = "unconfirm";
        return $this->insert($data);
    }

    /**
     * 全お問い合わせを取得
     *
     * @return array {
     *      @type mixed[] {
     *          @type int "id"              問い合わせID
     *          @type string "contactDate"  問い合わせ日時(YYYY-MM-DD HH:mm:SS)
     *          @type string "flag"         状態フラグ(unconfirm, progress, complete)
     *          @type string "name"         名前
     *          @type string "email"        メールアドレス
     *          @type string "title"        タイトル
     *          @type string "tag"          種別 *          @type string "detail"       詳細 *      }
     * }
     */
    public function getAll() {
        $sql = <<<SQL
            SELECT
                C.id as id,
                C.contactDate as contactDate,
                C.flag as flag,
                C.name as name,
                C.email as email,
                C.title as title,
                CT.name as tag,
                C.detail as detail
            FROM Contact C
            JOIN ContactTags CT on C.tag = CT.id
            ORDER BY
                C.contactDate DESC,
                C.flag ASC
SQL;
        $rows = $this->query($sql);

        return $rows;
    }

    /**
     * 特定の問い合わせのみを取得
     *
     * @param int $id 問い合わせID
     *
     * @return array {
     *      @type string "contactDate"  問い合わせ日時(YYYY-MM-DD HH:mm:SS)
     *      @type string "flag"         状態フラグ(unconfirm, progress, complete)
     *      @type string "name"         名前
     *      @type string "email"        メールアドレス
     *      @type string "title"        タイトル
     *      @type string "tag"          種別
     *      @type string "detail"       詳細
     * }
     */
    public function get(int $id) {
        $sql = <<<SQL
            SELECT
                C.contactDate as contactDate,
                C.flag as flag,
                C.name as name,
                C.email as email,
                C.title as title,
                CT.name as tag,
                C.detail as detail
            FROM Contact C
            JOIN ContactTags CT on C.tag = CT.id
            WHERE C.id = :id
            ORDER BY
                C.contactDate DESC,
                C.flag ASC
SQL;
        $params["id"] = $id;
        $rows = $this->query($sql, $params);

        return $rows[0];
    }

    /**
     * 対応状況を更新
     *
     * @param int    $id
     * @param string $to "unconfirm", "progress", "complete"から選択
     *
     * @return bool
     */
    public function updateStatus(int $id, string $to) {
        $data["flag"] = $to;
        $where = "id = $id";

        return $this->update($data, $where);
    }

}