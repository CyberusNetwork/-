#!/bin/sh
# ./add_rules_pass_qos.sh 'name_parent' 'in/out' 'interface' 'inet4/6' 'proto' 'ip' 'port' name_child'"
# Ajoute une règle qui laisse passer tous les paquets entrant/sortant d'une interface déterminé  par la règle enfant de la QOS.

# Pointeur
name_parent=$1
in_out=$2
interface=$3
inet=$4
proto=$5
ip=$6
port=$7
name_child=$8

if [ $# -ne 8 ] # Vérifie qu'il y a seulement 8 argument entré
  then
  echo "Erreur : il faut entrer 8 argument."
  echo "./add_rules_pass_qos.sh 'name_parent' 'in/out' 'interface' 'inet4/6' 'proto' 'ip' 'port' name_child'"
  echo "  Pass_QOS "
  sudo /usr/local/bin/gsed -n '/'\#\ Pass_queue'/,/'\#\ Fin_end'/ p' /etc/pf/pass.conf
  exit 2
fi

# Vérifie s'il existe déjà
  sudo /usr/local/bin/gsed -i '/all set queue '$name_child'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/pass '$in_out' on '\$$interface\_macro' '$inet' proto '$proto' from '$ip' to any port '$port'/d' /etc/pf/pass.conf

# Permet d'ajouter la règle de passage de qos
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_QOS/a pass '$in_out' on '\$$interface\_macro' '$inet' proto '$proto' from '$ip' to any port '$port' set queue '$name_child'' /etc/pf/pass.conf

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