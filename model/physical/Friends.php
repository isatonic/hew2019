<?php

class Friends extends ModelBase {

    /**
     * add: フレンド登録
     *
     * @param $user
     *      主体となるユーザのメールアドレス
     * @param $friend
     *      フレンドに登録する相手のメールアドレス
     *
     * @return bool
     */
    public function add($user, $friend) {
        $data = array(
            "user"      => $user,
            "friend"    => $friend
        );
        $res = $this->insert($data);
        return $res;
    }

    /**
     * block: フレンドをブロック
     *
     * @param $user
     *      主体となるユーザのメールアドレス
     * @param $friend
     *      ブロックする相手のメールアドレス
     *
     * @return bool
     */
    public function block($user, $friend) {
        $data["flag"] = "block";
        $where = "user LIKE '$user' and friend LIKE '$friend'";
        $res = $this->update($data, $where);
        return $res;
    }

    /**
     * fetchList: フレンドリスト取得
     *
     * @param $user
     *      メールアドレス
     *
     * @return mixed
     *      フレンドのメールアドレス
     */
    public function fetchList($user) {
        $sql = "SELECT friend FROM Friends WHERE user LIKE :user";
        $param = array(
            "user"  => $user
        );
        $rows = $this->query($sql, $param);
        return $rows;
    }

}