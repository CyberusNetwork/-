#!/bin/sh
# Script de création de la base de données RRDTools pour l'utilisation du disque dur

/usr/local/bin/rrdtool create /var/rrdtool/db/diskused.rrd \
--step 60 \
DS:diskused:GAUGE:2400:0:U \
RRA:AVERAGE:0.5:20:504
