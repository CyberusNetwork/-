#!/bin/sh
# ./add_rules_queue_child.sh name_parent macro_interface name_child bandwidth 
# Ajoute une règle enfant QOS

# Pointeur
name_parent=$1
interface=$2
name_child=$3
bandwidth=$4


if [ $# -ne 4 ] # Vérifie qu'il y a 4 arguments entré
  then
  echo "Erreur : il faut entrer 4 arguments."
  echo "add_rules_queue_child.sh name_parent macro_interface name_child "bandwidth""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Vérifie si la règle existe si oui il le supprime
  sudo /usr/local/bin/gsed -i '/'$name_child' parent '$name_parent' bandwidth/d' /etc/pf/queue.conf

# Vérifie si la règle de blocage est présent si oui il le supprime
  sudo /usr/local/bin/gsed -i '/set queue '$name_child'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/block return out on '\$$interface\_macro' set queue '$name_child'/d' /etc/pf/block.conf

# Ajoute la queue parent par défaut
  sudo /usr/local/bin/gsed -i '/Default_'$name_parent'/a queue '$name_child' parent '$name_parent'' /etc/pf/queue.conf

# Ajoute le nom de la macro + sa fonction
  sudo /usr/local/bin/gsed -i "s/queue ${name_child} parent ${name_parent}/queue ${name_child} parent ${name_parent} bandwidth ${bandwidth} default/g" /etc/pf/queue.conf

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf

# Permet d'ajouter la règle de blocage qos
  sudo /usr/local/bin/gsed -i '/'$name_parent'_block_QOS/a block return out on '\$$interface\_macro' set queue '$name_child'' /etc/pf/block.conf

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
  sudo /usr/bin/sed -n '/'$name_parent'_block_QOS/,/ Fin_block_'$name_parent'/ p' /etc/pf/block.conf
  exit 2
else
  echo "Erreur de syntaxe"
  exit 2
fi