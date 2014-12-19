#!/bin/sh
# ./delete_pass_tcp_port.sh interface/'$free' port
# Supprime le passage d'un flux de port du protocol tcp dans l'interface

#Pointeur
interface=$1
port=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./delete_pass_tcp_port.sh "interface/'$free'" "port""
    exit 2
fi
# Vérifie s'il existe déjà
/usr/local/bin/gsed -i '/pass in log on '$interface' proto tcp to port '$port'/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Montre la table de passage du TCP_port
sed -n '/'\#\ TCP_port'/,/'\#\ Fin_tcp'/ p' /etc/pf.conf