#!/bin/sh
# Script pour l'update de la base de données RRDTools pour l'utilisation de la RAM

# Récupération des informations de la RAM
ramfreeko=$(vmstat | /usr/bin/tail -n1 | /usr/bin/awk '{print $5}')
ramtotbytes=$(sysctl -n hw.physmem)
let "ramtotko=$ramtotbytes / 1024"
let "ramused=$ramtotko-$ramfreeko"

# Update de RRDTool
/usr/local/bin/rrdtool update /var/www/htdocs/admin/db/ramused.rrd N:$ramused