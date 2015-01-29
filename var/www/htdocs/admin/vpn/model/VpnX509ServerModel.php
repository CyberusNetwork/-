<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 21/01/2015
 * Time: 10:56
 */

class VpnX509ServerModel {

    // Attributes

    private $db_access_admin;
    private $datas_vpn;
    private $selectedServerX509;

    // Functions

    function __construct()
    {
        // Connexion - DataBase - Admin
        include (__DIR__ . "/../../sql_config.php");
    }

    // Initialization of the data "VPN" for processing


    public function init()
    {
        $sql_vpn = "SELECT * FROM vpn_x509_server";
        $response = $this->db_access_admin->query($sql_vpn);
        if($response){
            $this->datas_vpn = $response->fetchAll();
        }
    }

    public function getDatasServerX509()
    {
        return $this->datas_vpn;
    }

    public function setServerX509($ipserver)
    {
        $sql_req_selectedServerX509 = $this->db_access_admin->prepare("SELECT * FROM vpn_x509_server WHERE ipserver = :ipserver");
        $sql_req_selectedServerX509->execute(array(
            'ipserver' => $ipserver
        ));
        if($sql_req_selectedServerX509){
            $this->selectedServerX509 = $sql_req_selectedServerX509->fetch();
        }
    }

    public function getSelectedServerX509()
    {
        return $this->selectedServerX509;
    }


    public function createServerX509(
        $servername,
        $ipserver,
        $mask,
        $port,
        $interface)
    {
        $sql_req_add_ServerX509 = $this->db_access_admin->prepare('INSERT INTO vpn_x509_server VALUES (:id, :servername, :ipserver, :mask, :port, :interface, :active, :nwn_active, NOW())');
        $sql_req_add_ServerX509->execute(array(
            'id' => NULL,
            'servername' => $servername,
            'ipserver' => $ipserver,
            'mask' => $mask,
            'port' => $port,
            'interface' => $interface,
            'active' => "1",
            'nwn_active' => "0"
        ));

        //Shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_mask = escapeshellcmd($mask);
        $sh_port = escapeshellcmd($port);
        $sh_interface = escapeshellcmd($interface);
        $sh_req_add_ServerX509 = exec("/var/www/script/vpn/add_dynamic_server_x509_crl.sh $sh_ipserver $sh_mask $sh_port, $sh_interface");
        return $sh_req_add_ServerX509;
    }

    public function deleteServerX509($id,$ipserver)
    {
        $sql_req_del_ServerX509 = $this->db_access_admin->prepare('DELETE FROM vpn_x509_server WHERE id = :id');
        $sql_req_del_ServerX509->execute(array(
            'id' => $id
        ));

        //Shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_req_del_ServerX509 = exec("/var/www/script/vpn/del_dynamic_server_x509_crl.sh $sh_ipserver");
        return $sh_req_del_ServerX509;
    }

    public function enableServerX509 (
        $id,
        $ipserver
        )
    {
        $sql_req_enable_serverX509 = $this->db_access_admin->prepare('UPDATE vpn_x509_server SET active = :active WHERE id = :id');
        $sql_req_enable_serverX509->execute(array(
            'id' => $id,
            'active' => '1'
        ));

    //shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_type = 'x509';
        $sh_req_enable_serverX509 = exec("/var/www/script/vpn/enable_server.sh $sh_ipserver $sh_type");
        return $sh_req_enable_serverX509;

    }

    public function disableServerX509 (
        $id,
        $ipserver
    )
    {
        $sql_req_disable_serverX509 = $this->db_access_admin->prepare('UPDATE vpn_x509_server SET active = :active WHERE id = :id');
        $sql_req_disable_serverX509->execute(array(
            'id' => $id,
            'active' => '0'
        ));

        //shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_type = 'x509';
        $sh_req_disable_serverX509 = exec("/var/www/script/vpn/disable_server.sh $sh_ipserver $sh_type");
        return $sh_req_disable_serverX509;
    }

    public function enableNWNServerX509 (
        $id,
        $ipserver
    )
    {
        $sql_req_enable_NWN_serverX509 = $this->db_access_admin->prepare('UPDATE vpn_x509_server SET nwn_active = :nwn_active WHERE id = :id');
        $sql_req_enable_NWN_serverX509->execute(array(
            'id' => $id,
            'nwn_active' => '1'
        ));

        //shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_type = 'x509';
        $sh_req_enable_serverX509 = exec("/var/www/script/vpn/enable_network_neighborhood.sh $sh_ipserver $sh_type");
        return $sh_req_enable_serverX509;

    }

    public function disableNWNServerX509 (
        $id,
        $ipserver
    )
    {
        $sql_req_disable_NWN_serverX509 = $this->db_access_admin->prepare('UPDATE vpn_x509_server SET nwn_active = :nwn_active WHERE id = :id');
        $sql_req_disable_NWN_serverX509->execute(array(
            'id' => $id,
            'nwn_active' => '0'
        ));

        //shell part
        $sh_ipserver = escapeshellcmd($ipserver);
        $sh_type = 'x509';
        $sh_req_disable_serverX509 = exec("/var/www/script/vpn/disable_network_neighborhood.sh $sh_ipserver $sh_type");
        return $sh_req_disable_serverX509;
    }

}
