<?php
/**
 * Created by PhpStorm.
 * User: adrienthibault
 * Date: 24/08/2014
 * Time: 13:58
 */

class DhcpModel {

    // Attributs

    private $db_access_admin;
    private $datas_static;
    private $datas_range;

    // Functions

    function __construct()
    {
        // Connexion - DataBase - Admin
        include (__DIR__ . "/../../sql_config.php");
    }

    // Initialization of the data "DHCP" for processing

    public function initStaticIP()
    {
        $sql_dhcp_ip_static = "SELECT * FROM dhcp_static";
        $response = $this->db_access_admin->query($sql_dhcp_ip_static);
        if($response){
            $this->datas_static = $response->fetchAll();
        }
    }

    public function initRange($interface)
    {
        $sql_dhcp_ip_range = "SELECT * FROM dhcp_range WHERE interface = '$interface'";
        $response = $this->db_access_admin->query($sql_dhcp_ip_range);
        if($response){
            $this->datas_range = $response->fetchAll();
        }
    }

    public function getDatasStaticIP()
    {
        return $this->datas_static;
    }

    public function getDatasRange()
    {
        return $this->datas_range;
    }

    public function checkStaticIP($mac)
    {
        $sql_dhcp_mac_check = "SELECT * FROM dhcp_range WHERE mac = '$mac'";
        $response = $this->db_access_admin->query($sql_dhcp_mac_check);
        return $response;

    }

        public function editRange(
        $interface,
        $ip_start,
        $ip_end
        )
    {
        $sql_req_edit_range = $this->db_access_admin->prepare('UPDATE dhcp_range SET ipstart = :ipstart, ipend = :ipend WHERE interface = :interface');
        $sql_req_edit_range->execute(array(
            'interface' => $interface,
            'ipstart'=> $ip_start,
            'ipend' =>$ip_end
        ));

        //Shell part
        $sh_ipstart = escapeshellcmd($ip_start);
        $sh_ipend = escapeshellcmd($ip_end);
        $sh_interface = escapeshellcmd($interface);
        $sh_req_edit_range = exec("/var/www/script/dhcp/range.sh $sh_interface $sh_ipstart $sh_ipend");
        //return $sh_req_edit_range;
    }

    public function newStaticIP(
        $hostname,
        $ip,
        $mac
        )
    {
        $sql_req_new_static = $this->db_access_admin->prepare('INSERT INTO dhcp_static VALUES(:id, :mac, :ip, :hostname, NOW())');
        $sql_req_new_static->execute(array(
            'id' => NULL,
            'mac' => $mac,
            'ip' => $ip,
            'hostname' => $hostname
        ));

        //Shell part
        $sh_hostname = escapeshellcmd($hostname);
        $sh_mac = escapeshellcmd($mac);
        $sh_ip = escapeshellcmd($ip);
        $sh_req_new_static = exec("/var/www/script/dhcp/add_static.sh $sh_hostname $sh_mac $sh_ip");
        //return $sh_req_new_static;

    }

    public function deleteStaticIP(
        $id,
        $hostname
    )
    {
        $sql_req_new_static = $this->db_access_admin->prepare('DELETE FROM dhcp_static WHERE id = :id');
        $sql_req_new_static->execute(array(
            'id' => $id,
        ));

        //Shell part
        $sh_hostname = escapeshellcmd($hostname);
        $sh_req_del_static = exec("/var/www/script/dhcp/del_static.sh $sh_hostname");
        //return $sh_req_del_static;

    }

}

