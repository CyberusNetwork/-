#!/bin/sh
# ./add_rules_block_qos.sh interface inet4/6 name_child
# Ajoute une règle qui bloque tous les paquets sortant d'une interface déterminé  par la QOS (default).

# Pointeur
interface=$1
inet=$2
name_child=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 argument entré
  then
  echo "Erreur : il faut entrer 3 argument."
  echo "./add_rules_block_qos.sh 'interface' 'inet4/6' 'name_child'"
  echo " Block_QOS "
  sudo /usr/local/bin/gsed -n '/'\#\ Block_QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
  exit 2
fi

# Vérifie s'il existe déjà
	sudo /usr/local/bin/gsed -i '/block return out on '\$$interface\_macro' '$inet' all set queue '$name_child'/d' /etc/pf.conf

# Permet d'ajouter la règle de blocage qos
	sudo /usr/local/bin/gsed -i '/Block_QOS/a block return out on '\$$interface\_macro' '$inet' all set queue '$name_child'' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
  #sudo /sbin/pfctl -f /etc/pf.conf

# Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Block_QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
  exit 2