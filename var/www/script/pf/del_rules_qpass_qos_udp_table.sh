#!/bin/sh
# ./del_rules_qpass_qos_udp.sh in/out macro_interface macro_port table name_parent name_child 
# Supprime une queue quick pass in&out udp utilisant une table dynamique

# Pointeur
in_out=$1
interface=$2
port=$3
table=$4
name_parent=$5
name_child=$6

if [ $# -ne 6 ] # Vérifie qu'il y a seulement 6 argument entré
  then
  echo "Erreur : il faut entrer 6 argument."
  echo "./del_rules_qpass_qos_udp.sh in/out macro_interface macro_port table name_parent name_child "
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_udp_quick_QOS'/,/'\#\ Fin_pass_udp_quick\_$name_parent'/ p' /etc/pf/quick_pass.conf
  exit 2
fi

# Supprime la queue quick pass
  sudo /usr/local/bin/gsed -i '/pass '$in_out' quick log on '\$$interface\_macro' proto udp from { <'$table'> } to port '\$$port\_macro' set queue '$name_child\_$name_parent'/d' /etc/pf/quick_pass.conf

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/quick_pass.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

  # Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_udp_quick_QOS'/,/'\#\ Fin_pass_udp_quick\_$name_parent'/ p' /etc/pf/quick_pass.conf
  exit 2
else
  echo "Error de syntaxe"
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_udp_quick_QOS'/,/'\#\ Fin_pass_udp_quick\_$name_parent'/ p' /etc/pf/quick_pass.conf
  exit 2
fi