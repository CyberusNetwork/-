#!/bin/sh
# Script de création de la base de données RRDTools pour l'utilisation de la RAM

/usr/local/bin/rrdtool create /var/rrdtool/db/ramused.rrd \
--step 60 \
DS:ramused:GAUGE:120:0:U \
RRA:AVERAGE:0.5:1:1440 \
RRA:AVERAGE:0.5:15:672 \
RRA:AVERAGE:0.5:60:168
