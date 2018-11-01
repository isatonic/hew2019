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

}