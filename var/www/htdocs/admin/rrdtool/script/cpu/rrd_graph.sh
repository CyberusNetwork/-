#!/bin/sh
# Script pour la génération des graphique sur de la base de donnée RRDTools pour l'utilisation du CPU

# Pour 1 Heure
/usr/local/bin/rrdtool graph /var/www/htdocs/admin/rrdtool/graph/cpuused-1h.png \
--start -3600 --end now \
--vertical-label "en %" \
--width 500 \
--height 200 \
--title "Pourcentage du CPU utilisée sur 1 heure" \
--slope-mode \
--watermark "`date`" \
--color CANVAS#000000 \
--color BACK#333333 \
--color FONT#C0C0C0 \
--color MGRID#EFECCA \
--color GRID#A7A37E \
--color FRAME#808080 \
--color ARROW#FFFFFF \
--color SHADEA#404040 \
--color SHADEB#404040 \
DEF:cpuuser=/var/rrdtool/db/cpuused.rrd:user:AVERAGE \
DEF:cpusys=/var/rrdtool/db/cpuused.rrd:sys:AVERAGE \
AREA:cpuuser#046380:"CPU utilisée - user" \
STACK:cpusys#C03000:"CPU utilisée - system" \

# Pour 1 jour
/usr/local/bin/rrdtool graph /var/www/htdocs/admin/rrdtool/graph/cpuused-1d.png \
--start -86400 --end now \
--vertical-label "en %" \
--width 500 \
--height 200 \
--title "Pourcentage du CPU utilisée sur 1 jour" \
--slope-mode \
--watermark "`date`" \
--color CANVAS#000000 \
--color BACK#333333 \
--color FONT#C0C0C0 \
--color MGRID#EFECCA \
--color GRID#A7A37E \
--color FRAME#808080 \
--color ARROW#FFFFFF \
--color SHADEA#404040 \
--color SHADEB#404040 \
DEF:cpuuser=/var/rrdtool/db/cpuused.rrd:user:AVERAGE \
DEF:cpusys=/var/rrdtool/db/cpuused.rrd:sys:AVERAGE \
AREA:cpuuser#046380:"CPU utilisée - user" \
STACK:cpusys#C03000:"CPU utilisée - system" \

# Pour 1 semaine
/usr/local/bin/rrdtool graph /var/www/htdocs/admin/rrdtool/graph/cpuused-1w.png \
--start -604800 --end now \
--vertical-label "en %" \
--width 500 \
--height 200 \
--title "Pourcentage du CPU utilisée sur 1 semaine" \
--slope-mode \
--watermark "`date`" \
--color CANVAS#000000 \
--color BACK#333333 \
--color FONT#C0C0C0 \
--color MGRID#EFECCA \
--color GRID#A7A37E \
--color FRAME#808080 \
--color ARROW#FFFFFF \
--color SHADEA#404040 \
--color SHADEB#404040 \
DEF:cpuuser=/var/rrdtool/db/cpuused.rrd:user:AVERAGE \
DEF:cpusys=/var/rrdtool/db/cpuused.rrd:sys:AVERAGE \
AREA:cpuuser#046380:"CPU utilisée - user" \
STACK:cpusys#C03000:"CPU utilisée - system" \
