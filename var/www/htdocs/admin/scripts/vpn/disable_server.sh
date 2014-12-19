#!/bin/sh
# Guide d'utilisation : "./disable_server.sh "ip_server" "x509 ou psk""
# Permet d'activer le serveur vpn

# Pointeur
server="$1_$2"

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 arguments entré
    then
    echo "Erreur : il faut entrer 2 arguments."
    echo "./disable_server.sh "ip_server" "x509 ou psk""
    exit 2
fi

if [ -d /etc/openvpn/server/$server ] # Vérifie si le répertoire du client existe
    then
    echo "L'adressage $server est utilisé."
    echo "Désactivation en cours ..."

# Recherche l'id du serveur VPN pour le kill
id_kill=`ps -ax | grep /etc/openvpn/server/$server/$server\_server.conf | awk NR==1'{print $1}'`

# Désactive le serveur VPN
kill -9 $id_kill
    echo "Serveur OFF"
ps -ax | grep /etc/openvpn/server/$server/$server\_server.conf

else
    echo "L'adressage $server n'est pas utilisé."
    echo "Veuillez ajouter ou créer un autre adressage ip"
    ls -la /etc/openvpn/server
    ps -ax | grep open
fi
