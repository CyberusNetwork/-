#!/bin/sh
#1 nom
#2 adresse mac
#3 adresse IP
#faire verif ip avec le php

echo " " >> /etc/dhcpd.conf
echo "host $1 {"  >> /etc/dhcpd.conf
echo "hardware ethernet $2;"  >> /etc/dhcpd.conf
echo "fixed-adress $3;"  >> /etc/dhcpd.conf
echo "}"  >> /etc/dhcpd.conf
