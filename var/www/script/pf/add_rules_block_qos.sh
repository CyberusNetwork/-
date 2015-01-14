#!/bin/sh
# ./add_rules_block_qos.sh name_parent interface inet4/6 name_child
# Ajoute une règle qui bloque tous les paquets sortant d'une interface déterminé  par la QOS (default).

# Pointeur
name_parent=$1
interface=$2
inet=$3
name_child=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 3 argument entré
  then
  echo "Erreur : il faut entrer 3 argument."
  echo "./add_rules_block_qos.sh 'name_parent' 'interface' 'inet4/6' 'name_child'"
  sudo /usr/local/bin/gsed -n '/'\#\ Block_queue'/,/'\#\ Fin_end'/ p' /etc/pf/block.conf
  exit 2
fi

# Vérifie si la règle de blocage est présent si oui il le supprime
  sudo /usr/local/bin/gsed -i '/set queue '$name_child'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/block return out on '\$$interface\_macro' '$inet' all set queue '$name_child'/d' /etc/pf/block.conf

# Permet d'ajouter la règle de blocage qos
	sudo /usr/local/bin/gsed -i '/'$name_parent'_block_QOS/a block return out on '\$$interface\_macro' '$inet' all set queue '$name_child'' /etc/pf/block.conf

# Retient 0 ligne vide au début, 1 à la fin
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
  sudo /usr/bin/sed -n '/'\#\ Block_queue'/,/'\#\ Fin_end'/ p' /etc/pf/block.conf
  exit 2
else
  echo "Error de syntaxe"
  exit 2
fi