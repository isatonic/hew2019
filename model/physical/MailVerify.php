<?php

class MailVerify extends ModelBase {

    /**
     * メール認証を追加
     *
     * @param string $email メールアドレス
     *
     * @return bool
     */
    public function add(string $email) {
        $data = array(
            "email" => $email,
            "verifycode" => $this->makeRandStr(4),
            "verifyLimit" => $this->setLimit()
        );

        return $this->insert($data);
    }

    /**
     * ランダム文字列を生成
     *
     * @param int $length 文字数 Default: 4
     *
     * @return string
     */
    private function makeRandStr(int $length = 4) {
        static $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJLKMNOPQRSTUVWXYZ0123456789';
        $str = '';
        for ($i = 0; $i < $length; ++$i) {
            $str .= $chars[mt_rand(0, strlen($chars)-1)];
        }

        return $str;
    }

    /**
     * 認証期限日時を取得
     *
     * @param int $minute 制限までの時間(分) Default: 30
     *
     * @return string (YYYY-MM-DD HH:mm:SS)
     */
    private function setLimit(int $minute = 30) {
        return date('Y-m-d H:i:s', strtotime("+ $minute minute"));
    }

    /**
     * fetchCode: コードを取得
     *
     * @param string $email メールアドレス
     *
     * @return array {
     *      @type string "verifycode"   認証コード
     *      @type string "verifyLimit"  認証期限
     * }
     */
    public function fetchCode(string $email) {
        $sql = "SELECT verifycode, verifyLimit FROM MailVerify WHERE email LIKE :email";
        $params = array(
            "email" => $email
        );
        $res = $this->query($sql, $params);

        return $res[0];
    }

}