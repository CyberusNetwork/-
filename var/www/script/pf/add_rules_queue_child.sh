#!/bin/sh
# ./add_rules_queue_child.sh "name_parent" "name_child" "bandwidth"
# Ajoute une règle enfant QOS

# Pointeur
name_parent=$1
name_child=$2
bandwidth=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 arguments entré
  then
  echo "Erreur : il faut entrer 3 arguments."
  echo "add_rules_queue_child.sh "name_parent" "name_child" "bandwidth""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Vérifie si la règle existe si oui il le supprime
  sudo /usr/local/bin/gsed -i '/'$name_child' parent '$name_parent' bandwidth/d' /etc/pf/queue.conf

# Ajoute le parent de la QOS
  sudo /usr/local/bin/gsed -i '/queue '$name_parent' on /a queue '$name_child' parent '$name_parent'' /etc/pf/queue.conf

# Ajoute le nom de la macro + sa fonction
	sudo /usr/local/bin/gsed -i "s/queue ${name_child} parent ${name_parent}/queue ${name_child} parent ${name_parent} bandwidth ${bandwidth}/g" /etc/pf/queue.conf

# Retient 0 ligne vide au début, 1 à la fin
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf

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