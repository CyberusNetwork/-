#!/bin/sh
# ./enable_network_neighborhood.sh ip_server
# Active le voisinage réseau VPN

# Pointeur
ip_server="$1_x509" # ip du serveur VPN

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./enable_network_neighborhood.sh "ip_server""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server ] # Vérifie si le serveur.conf existe
    then
    echo "En cours d'activation ..."
# Vérifie s'il existe si oui il le supprime
	sudo /usr/local/bin/gsed -i '/client-to-client # permet la connexion entre clients/d' /etc/openvpn/server/$ip_server/$ip_server\_server.conf

# Ajoute s'il n'existe pas
	sudo /usr/local/bin/gsed -i '/network_neighborhood/a client-to-client # permet la connexion entre clients' /etc/openvpn/server/$ip_server/$ip_server\_server.conf

# Recherche ID du serveur vpn
id_kill=`ps -ax | grep /etc/openvpn/server/$ip_server/$ip_server\_server.conf | awk NR==1'{print $1}'`

# Désactive le VPN
	sudo kill -9 $id_kill

# Redémarre le VPN
	openvpn --config /etc/openvpn/server/$ip_server/$ip_server\_server.conf --daemon

# Montre le serveur.conf
	sudo cat /etc/openvpn/server/$ip_server/$ip_server\_server.conf
	exit 2
else
    echo "L'adressage $ip n'est pas utilisé."
    sudo ls -la /etc/openvpn/server # Montre les répertoires d'adressage IP VPN
    exit 2
fi