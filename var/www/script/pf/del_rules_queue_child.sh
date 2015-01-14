#!/bin/sh
# ./del_rules_queue_child.sh "name_parent" "name_child"
# Supprime une règle enfant et ses options QOS

# Pointeur
name_parent=$1
name_child=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 arguments entré
  then
  echo "Erreur : il faut entrer 2 arguments."
  echo "sh del_rules_queue_child.sh "name_parent" "name_child""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Vérifie si la règle existe si oui il le supprime
  sudo /usr/local/bin/gsed -i '/'$name_child' parent '$name_parent' bandwidth/d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/parent '$name_child' bandwidth/d' /etc/pf/queue.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'$name_parent'_QOS/,/ Fin_'$name_parent'/ p' /etc/pf/queue.conf
  exit 2
else
  echo "Erreur de syntaxe"
  exit 2
fi