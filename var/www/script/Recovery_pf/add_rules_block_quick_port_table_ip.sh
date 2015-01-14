#!/bin/sh
# ./add_rules_block_quick_port_table_ip.sh interface proto table port
# Ajoute une règle quick qui bloque l'accès d'un port par une table d'ip au préalable créée

# Pointeur
interface=$1
protocol=$2
table=$3
port=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
    then
    echo "Erreur : il faut entrer 4 argument."
    echo "./add_rules_block_quick_port_table_ip.sh "interface" "proto" "table" "port""
    echo " MACRO "
	sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf.conf
	echo " Rules Block access port with IP"
	cat /etc/pf.conf | grep "block in log quick on"
    exit 2
fi
# Vérifie s'il existe déjà
	sudo /usr/local/bin/gsed -i '/block in log quick on'\$$interface\_macro' proto '$protocol' from { <'$table'> } port '$port'/d' /etc/pf.conf
	sudo /usr/local/bin/gsed -i '/block in log on'\$$interface\_macro' proto '$protocol' from { <'$table'> } port '$port'/d' /etc/pf.conf

# Permet de créer la règle de blocage de port par table ip
	sudo /usr/local/bin/gsed -i '/Quick_block/a block in log quick on '\$$interface\_macro' proto '$protocol' from { <'$table'> } port '$port'' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
#/sbin/pfctl -f /etc/pf.conf

# Affiche les ports ip bloqué
	sudo /bin/cat /etc/pf.conf | grep "block in quick on"
	echo " Done "
fi