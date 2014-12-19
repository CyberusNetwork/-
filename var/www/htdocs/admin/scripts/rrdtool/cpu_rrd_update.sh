#!/bin/sh
# Script pour l'update de la base de données RRDTools pour l'utilisation du CPU

# Récupération des informations du CPU - user et sys
cpuuser=$(vmstat 1 2 | /usr/bin/tail -n1 | /usr/bin/awk '{print $16}')
cpusys=$(vmstat 1 2 | /usr/bin/tail -n1 | /usr/bin/awk '{print $17}')

/usr/local/bin/rrdtool update /var/www/htdocs/admin/db/cpuused.rrd N:$cpuuser:$cpusys
