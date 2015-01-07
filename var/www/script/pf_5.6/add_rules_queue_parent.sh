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
  sudo /usr/local/bin/gsed -i "/'\#\ QOS_'$name_parent''/,/'\#\ Fin'/d" /etc/pf.conf
  sudo /usr/local/bin/gsed -i '/'\#\ Block_QOS'/,/'\#\ Fin'/d' /etc/pf.conf
  sudo /usr/local/bin/gsed -i '/'\#\ Pass_QOS'/,/'\#\' Fin '/d' /etc/pf.conf


sudo /usr/local/bin/gsed -i '/Queue/a  \# QOS_'$name_parent'' /var/www/script/pf_5.6/pf.conf
sudo /usr/local/bin/gsed -i '/QOS_'$name_parent'/a  \# Fin ' /var/www/script/pf_5.6/pf.conf
# Ajoute le parent de la QOS
  sudo /usr/local/bin/gsed -i '/QOS_'$name_parent'/a queue '$name_parent' on '\$$interface\_macro' bandwidth '$bandwidth'' /var/www/script/pf_5.6/pf.conf

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ QOS'/,/'\#\ Fin'/ p' /var/www/script/pf_5.6/pf.conf