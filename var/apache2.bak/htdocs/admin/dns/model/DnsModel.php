<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 24/08/2014
 * Time: 13:58
 */

// Model DNS --> Storing and data backup of table DNS

class DnsModel {

    // Attributes

    private $userid; // --> Variable commune à l'ensemble du site
    private $username;
    private $db_access_admin;
    private $datas_dns;


    // Functions

    function __construct($userid)
    {
        $this->userid = $userid;
        // Connexion - DataBase - Admin
        $this->db_access_admin = new PDO ('mysql:host=localhost;dbname=admin', 'admin', 'c4EDKnXADZdBLhp7');
    }

    // Initialization of the data "DNS" for processing
    public function init()
    {
        $sql_dns = "SELECT * FROM dns WHERE user_id = $this->userid";
        $response = $this->db_access_admin->query($sql_dns);
        if($response){
            $this->datas_dns = $response->fetchAll();

        }
    }

    public function getDatas()
    {
        return $this->datas_dns;
    }

    public function setUsername($username)
    {
     $this->username = $username;
    }

    public function createUserDns(
        $type,
        $target
    )
    {
        $sql_req_add_user = $this->db_access_admin->prepare('INSERT INTO dns VALUES (:id, :userid, :sub_dom, :type, :target, NOW())');
        $sql_req_add_user->execute(array(
            'id' => NULL,
            'userid' => $this->userid,
            'sub_dom' => "ROOT",
            'type' => $type,
            'target' => $target
        ));


        //Shell part
        $sh_user = escapeshellarg($this->username);
        $sh_type = escapeshellarg($type);
        $sh_target = escapeshellarg($target);
        $sh_req_add_user = shell_exec("./dns/script/add_dns.sh $sh_user $sh_type $sh_target");
    }

    public function createUserSubDomainDns(
        $subdomain,
        $type,
        $target)
    {
        $sql_req_add_user = $this->db_access_admin->prepare('INSERT INTO dns VALUES (:id, :userid, :sub_dom, :type, :target, NOW())');
        $sql_req_add_user->execute(array(
            'id' => NULL,
            'userid' => $this->userid,
            'sub_dom' => $subdomain,
            'type' => $type,
            'target' => $target
        ));


        //Shell part
        $sh_subdomain = escapeshellarg($subdomain);
        $sh_user = escapeshellarg($this->username);
        $sh_type = escapeshellarg($type);
        $sh_target = escapeshellarg($target);
        $sh_req_add_sd = shell_exec("./script/add_sd_dns.sh $sh_subdomain $sh_user $sh_type $sh_target");
    }

    public function deleteUserSubDomainDns(
        $subdomain,
        $type,
        $target)
    {
        $sql_req_del_subdomain_user = $this->db_access_admin->prepare('DELETE FROM dns WHERE user_id= :userid AND sub_dom = :sub_dom');
        $sql_req_del_subdomain_user->execute(array(
            'userid' => $this->userid,
            'sub_dom' => $subdomain
        ));


        //Shell part
        $sh_del_subdomain = escapeshellarg($subdomain);
        $sh_user = escapeshellarg($this->username);
        $sh_type = escapeshellarg($type);
        $sh_target = escapeshellarg($target);
        $sh_req_del_sd = shell_exec("./script/del_sd_dns.sh $sh_del_subdomain $sh_user $sh_type $sh_target");
    }

    public function deleteUserSubDomainDnsFinal(
        $subdomain,
        $type,
        $target)
    {
        $sql_req_del_subdomain_user = $this->db_access_admin->prepare('DELETE FROM dns WHERE user_id= :userid AND sub_dom = :sub_dom');
        $sql_req_del_subdomain_user->execute(array(
            'userid' => $this->userid,
            'sub_dom' => $subdomain
        ));


        //Shell part
        $sh_del_subdomain = escapeshellarg($subdomain);
        $sh_user = escapeshellarg($this->username);
        $sh_type = escapeshellarg($type);
        $sh_target = escapeshellarg($target);
        $sh_req_del_sd = shell_exec("/../../script/del_sd_dns.sh $sh_del_subdomain $sh_user $sh_type $sh_target");
    }

    public function deleteUser()
    {
        $sql_req_del_user = $this->db_access_admin->prepare('DELETE FROM dns WHERE userid = :userid');
        $sql_req_del_user->execute(array(
            'userid' => $this->userid
        ));


        //Shell part
        $sh_user = escapeshellarg($this->username);
        $sh_req_del_user = shell_exec("/../../script/del_dns.sh $sh_user");
    }

}