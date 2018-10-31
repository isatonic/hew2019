<?php

class Users extends ModelBase {

    /**
     * regist: ユーザ登録
     *      (参照: ./ModelBase.php)
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
     * changeInfo: ユーザ情報変更
     *
     * @param $data:    ["列名"] = 更新値
     * @param $who:     メールアドレス
     */
    public function changeInfo($data, $who) {
        $where = sprintf("WHERE email LIKE %s", $who);
        $this->update($data, $where);
    }

    /**
     * changeStatus: 利用状況変更
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
        $res = $this->update($data, $who);
        return $res;
    }

}