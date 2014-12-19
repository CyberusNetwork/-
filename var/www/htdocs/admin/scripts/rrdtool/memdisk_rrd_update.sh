#!/bin/sh
# Script RRDTool pour la mémoire du disque dur

diskused=$(/bin/df -kP / | /usr/bin/tail -n1 | /usr/bin/awk '{print $5}' | /usr/bin/sed 's/%$//')

/usr/local/bin/rrdtool update /var/www/htdocs/admin/db/diskused.rrd N:$diskused