#!/bin/sh
# Script pour l'update de la base de données RRDTools pour l'utilisation du réseau

# Récupération des informations sur les interfaces

#Sis0 - LAN
sis0in=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifInOctets.1 | /usr/bin/awk '{print $4}')
sis0out=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifOutOctets.1 | /usr/bin/awk '{print $4}')

# Update de RRDTool

#Sis0
/usr/local/bin/rrdtool update /var/www/htdocs/admin/db/netsis0.rrd N:$sis0in:$sis0out