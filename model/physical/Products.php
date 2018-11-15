<?php

namespace model\physical;

/**
 * Productsテーブル操作クラス
 *
 * @package model\physical
 */
class Products extends ModelBase {

    /**
     * 商品登録
     *
     * @param mixed[] $data {
     *      @type string    "id"            商品ID
     *      @type string    "fileName"      ファイル名
     *      @type string    "title"         タイトル
     *      @type string    "author"        作者のユーザID
     *      @type int       "price"         価格
     *      @type string    "authorComment" 作者コメント
     * }
     *
     * @return bool
     */
    public function regist($data) {
        if (!isset($data["author"]) or is_null($data["author"])) {
            $data["author"] = $this->user_id;
        }

        return $this->execInsert($data);
    }

    /**
     * 全画像データの取得
     *
     * @return mixed[] {
     *      @type string    "id"            商品ID
     *      @type string    "fileName"      ファイル名
     *      @type string    "title"         タイトル
     *      @type string    "author"        作者のユーザID
     *      @type string    "postDate"      投稿日時("YYYY-MM-DD HH-mm-SS")
     *      @type int       "price"         価格
     *      @type string    "authorComment" 作者コメント
     * }
     */
    public function fetchAllImage() {
        $wants = array(
            "id",
            "fileName",
            "title",
            "author",
            "postDate",
            "price",
            "authorComment"
        );
        return $this->getRows($wants);
    }

    /**
     * 商品を削除
     *
     * @param string $id
     *
     * @return bool
     */
    public function remove(string $id) {
        $params = array(
            "id" => $id
        );

        return $this->execDelete($params);
    }

}