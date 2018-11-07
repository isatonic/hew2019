<?php

/**
 * Friendsテーブル操作クラス
 */
class Friends extends ModelBase {

    /**
     * フレンド登録
     *
     * @param string $user      主体となるユーザのメールアドレス
     * @param string $friend    フレンドに登録する相手のメールアドレス
     *
     * @return bool
     */
    public function add(string $user, string $friend) {
        $data = array(
            "user"      => $user,
            "friend"    => $friend
        );
        $res = $this->insert($data);
        return $res;
    }

    /**
     * フレンドをブロック
     *
     * @param string $user      主体となるユーザのメールアドレス
     * @param string $friend    ブロックする相手のメールアドレス
     *
     * @return bool
     */
    public function block(string $user, string $friend) {
        $data["flag"] = "block";
        $where = "user LIKE '$user' and friend LIKE '$friend'";
        $res = $this->update($data, $where);
        return $res;
    }

    /**
     * フレンドリスト取得
     *
     * @param string $user  メールアドレス
     *
     * @return array {
     *      数字配列のフレンドリスト
     *
     *      @type array {
     *          @type string "friend"   フレンドのメールアドレス
     *          @type string "flag"     フレンドの状態("active":通常, "block":ブロック中)
     *      }
     * }
     */
    public function fetchList(string $user) {
        $sql = "SELECT friend, flag FROM Friends WHERE user LIKE :user";
        $param = array(
            "user"  => $user
        );
        $rows = $this->query($sql, $param);
        return $rows;
    }

}