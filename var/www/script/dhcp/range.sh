#!/bin/bash


if [ "$1" == "LAN" ]
then
ligne=$(sed -n '/'$1'/=' /etc/dhcpd.conf)

let "ligne =ligne + 3" 
sed ''$ligne'd' /etc/dhcpd.conf >> tt 
mv tt /etc/dhcpd.conf

/usr/local/bin/gsed -i "/192.168.3.1/a range $2 $3" /etc/dhcpd.conf


else

ligne=$(sed -n '/'$1'/=' /etc/dhcpd.conf)
let "ligne =ligne + 3" 
sed ''$ligne'd' /etc/dhcpd.conf >> tt 
mv tt /etc/dhcpd.conf

/usr/local/bin/gsed -i "/192.168.4.1/a range $2 $3" /etc/dhcpd.conf 

fi
