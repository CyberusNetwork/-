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
    private $username;
    private $db_access_admin;
    private $datas_account;
    private $selected_datas;

    // Functions

    // DateBase connection process by USERID

    function __construct()
    {
        //$this->userid = $param_userid;
        // DataBase - Admin config file
        include (__DIR__ . "/../../sql_config.php");
    }

    // Initialization of the data "USER" for processing

    public function init()
    {
        $sql_account = "SELECT * FROM user";
        $response = $this->db_access_admin->query($sql_account);
        if($response){
            $this->datas_account = $response->fetchAll();
        }
    }

    // Storing datas from database
    public function getDatas()
    {
        return $this->datas_account;
    }

    // Storing datas from database
    public function setSelectedDatas($userid)
    {
        $sql_user = $this->db_access_admin->prepare("SELECT * FROM user WHERE id = :userid");
        $req_sql = $sql_user->execute(array(
            'userid' => $userid,
        ));
        if ($req_sql == true) {
            $this->selected_datas = $sql_user->fetch();
            if (count($this->selected_datas) > 0){
                $req_user = $this->selected_datas;
                $this->username = $req_user['username'];
                }
        }
    }

    // Getting selected Datas
    public function getSelectedDatas()
    {
        return $this->selected_datas;
    }

    // Getting the username
    public function getSelectedUsername()
    {
        return $this->username;
    }

    // Edit selected account / personnal informations
    public function editUser(
        $flaguserid,
        $username,
        $lastname,
        $firstname,
        $email,
        $password,
        $md5_password)
    {
        $sql_req_edit_user = $this->db_access_admin->prepare(
            "UPDATE user SET lastname = :lastname, firstname = :firstname, mail = :email, password = :md5_password WHERE id = :userid");
        $sql_req_edit_user->execute(array(
            'userid' => $flaguserid,
            'lastname' => $lastname,
            'firstname' => $firstname,
            'email' => $email,
            'md5_password' => $md5_password
        ));

        //Shell part
        $sh_username = escapeshellcmd($username);
        $sh_password = escapeshellcmd($password);
        $sh_req_add_user = exec("sudo usermod -p $(echo $sh_password | openssl passwd -1 -stdin) $sh_username");
    }

    // Delete the selected account
    public function deleteUser(
        $flaguserid,
        $username)
    {
        $sql_req_del_user = $this->db_access_admin->prepare("DELETE FROM user WHERE id = :userid");
        $sql_req_del_user->execute(array(
            'userid' => $flaguserid,
        ));

        //Shell part
        $sh_user = escapeshellcmd($username);
        $sh_req_del_user = exec("sudo userdel $sh_user");
    }
}
