#!/bin/sh
# ./delete_block_port_table_ip.sh interface/'$lan' proto table port
# Permet de supprimer la régle de blocage du port par une table ip au préalable créée

# Pointeur
interface=$1
protocol=$2
table=$3
port=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
    then
    echo "Erreur : il faut entrer 4 argument."
    echo "./delete_block_port_table_ip.sh "interface/'$lan'" "proto" "table" "port""
    exit 2
fi

# Permet de créer la règle de blocage de port par table ip
/usr/local/bin/gsed -i '/block in quick on '$interface' proto '$protocol' from { <'$table'> } port '$port'/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Affiche les ports ip bloqué
cat /etc/pf.conf | grep "block in quick on"