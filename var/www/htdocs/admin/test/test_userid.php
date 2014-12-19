<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 02/09/2014
 * Time: 14:04
 */

class UserIDModel {

    private $userid;
    private $username;

    function __construct()
    {
        // Connexion - DataBase - Admin
        $this->db_access_admin = new PDO ('mysql:host=localhost;dbname=admin', 'admin', 'c4EDKnXADZdBLhp7');
        $this->db_access_root = new PDO ('mysql:host=localhost;dbname=admin', 'root', 'ksrehylee85');
    }

    public function setUsername ($username)
    {
        $this->username = $username;
    }

    public function getUserId()
    {
        $sql_req_userid = $this->db_access_admin->prepare('SELECT * FROM user WHERE username = :username');
        $sql_req_userid->execute(array(
            'username' => $this->username
        ));
        $data_userid = $sql_req_userid->fetch();
        $this->userid = $data_userid['id'];
        return $this->userid;

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
}

$user = new UserIDModel();


$username = 'test1';
$password = 'test';
$server = 'localhost';
$user->setUsername($username);
$userid = $user->getUserId();
$user->createDB($password, $server);

var_dump($username);
var_dump($password);
var_dump($userid);