#!/bin/sh
# ./del_rules_queue.sh
# Supprime toute les règle de QOS

# Purge les règles de QOS
  sudo /usr/local/bin/gsed -i '/'\#\ QOS'/,/'\#\ Fin'/{/'\#\ QOS'/b;/'\#\ Fin'/b;/.*/d}' /etc/pf.conf
  sudo /usr/local/bin/gsed -i '/'\#\ Block_QOS'/,/'\#\ Fin'/{/'\#\ QOS'/b;/'\#\ Fin'/b;/.*/d}' /etc/pf.conf
  sudo /usr/local/bin/gsed -i '/'\#\ Pass_QOS'/,/'\#\ Fin'/{/'\#\ QOS'/b;/'\#\ Fin'/b;/.*/d}' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
  exit 2