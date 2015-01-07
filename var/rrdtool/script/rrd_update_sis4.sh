#!/bin/sh
# Script pour l'update de la base de données RRDTools pour l'utilisation du réseau

# Récupération des informations sur les interfaces

#Sis4 - FREE/PROXAD
sis4in=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifInOctets.5 | /usr/bin/awk '{print $4}')
sis4out=$(/usr/local/bin/snmpget -v2c -c public localhost IF-MIB::ifOutOctets.5 | /usr/bin/awk '{print $4}')

# Update de RRDTool

#Sis4 - FREE/PROXAD
/usr/local/bin/rrdtool update /var/rrdtool/db/netsis4.rrd N:$sis4in:$sis4out