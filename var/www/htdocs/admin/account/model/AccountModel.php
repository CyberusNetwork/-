<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 24/08/2014
 * Time: 13:28
 */
// Model account --> Storing and data backup of table USER


class AccountModel {

    // Attributes
    private $userid;
    private $username;
    private $db_access_admin;
    private $datas_account;

    // Functions

    function __construct($param_userid)
    {
        $this->userid = $param_userid;
        // Connexion - DataBase - Admin
        $this->db_access_admin = new PDO ('mysql:host=localhost;dbname=admin', 'admin', 'c4EDKnXADZdBLhp7');
    }

    // Initialization of the data "USER" for processing
    public function init()
    {
        $sql_user = $this->db_access_admin->prepare("SELECT * FROM user WHERE id = :userid");
        $req_sql = $sql_user->execute(array(
            'userid' => $this->userid,
        ));

         if ($req_sql == true){
             $this->datas_account = $sql_user->fetch();

             if (count($this->datas_account) > 0){
                $req_user = $this->datas_account;
                $this->username = $req_user['username'];
                }
         }
    }

    public function getDatas()
    {
        return $this->datas_account;
    }

    public function getUsername()
    {
        return $this->username;
    }

    public function editUser(
        $username,
        $lastname,
        $firstname,
        $email,
        $password,
        $md5_password)
    {
        $sql_req_password_change = $this->db_access_admin->prepare(
            "UPDATE user SET lastname = :lastname, firstname = :firstname, mail = :email, password = :md5_password WHERE id = :userid");
        $sql_req_password_change->execute(array(
            'userid' => $this->userid,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'md5_password' => $md5_password
        ));

        //Shell part
        $sh_req_add_user = exec("./script/ch_password_ftp.sh $username $password");
    }

    public function deleteUser()
    {
        $sql_req_del_user = $this->db_access_admin->prepare("DELETE FROM user WHERE id = :userid");
        $sql_req_del_user->execute(array(
            'userid' => $this->userid
        ));

        //Shell part
        $sh_user = escapeshellarg($this->username);
        $sh_req_add_user = shell_exec("./script/del_user_ftp.sh $sh_user");
    }

}
