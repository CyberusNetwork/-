#!/bin/sh
# Guide d'utilisation : ./add_client_x509_crl.sh "ip_server" "client_name" "port" "interface"
# Permet de créer un client vpn avec la génération de certificat par X.509

# Pointeur
ip=$1
client_name=$2
port=$3
interface=$4
ip_server="$1_x509"
client_x509="$2_$1_x509"
client_name_crt="$2_x509_client.crt"
client_name_key="$2_x509_client.key"

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 arguments entré
    then
    echo "Erreur : il faut entrer 4 arguments."
    echo "./add_client_x509_crl.sh "ip_server" "client_name" "port" "interface""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server ] # Vérifie si le répertoire du serveur existe.
	then
		echo "Le serveur $1 existe."
	else
		echo "Le serveur $1 n'existe pas."
		exit 2
fi

if [ -f /etc/openvpn/server/$ip_server/clients/$client_name/$client_name_crt ] # Vérifie si le certificat du client existe.
	then
		echo "Le client $client_name existe déjà."
		exit 2
fi

if [ -d /etc/openvpn/server/$ip_server/clients/$client_name ] # Vérifie si le répertoire du client existe sinon il créait son répertoire.
	then
		echo "Le client $client_name existe déjà."
		exit 2
else
		echo "Le client $client_name n'existe pas."
		echo "Création en cours ..."

# Création des certificats client

# .key
	cd /etc/openvpn/easyrsa3/
./easyrsa gen-req $client_x509\_client nopass <<FIN

FIN
	cd /etc/openvpn/easyrsa3/
./easyrsa sign client $client_x509\_client <<FIN1
yes
FIN1

# Création des repertoires client + ovpn
	sudo mkdir /etc/openvpn/server/$ip_server/clients/$client_name
	sudo mkdir /etc/openvpn/server/$ip_server/clients/$client_name/ovpn

# Copie les certificats de l'emplacement easyRSA dans le repertoire du client
	sudo cp /etc/openvpn/easyrsa3/pki/ca.crt /etc/openvpn/keys/ta.key /etc/openvpn/easyrsa3/pki/issued/$client_x509\_client.crt /etc/openvpn/easyrsa3/pki/private/$client_x509\_client.key /etc/openvpn/server/$ip_server/clients/$client_name/

# Renomme le crl et la key dans le répertoire du client
	mv /etc/openvpn/server/$ip_server/clients/$client_name/$client_x509\_client.key /etc/openvpn/server/$ip_server/clients/$client_name/$client_name_key
	mv /etc/openvpn/server/$ip_server/clients/$client_name/$client_x509\_client.crt /etc/openvpn/server/$ip_server/clients/$client_name/$client_name_crt

# Copie les certificats dans le répertoire ovpn
	sudo cp /etc/openvpn/server/$ip_server/clients/$client_name/ca.crt /etc/openvpn/server/$ip_server/clients/$client_name/ta.key /etc/openvpn/server/$ip_server/clients/$client_name/$client_name_key /etc/openvpn/server/$ip_server/clients/$client_name/$client_name_crt /etc/openvpn/server/$ip_server/clients/$client_name/ovpn

# Création du fichier configuration du client adapté pour Windows
	cd /etc/openvpn/server/$ip_server/clients/$client_name/ovpn
	sudo cat >> $client_name.ovpn <<EOF
port $port # protocole de communication
proto tcp # protocole de communication
dev $interface # création d'un tunnel virtuel IP routable
client # config client
remote 88.177.168.133 # Adresse IP du serveur interne OpenVPN
ca ca.crt # clé d'Authorité de Certification SSL/TLS
cert $client_name_crt # Certificat du client
key $client_name_key # Clé du client
tls-auth ta.key 1 # Protection contre les attaques DOS
resolv-retry infinite # Résolution du Host Name
nobind # Ecoute de port inutile
persist-key # rendre la connexion persistante
persist-tun
route-method exe 
route-delay 2
keepalive 10 120
comp-lzo # activation de la compression
verb 4 # niveau de verbosité (de 1 à 9)
mute 20 # coupe une répétition du même message
EOF

# Compression en zip du client.ovpn et des certificats du client
	cd /etc/openvpn/server/$ip_server/clients/$client_name
	sudo tar cvzf $client_name.tar.gz ovpn/
	exit 2
fi
