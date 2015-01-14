#!/bin/sh
# ./disable_network_neighborhood.sh ip_server
# Désactive le voisinage réseau VPN

# Pointeur
ip_server=$1 # ip du serveur VPN
types=$2 # types psk ou x509

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./disable_network_neighborhood.sh "ip_server" "types psk ou x509""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server\_$types ] # Vérifie si le serveur.conf existe
    then
    echo "En cours de désactivation ..."

# Vérifie s'il existe si oui il le supprime
    sudo /usr/local/bin/gsed -i '/client-to-client # permet la connexion entre clients/d' /etc/openvpn/server/$ip_server\_$types/$ip_server\_$types\_server.conf

# Recherche ID du serveur vpn
id_kill=`ps -ax | grep /etc/openvpn/server/$ip_server\_$types/$ip_server\_$types\_server.conf | awk NR==1'{print $1}'`

# Désactive le VPN
    sudo kill -9 $id_kill

# Redémarre le VPN
    openvpn --config /etc/openvpn/server/$ip_server\_$types/$ip_server\_$types\_server.conf --daemon

# Montre le serveur.conf
    sudo cat /etc/openvpn/server/$ip_server\_$types/$ip_server\_$types\_server.conf
    exit 2
else
    echo "L'adressage $ip n'est pas utilisé."
    sudo ls -la /etc/openvpn/server # Montre les répertoires d'adressage IP VPN
    exit 2
fi