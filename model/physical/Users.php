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
     * update: ユーザ情報の更新
     *
     * @param $data
     *      $data[列名] = 値
     * @param $who
     *      メールアドレス
     *
     * @return bool
     */
    public function update($data, $who) {
        $keyval = array();
        foreach ($data as $key => $val) {
            $keyval[] = "${key}=${val}";
        }
        $sql = sprintf("UPDATE %s SET", $this->table_name);
        $sql = sprintf("$sql %s WHERE email LIKE %s", implode(", ", $keyval), $who);
        $stmt = $this->db->prepare($sql);
        $res = $stmt->execute();
        return $res;
    }

}