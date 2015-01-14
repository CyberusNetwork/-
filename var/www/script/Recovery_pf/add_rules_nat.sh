#!/bin/sh
# ./add_rules_nat.sh 'macro_interface' ip
# Ajoute une règle de NAT 

# Pointeur
interface=$1
ip=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./add_rules_nat.sh 'macro_interface' ip "
    echo " MACRO "
	sudo /usr/bin/sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf.conf
	echo " Rules NAT "
	sudo /bin/cat /etc/pf.conf | grep "nat-to"
    exit 2
fi

# Vérifie si la NAT existe si oui il le supprime
	sudo /usr/local/bin/gsed -i '/match out on '\$$interface\_macro' from '$ip' nat-to ('\$$interface\_macro')/d' /etc/pf.conf

# Ajoute la NAT
	sudo /usr/local/bin/gsed -i '/NAT/a match out on '\$$interface\_macro' from '$ip' nat-to ('\$$interface\_macro')' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# Montre les règles de NAT du fichier pf.conf
	sudo /bin/cat /etc/pf.conf | grep "nat-to"
	exit 2