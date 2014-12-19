#!/bin/sh
# ./disable_network_neighborhood.sh ip
# Désactive le voisinage réseau VPN

# Pointeur
ip=$1 # nom du serveur

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./disable_network_neighborhood.sh "ip""
    exit 2
fi

if [ -d /etc/openvpn/server_conf/$ip ] # Vérifie si le serveur.conf existe
    then
    echo "En cours de désactivation ..."
# S'il existe, il le supprime
/usr/local/bin/gsed -i '/client-to-client # permet la connexion entre clients/d' /etc/openvpn/server_conf/$name_server/server.conf

# Montre le serveur.conf
cat /etc/openvpn/server_conf/$ip/server.conf
else
    echo "L'adressage $ip n'est pas utilisé."
    ls -la /etc/openvpn/server_conf # Montre les répertoires d'adressage IP VPN
fi