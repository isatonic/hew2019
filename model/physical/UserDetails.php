<?php

namespace model\physical;

/**
 * UserDetailsテーブル操作クラス
 *
 * @package model\physical
 */
class UserDetails extends ModelBase {

    /**
     * ユーザ登録
     *
     * @param string      $id       ユーザID
     * @param string      $userName アプリ内で公開されるユーザ名
     * @param string|null $icon     アイコンのファイルパス (Default: null)
     *
     * @return bool
     */
    public function regist(string $id, string $userName, string $icon = null) {
        $data = array(
            "id" => $id,
            "userName" => $userName,
            "icon" => $icon
        );

        return $this->insert($data);
    }

    /**
     * ユーザ情報変更
     *
     * @param array       $data ["変更する列名"] = 変更値
     * @param string|null $id   ユーザID (Default: ログイン中ID)
     *
     * @return bool
     */
    public function changeInfo(array $data, string $id = null) {
        $id = $this->setUser($id);
        $where = sprintf("id LIKE %s", $id);
        $res = $this->update($data, $where);

        return $res;
    }

    /**
     * ユーザ情報を取得
     *
     * ユーザが存在しない場合は`false`を返す
     *
     * @param string|null $id ユーザID (Default: ログイン中ID)
     *
     * @return bool|array {
     *      @type string "userName"  アプリケーション中で公開されるユーザ名
     *      @type string "icon"      アイコンのファイルパス (""の可能性あり)
     * }
     */
    public function get(string $id = null) {
        $id = $this->setUser($id);
        $sql = "SELECT userName, icon FROM UserDetails WHERE id LIKE :id";
        $params = array(
            "id" => $id
        );
        $rows = $this->query($sql, $params);
        if (!is_null($rows)) {
            return $rows[0];
        } else {
            return false;
        }
    }

}