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
        $this->insertSql($data);
        $this->exec($data);
        return $this->getResult();
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
        $where = "user LIKE '$who' and friend LIKE '$friend'";
        $res = $this->update($data, $where);
        return $res;
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
        $where = "user LIKE $who and friend LIKE $target";
        return $this->update($data, $where);
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
        $this->selectSql($wants, $where);
        $this->exec();
        $this->getAssoc();
        return $this->getRows();
    }

}