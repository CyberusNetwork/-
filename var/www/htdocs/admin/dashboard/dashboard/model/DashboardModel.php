<?php
/**
 * Created by PhpStorm.
 * User: Adrien
 * Date: 02/01/2015
 * Time: 11:51
 */

class DashboardModel {

    // Functions

    public function getSysName()
    {
        $sysname = exec("/usr/local/bin/snmpget -O qv -v2c -c public localhost SNMPv2-MIB::sysName.0");
        return $sysname;
    }

    public function getSysDesc()
    {
        $sysdesc = exec("/usr/local/bin/snmpget -O qv -v2c -c public localhost SNMPv2-MIB:system.sysDescr.0");
        return $sysdesc;
    }

    public function getSysUpTime()
    {
        $sysuptime = exec("/usr/local/bin/snmpget -O qv -v2c -c public localhost SNMPv2-MIB::sysUpTime.0");
        return $sysuptime;
    }

    public function getSysTime()
    {
        $systime = exec("date");
        return $systime;
    }

    public function  setRrdGraph ($hardware)
    {
        $rddgraph = exec("/script/rrdtool/script/$hardware/rrd_graph.sh");
    }

    public function getInfoIfMac($interface)
    {
        $infoifmac = exec("ifconfig $interface | head -n2 | tail -n1 | awk {'print $2'}");
        return $infoifmac;
    }

    public function getInfoIP($interface)
    {
        $infoifip = exec("ifconfig $interface | tail -n1 | awk {'print $2'}");
        return $infoifip;
    }

    public function getInfoIf($interface)
    {
        $infoifip = exec("ifconfig $interface");
        return $infoifip;
    }

}