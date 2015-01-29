<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 21/01/2015
 * Time: 10:56
 */

class VpnPskClientModel {

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
        $sql_vpn = "SELECT * FROM vpn_psk_client";
        $response = $this->db_access_admin->query($sql_vpn);
        if($response){
            $this->datas_vpn = $response->fetchAll();
            echo 'Hello PSK Client';
        }
    }

    public function getDatasClientPSK()
    {
        return $this->datas_vpn;
    }

    public function createClientPSK(
        $servername,
        $clientname,
        $ipserver,
        $iptunserver,
        $iptunclient,
        $port,
        $interface)
    {
        $sql_req_add_ClientPSK = $this->db_access_admin->prepare('INSERT INTO vpn_psk_client VALUES (:id, :servername, :clientname, :ipserver, :tunserver, :tunclient, :port, :interface, NOW())');
        $sql_req_add_ClientPSK->execute(array(
            'id' => NULL,
            'servername' => $servername,
            'clientname' => $clientname,
            'ipserver' => $ipserver,
            'tunserver' => $iptunserver,
            'tunclient' => $iptunclient,
            'port' => $port,
            'interface' => $interface,
        ));

        //Shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_iptunserver = escapeshellcmd($iptunserver);
        $sh_iptunclient = escapeshellcmd($iptunclient);
        $sh_port = escapeshellcmd($port);
        $sh_interface = escapeshellcmd($interface);
        $sh_req_add_ClientPSK = exec("/var/www/script/vpn/add_static_client_pre_shared_keys.sh $sh_ipserver $sh_iptunserver $sh_iptunclient $sh_port, $sh_interface");
        return $sh_req_add_ClientPSK;
    }

    public function deleteClientPSK($id, $ipserver, $clientname)
    {
        $sql_req_del_ClientPSK = $this->db_access_admin->prepare('DELETE FROM vpn_psk_client WHERE id = :id');
        $sql_req_del_ClientPSK->execute(array(
            'id' => $id
        ));

        //Shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_clientname = escapeshellcmd($clientname);
        $sh_req_del_ClientPSK = exec("/var/www/script/vpn/del_static_client_pre_shared_keys.sh $sh_ipserver $sh_clientname");
        return $sh_req_del_ClientPSK;
    }

}
