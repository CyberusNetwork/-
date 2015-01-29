<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 21/01/2015
 * Time: 10:56
 */

class VpnPskServerModel {

    // Attributes

    private $db_access_admin;
    private $datas_vpn;
    private $selectedServerPSK;

    // Functions

    function __construct()
    {
        // Connexion - DataBase - Admin
        include (__DIR__ . "/../../sql_config.php");
    }

    // Initialization of the data "VPN" for processing
    public function init()
    {
        $sql_vpn = "SELECT * FROM vpn_psk_server";
        $response = $this->db_access_admin->query($sql_vpn);
        if($response){
            $this->datas_vpn = $response->fetchAll();
        }
    }

    public function getDatasServerPSK()
    {
        return $this->datas_vpn;
    }

    public function setServerPSK($ipserver)
    {
        $sql_req_selectedServerPSK = $this->db_access_admin->prepare("SELECT * FROM vpn_psk_server WHERE ipserver = :ipserver");
        $sql_req_selectedServerPSK->execute(array(
            'ipserver' => $ipserver
        ));
        if($sql_req_selectedServerPSK){
            $this->selectedServerPSK = $sql_req_selectedServerPSK->fetch();
        }
    }

    public function getSelectedServerPSK()
    {
        return $this->selectedServerPSK;
    }

    public function createServerPSK(
        $servername,
        $ipserver,
        $iptunserver,
        $iptunclient,
        $port,
        $interface)
    {
        $sql_req_add_ServerPSK = $this->db_access_admin->prepare('INSERT INTO vpn_psk_server VALUES (:id, :servername, :ipserver, :tunserver, :tunclient, :port, :interface, :active, NOW())');
        $sql_req_add_ServerPSK->execute(array(
            'id' => NULL,
            'servername' => $servername,
            'ipserver' => $ipserver,
            'tunserver' => $iptunserver,
            'tunclient' => $iptunclient,
            'port' => $port,
            'interface' => $interface,
            'active' => "1",
        ));

        //Shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_tunserver = escapeshellcmd($iptunserver);
        $sh_tunclient = escapeshellcmd($iptunclient);
        $sh_port = escapeshellcmd($port);
        $sh_interface = escapeshellcmd($interface);
        $sh_req_add_ServerPSK = exec("/var/www/script/vpn/add_static_server_pre_shared_keys.sh $sh_ipserver $sh_tunserver $sh_tunclient $sh_port, $sh_interface");
        return $sh_req_add_ServerPSK;
    }

    public function deleteServerPSK($id,$ipserver)
    {
        $sql_req_del_ServerPSK = $this->db_access_admin->prepare('DELETE FROM vpn_psk_server WHERE id = :id');
        $sql_req_del_ServerPSK->execute(array(
            'id' => $id
        ));

        //Shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_req_del_ServerPSK = exec("/var/www/script/vpn/del_static_server_pre_shared_keys.sh $sh_ipserver");
        return $sh_req_del_ServerPSK;
    }

    public function  enableServerPSK (
        $id,
        $ipserver
        )
    {
        $sql_req_enable_serverPSK = $this->db_access_admin->prepare('UPDATE vpn_psk_server SET active = :active WHERE id = :id');
        $sql_req_enable_serverPSK->execute(array(
            'id' => $id,
            'active' => '1'
        ));

    //shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_type = 'psk';
        $sh_req_enable_serverPSK = exec("/var/www/script/vpn/enable_server.sh $sh_ipserver $sh_type");
        return $sh_req_enable_serverPSK;

    }

    public function  disableServerPSK (
        $id,
        $ipserver
        )
    {
        $sql_req_disable_serverPSK = $this->db_access_admin->prepare('UPDATE vpn_psk_server SET active = :active WHERE id = :id');
        $sql_req_disable_serverPSK->execute(array(
            'id' => $id,
            'active' => '0'
        ));

        //shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_type = 'psk';
        $sh_req_disable_serverPSK = exec("/var/www/script/vpn/disable_server.sh $sh_ipserver $sh_type");
        return $sh_req_disable_serverPSK;
    }

}
