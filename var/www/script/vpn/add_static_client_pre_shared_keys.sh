#!/bin/sh
# Guide d'utilisation : ./add_client_pre_shared_keys.sh "ip_server" "client_name" "localhost" "remote" "port" "interface"
# Permet de créer un client vpn avec la configuration pre-shared keys

# Pointeur
ip_server=$1
client_name=$2
localhost=$3
remote=$4
port=$5
interface=$6
static_key="$2_psk_static.key"
psk="$2_psk"

if [ $# -ne 6 ] # Vérifie qu'il y a seulement 6 arguments entré
    then
    echo "Erreur : il faut entrer 6 arguments."
    echo "./add_client_pre_shared_keys.sh "ip_server" "client_name" "localhost" "remote" "port" "interface""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server ] # Vérifie si le répertoire du serveur existe.
	then
		echo "Le serveur $1 existe."
	else
		echo "Le serveur $1 n'existe pas."
		exit 2
fi

if [ -d /etc/openvpn/server/$psk/clients/$client_name ] # Vérifie si le répertoire du client existe sinon il créait son répertoire.
	then
	echo "Le client $client_name existe déjà."
	echo "Veuillez supprimer et révoquer l'utisateur."
	exit 2
else
	echo "Le client $client_name n'existe pas."
	echo "Création en cours ..."

# Création des repertoires client + log
	sudo mkdir /etc/openvpn/server/$psk/clients/$client_name
	sudo mkdir /etc/openvpn/server/$psk/clients/$client_name/log
	sudo mkdir /etc/openvpn/server/$psk/clients/$client_name/ovpn

# Copie la clé Pre Shared Keys du serveur
	sudo cp /etc/openvpn/server/$psk/$psk\_static.key /etc/openvpn/server/$psk/clients/$client_name/ovpn

# Création du fichier configuration du client adapté pour Windows
	cd /etc/openvpn/server/$psk/clients/$client_name/ovpn
	sudo cat >> $client_name\_psk.ovpn <<EOF
dev $interface # type d'interface
remote 88.177.168.133 # Adresse IP du serveur public OpenVPN
port $port # protocole de communication
push "dhcp-option DNS 8.8.8.8" #utilisation de DNS alternatifs
route 88.177.168.133 255.255.255.255 10.8.97.1
redirect-gateway def1 # spécifie que tout le flux doit être redirigé 
ifconfig $localhost $remote # ip du serveur local et du client
secret $static_key # La clé d’échange pre-shared keys du serveur
keepalive 10 120 # ping toutes les 10 secondes, down after 120secondes 
ping-timer-rem # teste la connexion pour le relancer s'il est coupé
persist-key # rendre la connexion persistante
persist-tun
comp-lzo # activation de la compression
verb 4 # niveau de verbosité (de 1 à 9)
EOF

# Compression en zip du client.ovpn et des certificats du client
	cd /etc/openvpn/server/$psk/clients/$client_name
	sudo tar cvzf $client_name.tar.gz ovpn/
	exit 2
fi