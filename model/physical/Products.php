<?php

class Products extends ModelBase {

    /**
     * regist: 画像登録
     *
     * @param $data[]
     *      id: String              -> 作品ID
     *      fileName: String        -> ファイル名
     *      title: String           -> タイトル
     *      author: String          -> 投稿者メールアドレス
     *      price: int              -> 価格
     *      authorComment: String   -> 投稿者コメント
     *
     * @return bool
     */
    public function regist($data) {
        $res = $this->insert($data);
        return $res;
    }

    /**
     * fetchAllImage: 全画像データの取得
     *
     * @return mixed[]: 連想配列
     *      id: String              -> 作品ID
     *      fileName: String        -> ファイル名
     *      title: String           -> タイトル
     *      author: String          -> 投稿者メールアドレス
     *      postDate: String        -> 投稿日時
     *      price: int              -> 価格
     *      authorComment: String   -> 投稿者コメント
     */
    public function fetchAllImage() {
        $sql = "SELECT id, fileName, title, author, postDate, price, authorComment";
        $rows = $this->query($sql);
        return $rows;
    }

}