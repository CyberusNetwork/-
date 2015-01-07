#!/bin/sh
# Script pour l'update de la base de données RRDTools pour l'utilisation du réseau

# Récupération des informations sur les interfaces

#Sis3 - SFR
sis3in=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifInOctets.4 | /usr/bin/awk '{print $4}')
sis3out=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifOutOctets.4 | /usr/bin/awk '{print $4}')

# Update de RRDTool

#Sis3
/usr/local/bin/rrdtool update /var/rrdtool/db/netsis3.rrd N:$sis3in:$sis3out