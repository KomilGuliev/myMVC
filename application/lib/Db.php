<?php

namespace application\lib;
use PDO;

class Db {
    protected $db;
    function __construct() {
        $config = require 'application/config/db.php';
        //debug($config);
        $this->db = new PDO('mysql:host='.$config['host'].';dbname='.$config['name'].';charset=utf8', $config['user'], $config['password']);
    }

    public function query($sql,$params = []) {
        
        $stms = $this->db->prepare($sql);
        if(!empty($params)) {
            foreach($params as $key => $val) {
                $stms->bindValue(':'.$key, $val);
            }
        }

        $stms->execute();
        return $stms;
    }

    
    public function row($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    public function column($sql, $params = []) {
        $result = $this->query($sql, $params);
        return $result->fetchColumn();
    }

}