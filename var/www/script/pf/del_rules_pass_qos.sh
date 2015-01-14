#!/bin/sh
# ./del_rules_block_qos.sh ip port name_child
# Supprime une règle qui laisse passer tous les paquets entrant/sortant d'une interface déterminé  par la règle enfant de la QOS.

# Pointeur
ip=$1
port=$2
name_child=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 argument entré
  then
  echo "Erreur : il faut entrer 3 argument."
  echo "./del_rules_pass_qos.sh 'ip' 'port' 'name_child'"
  sudo /usr/local/bin/gsed -n '/'\#\ Pass_queue'/,/'\#\ Fin_end'/ p' /etc/pf/pass.conf
  exit 2
fi

# Vérifie si la règle de blocage est présent si oui il le supprime
  sudo /usr/local/bin/gsed -i '/from '$ip' to any port '$port' set queue '$name_child'/d' /etc/pf/pass.conf

# Retient 0 ligne vide au début, 1 à la fin
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/pass.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then
# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf
  echo " La configuration ne contient pas d'erreur de syntaxe "
  # Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Pass_queue'/,/'\#\ Fin_end'/ p' /etc/pf/pass.conf
  exit 2
else
  echo "Error de syntaxe"
  exit 2
fi