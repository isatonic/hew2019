<?php

namespace model\physical;

/**
 * Friendsテーブル操作クラス
 *
 * @package model\physical
 */
class Friends extends ModelBase {

    /**
     * フレンド登録
     *
     * @param string      $friend   フレンドに登録する相手のID
     * @param string|null $who      ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function add(string $friend, string $who = null) {
        $who = $this->setUser($who);
        $data = array(
            "user"      => $who,
            "friend"    => $friend
        );
        return $this->execInsert($data);
    }

    /**
     * フレンドをブロック
     *
     * @param string      $friend   ブロックする相手のID
     * @param string|null $who      ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function block(string $friend, string $who = null) {
        $who = $this->setUser($who);
        $data["flag"] = "block";
        $where = array(
            "user" => $who,
            "friend" => $friend
        );
        return $this->execUpdate($data, $where);
    }

    /**
     * ブロック解除
     *
     * @param string      $target   ブロック解除する対象のID
     * @param string|null $who      ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function unblock(string $target, string $who = null) {
        $who = $this->setUser($who);
        $data["flag"] = "active";
        $where = array(
            "user" => $who,
            "friend" => $target
        );
        return $this->execUpdate($data, $where);
    }


    /**
     * フレンドリスト取得
     *
     * @param string|null $who ユーザID (Default: ログイン中ID)
     *
     * @return array {
     *      数字配列のフレンドリスト
     *
     *      @type array {
     *          @type string "friend"   フレンドのID
     *          @type string "flag"     フレンドの状態("active":通常, "block":ブロック中)
     *      }
     * }
     */
    public function fetchList(string $who = null) {
        $who = $this->setUser($who);
        $wants = ["friend", "flag"];
        $where = ["user" => $who];

        return $this->getRows($wants, $where);
    }

}