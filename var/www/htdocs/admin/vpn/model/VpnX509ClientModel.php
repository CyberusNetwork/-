<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 21/01/2015
 * Time: 10:56
 */

class VpnX509ClientModel {

    // Attributes

    private $db_access_admin;
    private $datas_vpn;

    // Functions

    function __construct()
    {
        // Connexion - DataBase - Admin
        include (__DIR__ . "/../../sql_config.php");
    }

    // Initialization of the data "VPN" for processing
    public function init()
    {
        $sql_vpn = "SELECT * FROM vpn_x509_client";
        $response = $this->db_access_admin->query($sql_vpn);
        if($response){
            $this->datas_vpn = $response->fetchAll();
            echo 'Hello X509 Client';
        }
    }

    public function getDatasClientX509()
    {
        return $this->datas_vpn;
    }

    public function createClientX509(
        $servername,
        $ipserver,
        $mask,
        $port,
        $interface)
    {
        $sql_req_add_ClientX509 = $this->db_access_admin->prepare('INSERT INTO vpn_x509_client VALUES (:id, :servername, :ipserver, :mask, :port, :interface, NOW())');
        $sql_req_add_ClientX509->execute(array(
            'id' => NULL,
            'servername' => $servername,
            'ipserver' => $ipserver,
            'mask' => $mask,
            'port' => $port,
            'interface' => $interface,
        ));

        //Shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_mask = escapeshellcmd($mask);
        $sh_port = escapeshellcmd($port);
        $sh_interface = escapeshellcmd($interface);
        $sh_req_add_ServerX509 = exec("/var/www/script/vpn/add_dynamic_server_x509_crl.sh $sh_ipserver $sh_mask $sh_port $sh_interface");
        return $sh_req_add_ServerX509;
    }

    public function deleteClientX509 (
        $id,
        $ipserver,
        $clientname
        )
    {
        $sql_req_del_ServerX509 = $this->db_access_admin->prepare('DELETE FROM vpn_x509_client WHERE id = :id');
        $sql_req_del_ServerX509->execute(array(
            'id' => $id
        ));

        //Shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_clientname = escapeshellcmd($clientname);
        $sh_req_del_ServerX509 = exec("/var/www/script/vpn/del_dynamic_server_x509_crl.sh $sh_ipserver $sh_clientname");
        return $sh_req_del_ServerX509;
    }


}
