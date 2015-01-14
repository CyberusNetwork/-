#!/bin/sh
# ./disable_QOS_parent.sh "name_parent_macro"
# Désactive une règle parent de QOS

# Pointeur
name_parent=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 arguments entré
  then
  echo "Erreur : il faut entrer 1 arguments."
  echo "disable_QOS_parent.sh "name_parent""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Place un # entre deux mot clé
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_QOS/,/# Fin_'$name_parent'/ s/^/#/' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_block_QOS/,/# Fin/ s/^/#/' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_pass_QOS/,/# Fin/ s/^/#/' /etc/pf/pass.conf
  
# Retient 0 ligne vide au début, 1 à la fin
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/pass.conf

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin_end'/ p' /etc/pf/queue.conf
  exit 2