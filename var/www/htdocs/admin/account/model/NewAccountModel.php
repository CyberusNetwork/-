<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 28/08/2014
 * Time: 14:46
 */

class NewAccountModel {

    // Attributes

    private $db_access_admin;
    private $userid;
    private $username;

    // Functions

    function __construct()
    {
        // Connexion - DataBase - Admin
        include (__DIR__ . "/../../sql_config.php");
    }

    public function setUsername ($username)
    {
        $this->username = $username;
    }

    public function createUser(
        $username,
        $lastname,
        $firstname,
        $mail,
        $password,
        $md5_password)
    {
        $sql_req_add_user = $this->db_access_admin->prepare('INSERT INTO user VALUES (:id, :username, :lastname, :firstname, :mail, :password, NOW())');
        $sql_req_add_user->execute(array(
            'id' => NULL,
            'username' => $username,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'mail' => $mail,
            'password' => $md5_password
        ));


        //Shell part
        $sh_username = escapeshellcmd($username);
        $sh_password = escapeshellcmd($password);
        $sh_req_add_user = exec("sudo useradd -m -p $(echo $sh_password | openssl passwd -1 -stdin) -s /bin/sh $sh_username");
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
} 