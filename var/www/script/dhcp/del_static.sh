#!/bin/sh


ligne=$(sed -n '/'$1'/=' /etc/dhcpd.conf)
limite='5'
compteur='0'
while test "$compteur" != "$limite"
do sed ''$ligne'd' /etc/dhcpd.conf >> tt
mv tt /etc/dhcpd.conf
 echo "$ligne"
let "compteur = compteur + 1"
done
