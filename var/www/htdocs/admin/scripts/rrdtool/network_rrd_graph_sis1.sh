#!/bin/sh
# Script pour la génération des graphique sur de la base de donnée RRDTools pour l'utilisation de l'interface réseau SIS1 - MGMT

# Pour 1 Heure
/usr/local/bin/rrdtool graph /var/www/htdocs/admin/graph/network-sis0-1h.png \
--start -3600 --end now \
--vertical-label "Kilo-octet" \
--width 500 \
--height 200 \
--title "Flux IN/OUT sur la sis1 (MGMT) - 1 heure" \
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
DEF:in=/var/www/htdocs/admin/db/netsis1.rrd:in:AVERAGE \
DEF:out=/var/www/htdocs/admin/db/netsis1.rrd:out:AVERAGE \
CDEF:in_bits=in,8,* \
CDEF:out_bits=out,8,* \
LINE3:in_bits#046380:"Traffic IN" \
LINE3:out_bits#C03000:"Traffic OUT" \

# Pour 1 jour
/usr/local/bin/rrdtool graph /var/www/htdocs/admin/graph/network-sis1-1d.png \
--start -86400 --end now \
--vertical-label "Kilo-octet" \
--width 500 \
--height 200 \
--title "Flux IN/OUT sur la sis1 (MGMT) - 1 jour" \
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
DEF:in=/var/www/htdocs/admin/db/netsis1.rrd:in:AVERAGE \
DEF:out=/var/www/htdocs/admin/db/netsis1.rrd:out:AVERAGE \
CDEF:in_bits=in,8,* \
CDEF:out_bits=out,8,* \
LINE3:in_bits#046380:"Traffic IN" \
LINE3:out_bits#C03000:"Traffic OUT" \

# Pour 1 Semaine
/usr/local/bin/rrdtool graph /var/www/htdocs/admin/graph/network-sis1-1w.png \
--start -604800 --end now \
--vertical-label "Kilo-octet" \
--width 500 \
--height 200 \
--title "Flux IN/OUT sur la sis1 (MGMT) - 1 semaine" \
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
DEF:in=/var/www/htdocs/admin/db/netsis1.rrd:in:AVERAGE \
DEF:out=/var/www/htdocs/admin/db/netsis1.rrd:out:AVERAGE \
CDEF:in_bits=in,8,* \
CDEF:out_bits=out,8,* \
LINE3:in_bits#046380:"Traffic IN" \
LINE3:out_bits#C03000:"Traffic OUT"
