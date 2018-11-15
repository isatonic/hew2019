<?php

namespace model\physical;

/**
 * 認証用クラス
 *
 * ログインなどパスワード認証が必要な場合に使う.
 * 登録, 変更は`model\physical\Password`を使うこと.
 *
 * @package model\physical
 */
class Auth extends ModelBase {

    /**
     * パスワード認証
     *
     * @param string      $pass 入力パスワード
     * @param string|null $id   ユーザID
     *
     * @return bool
     */
    public function check(string $pass, string $id = null) {
        $wants = array(
            "pass",
            "flag"
        );
        $where["id"] = $id;
        $rows = $this->getRows($wants, $where);

        if ($rows != null) {
            if ($rows[0]["flag"] != "active") {
                $hash = $rows[0]["pass"];
                return password_verify($pass, $hash);
            }
        }
        return false;
    }

}