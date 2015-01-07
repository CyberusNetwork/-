#!/bin/sh
# Script pour l'update de la base de données RRDTools pour l'utilisation du réseau

# Récupération des informations sur les interfaces

#Sis1 - MGMT
sis1in=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifInOctets.2 | /usr/bin/awk '{print $4}')
sis1out=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifOutOctets.2 | /usr/bin/awk '{print $4}')

# Update de RRDTool

#Sis1
/usr/local/bin/rrdtool update /var/rrdtool/db/netsis1.rrd N:$sis1in:$sis1out