#!/bin/sh
# ./disable_network_neighborhood.sh ip_server
# Désactive le voisinage réseau VPN

# Pointeur
ip_server="$1_x509" # nom du serveur

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./disable_network_neighborhood.sh "ip_server""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server ] # Vérifie si le serveur.conf existe
    then
    echo "En cours de désactivation ..."
# S'il existe, il le supprime
/usr/local/bin/gsed -i '/client-to-client # permet la connexion entre clients/d' /etc/openvpn/server/$ip_server/$ip_server\_server.conf

# Recherche ID du serveur vpn
id_kill=`ps -ax | grep /etc/openvpn/server/$ip_server/$ip_server\_server.conf | awk NR==1'{print $1}'`

# Désactive le VPN
kill -9 $id_kill

# Redémarre le VPN
openvpn --config /etc/openvpn/server/$ip_server/$ip_server\_server.conf --daemon

# Montre le serveur.conf
cat /etc/openvpn/server/$ip_server/$ip_server\_server.conf
else
    echo "L'adressage $ip_server n'est pas utilisé."
    ls -la /etc/openvpn/server # Montre les répertoires d'adressage IP VPN
fi