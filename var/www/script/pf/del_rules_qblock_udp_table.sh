#!/bin/sh
# ./del_rules_qblock_udp.sh in/out macro_interface macro_port table
# Ajoute une règle quick block udp utilisant une table dynamique


# Pointeur
in_out=$1
interface=$2
port=$3
table=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
  then
  echo "Erreur : il faut entrer 4 argument."
  echo "./del_rules_qblock_udp.sh in/out macro_interface macro_port table"
  sudo /usr/local/bin/gsed -n '/'\#\ Quick_block_udp'/,/'\#\ Fin'/ p' /etc/pf/quick_block.conf
  exit 2
fi

# Supprime une règle quick block
  sudo /usr/local/bin/gsed -i '/block '$in_out' log quick on '\$$interface\_macro' proto udp from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/quick_block.conf

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/quick_block.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

  # Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Quick_block_udp'/,/'\#\ Fin'/ p' /etc/pf/quick_block.conf
  exit 2
else
  echo "Error de syntaxe"
  sudo /usr/bin/sed -n '/'\#\ Quick_block_udp'/,/'\#\ Fin'/ p' /etc/pf/quick_block.conf
  exit 2
fi