#!/bin/sh
# ./del_rules_pass_qos_table.sh macro_interface macro_port table name_parent name_child
# Supprime une queue pass in&out tcp&udp utilisant une table dynamique

# Pointeur
interface=$1
port=$2
table=$3
name_parent=$4
name_child=$5


if [ $# -ne 5 ] # Vérifie qu'il y a seulement 5 argument entré
  then
  echo "Erreur : il faut entrer 5 argument."
  echo "./add_rules_pass_qos.sh macro_interface macro_port table name_parent name_child"
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_QOS'/,/'\#\ Fin_pass\_$name_parent'/ p' /etc/pf/pass.conf
  exit 2
fi

# Supprime la queue pass utilisant une table dynamique
  sudo /usr/local/bin/gsed -i '/pass log on '\$$interface\_macro' proto { tcp, udp } from { <'$table'> } to port '\$$port\_macro' set queue '$name_child\_$name_parent'/d' /etc/pf/pass.conf

# Enlève les sauts de ligne en trop
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
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_QOS'/,/'\#\ Fin_pass\_$name_parent'/ p' /etc/pf/pass.conf
  exit 2
else
  echo "Error de syntaxe"
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_QOS'/,/'\#\ Fin_pass\_$name_parent'/ p' /etc/pf/pass.conf
  exit 2
fi