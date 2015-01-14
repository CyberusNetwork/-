#!/bin/sh
# ./add_rules_queue_parent.sh "name_parent_macro" "interface_macro" "bandwidth"
# Ajoute la règle parent QOS

# Pointeur
name_parent=$1
interface=$2
bandwidth=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 arguments entré
  then
  echo "Erreur : il faut entrer 3 arguments."
  echo "add_rules_queue_parent.sh "name_parent_macro" "interface_macro" "bandwidth""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Purge les règles de QOS
  sudo /usr/local/bin/gsed -i '/'\#\ QOS'/,/'\#\ Fin'/{/'\#\ QOS'/b;/'\#\ Fin'/b;/.*/d}' /etc/pf.conf
  sudo /usr/local/bin/gsed -i '/'\#\ Block_QOS'/,/'\#\ Fin'/{/'\#\ QOS'/b;/'\#\ Fin'/b;/.*/d}' /etc/pf.conf
  sudo /usr/local/bin/gsed -i '/'\#\ Pass_QOS'/,/'\#\ Fin'/{/'\#\ QOS'/b;/'\#\ Fin'/b;/.*/d}' /etc/pf.conf

# Ajoute le parent de la QOS
  sudo /usr/local/bin/gsed -i '/QOS/a queue '$name_parent' on '\$$interface\_macro' bandwidth '$bandwidth'' /etc/pf.conf

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
  exit 2