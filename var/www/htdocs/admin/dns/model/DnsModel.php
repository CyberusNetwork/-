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

    private $db_access_admin;
    private $datas_dns;

    // Functions

    function __construct()
    {
        // Connexion - DataBase - Admin
        include (__DIR__ . "/../../sql_config.php");
    }

    // Initialization of the data "DNS" for processing
    public function init()
    {
        $sql_dns = "SELECT * FROM dns";
        $response = $this->db_access_admin->query($sql_dns);
        if($response){
            $this->datas_dns = $response->fetchAll();
        }
    }

    public function getDatas()
    {
        return $this->datas_dns;
    }

    public function createDns(
        $domain,
        $type,
        $target)
    {
        $sql_req_add_dns = $this->db_access_admin->prepare('INSERT INTO dns VALUES (:id, :domain, :type, :target, NOW())');
        $sql_req_add_dns->execute(array(
            'id' => NULL,
            'domain' => $domain,
            'type' => $type,
            'target' => $target
        ));

        //Shell part
        $sh_domain = escapeshellcmd($domain);
        $sh_type = escapeshellcmd($type);
        $sh_target = escapeshellcmd($target);
        $sh_req_add_sd = exec("sudo unbound-control local_data $sh_domain $sh_type $sh_target");
        //return $sh_req_add_sd;
    }

    public function deleteDns($domain)
    {
        $sql_req_del_domain = $this->db_access_admin->prepare('DELETE FROM dns WHERE domain = :domain');
        $sql_req_del_domain->execute(array(
            'domain' => $domain
        ));

        //Shell part
        $sh_del_domain = escapeshellcmd($domain);
        $sh_req_del_sd = exec("sudo unbound-control local_data_remove $sh_del_domain");
        //return $sh_req_del_sd;
    }
}