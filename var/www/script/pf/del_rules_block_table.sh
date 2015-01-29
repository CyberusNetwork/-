#!/bin/sh
# ./del_rules_block_table.sh macro_interface macro_port table
# Supprime une règle block in&out tcp&udp utilisant une table dynamique

# Pointeur
interface=$1
port=$2
table=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 argument entré
  then
  echo "Erreur : il faut entrer 3 argument."
  echo "./del_rules_block_table.sh macro_interface macro_port table"
  sudo /usr/local/bin/gsed -n '/'\#\ Rules_block'/,/'\#\ Fin'/ p' /etc/pf/block.conf
  exit 2
fi

# Supprime une règle de block utilisant une table dynamique
  sudo /usr/local/bin/gsed -i '/block log on '\$$interface\_macro' proto { tcp, udp } from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/block.conf

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/block.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

  # Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/local/bin/gsed -n '/'\#\ Rules_block'/,/'\#\ Fin'/ p' /etc/pf/block.conf
  exit 2
else
  echo "Error de syntaxe"
  sudo /usr/local/bin/gsed -n '/'\#\ Rules_block'/,/'\#\ Fin'/ p' /etc/pf/block.conf
  exit 2
fi