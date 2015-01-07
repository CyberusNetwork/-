#!/bin/sh
# ./del_rules_queue_child.sh "name_parent" "name_child"
# Supprime une règle enfant et ses options QOS

# Pointeur
name_parent=$1
name_child=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 arguments entré
  then
  echo "Erreur : il faut entrer 4 arguments."
  echo "sh del_rules_queue_child.sh "name_parent" "name_child""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Supprime la règle enfant et ses options
  sudo /usr/local/bin/gsed -i '/'$name_child' parent '$name_parent' bandwidth/d' /etc/pf.conf
  sudo /usr/local/bin/gsed -i '/parent '$name_child' bandwidth/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
  exit 2