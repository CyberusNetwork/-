#!/bin/sh
#Script de creation du graphique Memoire disque

# Pour 1 jour
/usr/local/bin/rrdtool graph /var/www/htdocs/admin/rrdtool/graph/diskused-1d.png \
--start -86400 --end now \
--vertical-label "en %" \
--width 500 \
--height 200 \
--title "Quantité de mémoire DISK utilisée sur 1 jour" \
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
DEF:diskused=/var/rrdtool/db/diskused.rrd:diskused:AVERAGE \
AREA:diskused#046380:"Mémoire DISK utilisée"
