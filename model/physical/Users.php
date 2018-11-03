<?php

class Users extends ModelBase {

    /**
     * ユーザ登録
     *
     * @param $data
     *      $data[列名] = 値
     *
     * @return bool
     */
    public function regist($data) {
        $res = $this->insert($data);
        return $res;
    }

    /**
     * ユーザ情報変更
     *
     * @param $data :    ["列名"] = 更新値
     * @param $who :     メールアドレス
     *
     * @return bool
     */
    public function changeInfo($data, $who) {
        $where = sprintf("email LIKE %s", $who);
        $res = $this->update($data, $where);
        return $res;
    }

    /**
     * 利用状況変更
     *
     * @param $to
     *      メール認証完了 -> "active"
     *      退会           -> "unsubscribed"
     *      一時利用停止   -> "paused"
     *      BAN            -> "banned"
     *
     * @param $who
     *      メールアドレス
     *
     * @return bool
     */
    public function changeStatus($to, $who) {
        $data['flag'] = $to;
        $res = $this->changeInfo($data, $who);
        return $res;
    }

}