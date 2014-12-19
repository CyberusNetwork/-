<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 09/09/2014
 * Time: 00:15
 */

class TestModel {

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
        var_dump($this->userid);

        if ($req_sql == true){
            $this->datas_account = $sql_user->fetch();

            if (count($this->datas_account) > 0){
                $req_user = $this->datas_account;
                $this->username = $req_user['username'];
                var_dump($this->username);
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

}

$userid = "29";
$domain = "dev.fairsys.fr";
$server = "localhost";

$account = new TestModel($userid);
$account->init();

$username = $account->getUsername();

$user_domain = $username.".".$domain;

var_dump($userid);
var_dump($username);
var_dump($user_domain);
die;