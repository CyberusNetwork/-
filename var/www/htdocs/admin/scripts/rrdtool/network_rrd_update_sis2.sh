#!/bin/sh
# Script pour l'update de la base de données RRDTools pour l'utilisation du réseau

# Récupération des informations sur les interfaces

#Sis2 - Reserved
sis2in=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifInOctets.3 | /usr/bin/awk '{print $4}')
sis2out=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifOutOctets.3 | /usr/bin/awk '{print $4}')

# Update de RRDTool

#Sis2
/usr/local/bin/rrdtool update /var/www/htdocs/admin/db/netsis2.rrd N:$sis2in:$sis2out