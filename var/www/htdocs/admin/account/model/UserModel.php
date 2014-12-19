<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 27/08/2014
 * Time: 13:39
 * Model USER -> Récupération et sauvegarde des données de la table USER
 */

class UserModel {

    // Les attibuts.
    private $username;
    private $userid;
    private $db_access_admin;

    // Les fonctions.
    function __construct()
    {
        // Connexion - DataBase - Admin.
        $this->db_access_admin = new PDO ('mysql:host=localhost;dbname=admin', 'admin', 'c4EDKnXADZdBLhp7');
        end __construct()
    }

    // Initialization of the data "DNS" for processing.
    public function init(
        $login,
        $crypted_password
    )
    {
        $sql_user = $this->db_access_admin->prepare('SELECT * FROM user WHERE username = :login AND password = :crypted_password');
        $req_sql = $sql_user->execute(array(
            'login' => $login,
            'crypted_password' => $crypted_password
        ));

        if ($req_sql == true){
            $data_login = $sql_user->fetchAll();
            if (count($data_login) > 0){
                $req_user = $data_login[0];
                $this->userid = $req_user['id'];
                $this->username = $req_user['username'];
            }
        }
    }

    public function checkUserByLogin (
        $login
    )
    {
        $sql_user = $this->db_access_admin->prepare('SELECT * FROM user WHERE username = :login');
        $req_sql = $sql_user->execute(array(
            'login' => $login,
        ));
        if ($req_sql == true){
            $data_login = $sql_user->fetchAll();
            if (count($data_login) > 0){
                return true;
            }
        }
        return false;
    }

    public function checkUserPassword (
        $login,
        $crypted_password
    )
    {
        $sql_user = $this->db_access_admin->prepare('SELECT * FROM user WHERE username = :login AND password = :crypted_password');
            $req_sql = $sql_user->execute(array(
                'login' => $login,
                'crypted_password' => $crypted_password
            ));
        if ($req_sql == true){
            $data_login = $sql_user->fetchAll();
            if (count($data_login) > 0){
                return true;
            }
        }
        return false;
    }

    public function getUserid()
    {
        return $this->userid;
    }

    public function getUsername()
    {
        return $this->username;
    }

}
