#!/bin/sh
# ./add_rules_pass_qos.sh in_out interface inet4/6 name_child
# Ajoute une règle qui laisse passer tous les paquets entrant/sortant d'une interface déterminé  par la règle enfant de la QOS.

# Pointeur
in_out=$1
interface=$2
inet=$3
proto=$4
ip=$5
port=$6
name_child=$6

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
  then
  echo "Erreur : il faut entrer 4 argument."
  echo "./add_rules_pass_qos.sh 'in_out' 'interface' 'inet4/6' 'name_child'"
  echo "  Pass_QOS "
  sudo /usr/local/bin/gsed -n '/'\#\ Pass_QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
  exit 2
fi

# Vérifie s'il existe déjà
	sudo /usr/local/bin/gsed -i '/pass '$in_out' on '\$$interface\_macro' '$inet' proto '$proto' from '$ip' to any port '$port' set queue '$name_child'/d' /etc/pf.conf 

# Permet d'ajouter la règle de passage de qos
	sudo /usr/local/bin/gsed -i '/Pass_QOS/a pass '$in_out' on '\$$interface\_macro' '$inet' proto '$proto' from '$ip' to any port '$port' set queue '$name_child'' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
# sudo /sbin/pfctl -f /etc/pf.conf

# Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Block_QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
  exit 2