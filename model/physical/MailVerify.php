<?php

class MailVerify extends ModelBase {

    /**
     * メール認証を追加
     *
     * @param $email
     *
     * @return bool
     */
    public function add($email) {
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
     * @param int $length
     *      文字数
     *      default: 4
     *
     * @return string
     */
    private function makeRandStr($length = 4) {
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
     * @param int $minute
     *      制限までの時間(分)
     *      default: 30
     *
     * @return string
     *      例: 2018-11-03 00:00:00
     */
    private function setLimit($minute = 30) {
        return date('Y-m-d H:i:s', strtotime("+ $minute minute"));
    }

    /**
     * fetchCode: コードを取得
     *
     * @param $email
     *
     * @return mixed
     *      string ["verifycode"] => コード
     *      string ["verifyLimit"] => 期限(例: "2018-11-04 23:02:21")
     */
    public function fetchCode($email) {
        $sql = "SELECT verifycode, verifyLimit FROM MailVerify WHERE email LIKE :email";
        $params = array(
            "email" => $email
        );

        return $this->query($sql, $params);
    }

}