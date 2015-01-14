#!/bin/sh
# ./del_rules_nat.sh ip 'interface'
# Permet d'enlever une règle de NAT 

# Pointeur
interface=$1
ip=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./del_rules_nat.sh 'interface' ip "
	cat /etc/pf.conf | grep "nat-to"
    exit 2
fi

# Supprime la règle de nat
	sudo /usr/local/bin/gsed -i '/match out on '$interface' from '$ip' nat-to ('$interface')/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# Montre les règles de NAT du fichier pf.conf
	sudo /bin/cat /etc/pf.conf | grep "nat-to"
	exit 2