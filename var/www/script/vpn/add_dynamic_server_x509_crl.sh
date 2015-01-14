#!/bin/sh
# Guide d'utilisation: add_dynamic_server_x509_crl.sh ip_server mask port interface
# Permet de créer la configuration du serveur avec adressage ip

# Pointeur
ip=$1
mask=$2
port=$3
interface=$4
ip_server="$1_x509"
ip_crt="$1_x509_server.crt"
ip_key="$1_x509_server.key"
ipp="$1_x509_ipp.txt"
server_conf="$1_x509_server.conf"

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
    then
    echo "Erreur : il faut entrer 4 argument."
    echo "add_dynamic_server_x509_crl.sh "ip_server" "mask" "port" "interface""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server ] # Vérifie si le répertoire du serveur existe
    then
    echo "L'adressage $ip_server est déjà utilisé."
    echo "Veuillez supprimer ou utiliser un autre adressage ip"
    sudo ls -la /etc/openvpn/server
    exit 2
else
    echo "L'adressage $ip_server n'est pas utilisé."
    echo "Création en cours ..."

# Création du repertoire serveur, client et de log
    sudo mkdir /etc/openvpn/server/$ip_server # Répertoire de la conf serveur
    sudo mkdir /var/log/openvpn/server-log/$ip_server # 
    sudo mkdir /etc/openvpn/server/$ip_server/clients # Répertoire client

# Création des certificats client

# .key
    cd /etc/openvpn/easyrsa3/
./easyrsa gen-req $ip_server\_server nopass <<FIN

FIN
# .crt
    cd /etc/openvpn/easyrsa3/
./easyrsa sign server $ip_server\_server <<FIN1
yes
FIN1

# Copie la CA, key, crt dans le répertoire du serveur_conf/ip_server
    sudo cp /etc/openvpn/easyrsa3/pki/issued/$ip_server\_server.crt /etc/openvpn/easyrsa3/pki/private/$ip_server\_server.key /etc/openvpn/server/$ip_server/
    sudo cp /etc/openvpn/easyrsa3/pki/ca.crt /etc/openvpn/server/$ip_server/

    cd /etc/openvpn/server/$ip_server
    sudo cat >> $ip_server\_server.conf <<EOF
mode server # fichier de configuration du serveur
port $port # Numéro du port utilisé
proto tcp # Protocole de communication
dev $interface # type d'interface

# Certificats
ca /etc/openvpn/server/$ip_server/ca.crt # clé d'Autorité de Certification SSL/TLS
cert /etc/openvpn/server/$ip_server/$ip_crt # certificat du serveur
key /etc/openvpn/server/$ip_server/$ip_key # clé du serveur
dh /etc/openvpn/keys/dh.pem # emplacement du fichier Diffie-Hellman
tls-auth /etc/openvpn/keys/ta.key 0 # Protection attaque DOS
crl-verify /etc/openvpn/keys/crl.pem # Liste des certificats révoqué

# Configuration VPN
server $ip $mask # adresse IP attribuées sur le VPN
# network_neighborhood
# client-to-client # permet la connexion entre clients
ifconfig-pool-persist /etc/openvpn/ipp/$ipp
push "redirect-gateway" # redirection du flux de données
push "route 88.177.168.133 255.255.255.255 10.8.97.1" # route vers le réseau que les clients VPN pourront joindre
push "dhcp-option DNS 8.8.8.8" # utilisation de DNS alternatifs
keepalive 10 120 # ping toutes les 10 secondes, down after 120secondes 

# Divers
ping-timer-rem #  relance la connexion si elle est coupée

# rend la connexion persistante
persist-key 
persist-tun
user cyberus_openvpn # l'utilisateur root devient cyberus_openvpn
group cyberus_openvpn # groupe cyberus_openvpn
comp-lzo # compression des données d’échanges VPN

# Log
status /var/log/openvpn/server-log/$ip_server/openvpn-status.log # fichier statut
log /var/log/openvpn/server-log/$ip_server/openvpn.log # fichier log
verb 4 # verbosité du log (1-9)
daemon
EOF

echo "OK"

# Vérifie si un serveur VPN utilisant le même ip
id_kill=`ps -ax | grep /etc/openvpn/server/$ip_server/$server_conf | awk NR==1'{print $1}'`

# Si, oui alors il le kill
    sudo kill -9 $id_kill

echo "Démarrage du serveur VPN"

# Sinon, il démarre le serveur VPN
    openvpn --config /etc/openvpn/server/$ip_server/$ip_server\_server.conf --daemon
    sudo ps -ax | grep /etc/openvpn/server/$ip_server/$ip_server\_server.conf

# Affiche le répertoire du serveur.conf
    sudo ls -la /etc/openvpn/server
    exit 2
fi