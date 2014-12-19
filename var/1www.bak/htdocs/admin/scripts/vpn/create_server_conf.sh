#!/bin/sh
# Guide d'utilisation: ./create_server_conf.sh Ip Mask
# Permet de créer le fichier de conf du serveur avec adressage d'ip et de son masque

# Pointeur
ip=$1
mask=$2
ip_crt="$1_server.crt"
ip_key="$1_server.key"
ip_server="$1_server"

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./create_server_conf.sh "ip" "mask""
    exit 2
fi

if [ -d /etc/openvpn/server_conf/$ip ] # Vérifie si le répertoire du client existe
    then
    echo "L'adressage $ip est déjà utilisé."
    echo "Veuillez supprimer ou utiliser un autre adressage ip"
    ls -la /etc/openvpn/server_conf
else
    echo "L'adressage $ip est pas utilisé."
    echo "Création en cours ..."
# Création du repertoire serveur et du répertoire de log
mkdir /etc/openvpn/server_conf/$ip # Répertoire de la conf serveur
mkdir /var/openvpn/server-log/$ip # Log

cd /etc/openvpn/server_conf/$ip
cat >> $ip\_server.conf <<EOF
mode server # fichier de configuration du serveur
port 10006 # Numéro du port utilisé
proto tcp # Protocole de communication
dev tun # type d'interface

# Certificats
ca /etc/openvpn/keys/ca.crt
cert /etc/openvpn/client_conf/$ip/$ip_crt
key /etc/openvpn/client_conf/$ip/$ip_key
dh /etc/openvpn/keys/dh.pem # emplacement du fichier Diffie-Hellman
tls-auth /etc/openvpn/client_conf/$ip/ta.key 0 # Protection attaque DOS

# Configuration VPN
server $ip $mask # adresse IP attribuées sur le VPN
# network_neighborhood
client-to-client # permet la connexion entre clients
ifconfig-pool-persist /etc/openvpn/ipp.txt
push "redirect-gateway" # redirection du flux de données
push "route 88.177.168.133 255.255.255.255 10.8.97.1"
push "dhcp-option DNS 8.8.8.8" #utilisation de DNS alternatifs
keepalive 10 120 # ping toutes les 10 secondes, down after 120secondes 

# Divers
ping-timer-rem

# rend la connexion persistante
persist-key 
persist-tun
user cyberus_openvpn # l'utilisateur root devient cyberus_openvpn
group cyberus_openvpn # groupe cyberus_openvpn
comp-lzo # compression des données

# Log
status /var/log/openvpn/server-log/$ip/$ip_server-status.log # fichier statut
log /var/log/openvpn/server-log/$ip/$ip_server.log # fichier log
verb 4 # verbosité du log (1-9)
daemon
EOF
echo "OK"
fi