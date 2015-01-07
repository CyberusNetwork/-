#!/bin/sh
# ./add_rules_pass_udp_port.sh interface/'$free' port
# Ajoute une règle pour le passage d'un flux de port du protocol udp dans une interface

#Pointeur
interface=$1
port=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./add_rules_pass_udp_port.sh "interface/'$free'" "port""
    echo " MACRO "
    sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf.conf
    echo " Rules UDP_port"
    sed -n '/'\#\ UDP_port'/,/'\#\ Fin_tcp'/ p' /etc/pf.conf
    exit 2
fi

# Vérifie s'il existe déjà
/usr/local/bin/gsed -i '/pass in log on '$interface' proto udp to port '$port'/d' /etc/pf.conf

# Permet d'ajouter le passage du flux
/usr/local/bin/gsed -i '/UDP_port/a pass in log on '$interface' proto udp to port '$port'' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Montre la table de passage du TCP_port
sed -n '/'\#\ UDP_port'/,/'\#\ Fin_udp'/ p' /etc/pf.conf