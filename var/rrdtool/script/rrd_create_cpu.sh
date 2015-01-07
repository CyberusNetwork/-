#!/bin/sh
# Script de création de la base de données RRDTools pour l'utilisation du CPU

/usr/local/bin/rrdtool create /var/rrdtool/db/cpuused.rrd \
--step 60 \
DS:user:GAUGE:120:0:U \
DS:sys:GAUGE:120:0:U \
RRA:AVERAGE:0.5:1:1440 \
RRA:AVERAGE:0.5:15:672 \
RRA:AVERAGE:0.5:60:168
