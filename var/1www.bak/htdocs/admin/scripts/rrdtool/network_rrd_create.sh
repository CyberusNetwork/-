#!/bin/sh
# Script de création de la base de données RRDTools pour l'utilisation du réseau

#Sis0
/usr/local/bin/rrdtool create /var/www/htdocs/admin/db/netsis0.rrd \
--step 60 \
DS:in:COUNTER:120:0:U \
DS:out:COUNTER:120:0:U \
RRA:AVERAGE:0.5:1:1440 \
RRA:AVERAGE:0.5:15:672 \
RRA:AVERAGE:0.5:60:168 \

#Sis1
/usr/local/bin/rrdtool create /var/www/htdocs/admin/db/netsis1.rrd \
--step 60 \
DS:in:COUNTER:120:0:U \
DS:out:COUNTER:120:0:U \
RRA:AVERAGE:0.5:1:1440 \
RRA:AVERAGE:0.5:15:672 \
RRA:AVERAGE:0.5:60:168 \

#Sis2
/usr/local/bin/rrdtool create /var/www/htdocs/admin/db/netsis2.rrd \
--step 60 \
DS:in:COUNTER:120:0:U \
DS:out:COUNTER:120:0:U \
RRA:AVERAGE:0.5:1:1440 \
RRA:AVERAGE:0.5:15:672 \
RRA:AVERAGE:0.5:60:168 \

#Sis3
/usr/local/bin/rrdtool create /var/www/htdocs/admin/db/netsis3.rrd \
--step 60 \
DS:in:COUNTER:120:0:U \
DS:out:COUNTER:120:0:U \
RRA:AVERAGE:0.5:1:1440 \
RRA:AVERAGE:0.5:15:672 \
RRA:AVERAGE:0.5:60:168 \

#Sis4
/usr/local/bin/rrdtool create /var/www/htdocs/admin/db/netsis4.rrd \
--step 60 \
DS:in:COUNTER:120:0:U \
DS:out:COUNTER:120:0:U \
RRA:AVERAGE:0.5:1:1440 \
RRA:AVERAGE:0.5:15:672 \
RRA:AVERAGE:0.5:60:168