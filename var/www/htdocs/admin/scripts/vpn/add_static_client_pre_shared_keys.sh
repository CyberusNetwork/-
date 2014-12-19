#!/bin/sh
# Guide d'utilisation : ./add_client_pre_shared_keys.sh "ip_server" "client_name" "localhost" "remote" "port" "interface"
# Permet de créer un client vpn avec la configuration pre-shared keys

# Pointeur
client_name=$1
ip_server=$2
localhost=$3
remote=$4
port=$5
interface=$6
static_key="$2_psk_static.key"
psk="$2_psk"

if [ $# -ne 6 ] # Vérifie qu'il y a seulement 6 arguments entré
    then
    echo "Erreur : il faut entrer 6 arguments."
    echo "./add_client_pre_shared_keys.sh "client_name" "ip_server" "localhost" "remote" "port" "interface""
    exit 2
fi

if [ -d /etc/openvpn/server/$psk/client/$client_name ] # Vérifie si le répertoire du client existe sinon il créait son répertoire.
	then
	echo "Le client $client_name existe déjà."
	echo "Veuillez supprimer et révoquer l'utisateur."
else
	echo "Le client $client_name n'existe pas."
	echo "Création en cours ..."

# Création des repertoires client + log
mkdir /etc/openvpn/server/$psk/client/$client_name
mkdir /etc/openvpn/server/$psk/client/$client_name/log
mkdir /etc/openvpn/server/$psk/client/$client_name/ovpn

# Copie la clé Pre Shared Keys du serveur
cp /etc/openvpn/server/$psk/$psk\_static.key /etc/openvpn/server/$psk/client/$client_name/ovpn

# Création du fichier configuration du client adapté pour Windows
cd /etc/openvpn/server/$psk/client/$client_name/ovpn
cat >> client.ovpn <<EOF
port $port # protocole de communication
dev $interface # type d'interface
remote 88.177.168.133 # Adresse IP du serveur public OpenVPN
push "dhcp-option DNS 8.8.8.8" #utilisation de DNS alternatifs
route 88.177.168.133 255.255.255.255 10.8.97.1
redirect-gateway def1
ifconfig $localhost $remote # ip du serveur local et du client
secret $static_key
keepalive 10 120 # ping toutes les 10 secondes, down after 120secondes 
ping-timer-rem # teste la connexion pour le relancer s'il est coupé
persist-key # rendre la connexion persistante
persist-tun
comp-lzo # activation de la compression
verb 4 # niveau de verbosité (de 1 à 9)
EOF

# Compression en zip du client.ovpn et des certificats du client
cd /etc/openvpn/server/$psk/client/$client_name
tar cvzf $client_name.tar.gz ovpn/
fi