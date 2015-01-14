#!/bin/sh
# ./test.sh
# Monter les interfaces

  sudo /usr/local/bin/gsed -i '/'\#\ QOS'/,/'\#\ Fin'/{/'\#\ QOS'/b;/'\#\ Fin'/b;/.*/d}' /var/www/htdocs/admin/scripts/pf/pf.conf