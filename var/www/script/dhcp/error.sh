#!/bin/sh


service=$1
pattern=$2


if [ "$service" == "apache" ] 
then
	echo "apache"
	cat /var/www/logs/error_log | grep $pattern| less
	cat /var/www/logs/access_log | grep $pattern| less
elif [ "$service" == "unbound" ]
then 
	echo "unbound"
	cat /var/unbound/unbound.log |grep $pattern| less
elif [ "$service" == "nsd" ]
then 
	echo "nsd"
	cat /var/nsd/logs/nsd.log | grep $pattern| less
elif [ "$service" == "openvpn" ] 
then
	echo "openVPN"
	log=$(ls /var/log/openvpn/server-log | grep psk)
	cat /var/log/openvpn/server-log/$log/openvpn.log
else
	echo " Saisir un service"
fi


