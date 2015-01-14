#!/bin/sh
# ./del_rules_block_port_table_ip.sh interface proto table port
# Supprime la régle quick de blocage du port par une table ip au préalable créée

# Pointeur
interface=$1
protocol=$2
table=$3
port=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
    then
    echo "Erreur : il faut entrer 4 argument."
    echo "./del_rules_quick_block_port_table_ip.sh "interface" "proto" "table" "port""
    cat /etc/pf.conf | grep "block in log quick on"
    exit 2
fi

# Supprime la règle block quick
	sudo /usr/local/bin/gsed -i '/block in log quick on '\$$interface\_macro' proto '$protocol' from { <'$table'> } port '$port'/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
#/sbin/pfctl -f /etc/pf.conf

# Affiche les ports ip bloqué
	sudo /bin/cat /etc/pf.conf | grep "block in quick on"
	echo " Done "
fi