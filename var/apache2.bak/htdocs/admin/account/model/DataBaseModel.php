<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 03/09/2014
 * Time: 22:53
 */

class DataBaseModel {

    private $username;

    function __construct()
    {
        // Connexion - DataBase - Admin
        $this->db_access_root = new PDO ('mysql:host=localhost;dbname=admin', 'root', 'ksrehylee85');
    }

    public function setUsername ($username)
    {
        $this->username = $username;
    }

    public function createDB($password, $server)
    {

        $sql_req_createDB_1 = $this->db_access_root->prepare("CREATE USER :username@:server IDENTIFIED BY :password");
        $sql_req_createDB_2 = $this->db_access_root->prepare("GRANT USAGE ON *.* TO :username@:server IDENTIFIED BY :password WITH MAX_QUERIES_PER_HOUR 0 MAX_CONNECTIONS_PER_HOUR 0 MAX_UPDATES_PER_HOUR 0 MAX_USER_CONNECTIONS 0");
        $sql_req_createDB_3 = $this->db_access_root->prepare("CREATE DATABASE IF NOT EXISTS $this->username");
        $sql_req_createDB_4 = $this->db_access_root->prepare("GRANT ALL PRIVILEGES ON $this->username .* TO :username@:server");
        $sql_req_createDB_1->execute(array(
            'username' => $this->username,
            'server' => $server,
            'password' => $password
        ));
        $sql_req_createDB_2->execute(array(
            'username' => $this->username,
            'server' => $server,
            'password' => $password
        ));
        $sql_req_createDB_3->execute();
        $sql_req_createDB_4->execute(array(
            'username' => $this->username,
            'server' => $server,
        ));
    }

    public function editDB($password,$server)
    {
        $sql_req_edit_DB = $this->db_access_root->prepare("SET PASSWORD FOR :username@:server = PASSWORD( :password )");
        $sql_req_edit_DB->execute(array(
            'username' => $this->username,
            'server' => $server,
            'password' => $password
        ));
    }

    public function deleteDB($server)
    {

        $sql_req_del_DB_1 = $this->db_access_root->prepare("DROP USER :username@:server ");
        $sql_req_del_DB_2 = $this->db_access_root->prepare("DROP DATABASE IF EXISTS $this->username");
        $sql_req_del_DB_1->execute(array(
            'username' => $this->username,
            'server' => $server
        ));
        $sql_req_del_DB_2->execute();
    }

}