#!/bin/sh
# ./delete_port_forwarding.sh interface proto port_ext ip_lan port_int
# Supprime le  port forwarding

# Pointeur
interface=$1
protocol=$2
port_ext=$3
ip_lan=$4
port_int=$5

if [ $# -ne 5 ] # Vérifie qu'il y a seulement 5 argument entré
    then
    echo "Erreur : il faut entrer 5 argument."
    echo "./delete_port_forwarding.sh "interface" "protocol" "port_ext" "ip_lan" "port_int""
    exit 2
fi

# Supprime le port forwarding
/usr/local/bin/gsed -i '/pass in log on '$interface' proto '$protocol' from any to any port '$port_ext' rdr-to '$ip_lan' port '$port_int'/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Montre le port forwarding du fichier pf.conf
cat /etc/pf.conf | grep "rdr-to"
