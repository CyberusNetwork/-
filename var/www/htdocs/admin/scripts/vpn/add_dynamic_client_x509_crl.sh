#!/bin/sh
# Guide d'utilisation : ./add_client_x509_crl.sh "ip_server" "client_name" "port" "interface"
# Permet de créer un client vpn avec la génération de certificat par X.509

# Pointeur
ip=$1
client_name=$2
port=$3
interface=$4
ip_server="$1_x509"
client_x509="$2_x509"
client_name_crt="$2_x509_client.crt"
client_name_key="$2_x509_client.key"

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 arguments entré
    then
    echo "Erreur : il faut entrer 4 arguments."
    echo "./add_client_x509_crl.sh "ip_server" "client_name" "port" "interface""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server/clients/$client_name ] # Vérifie si le répertoire du client existe sinon il créait son répertoire.
	then
	echo "Le client $client_name existe déjà."
	echo "Veuillez supprimer et révoquer l'utisateur."
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
mkdir /etc/openvpn/server/$ip_server/clients/$client_name
mkdir /etc/openvpn/server/$ip_server/clients/$client_name/ovpn

# Copie les certificats de l'emplacement easyRSA dans le repertoire du client
cp /etc/openvpn/easyrsa3/pki/ca.crt /etc/openvpn/keys/ta.key /etc/openvpn/easyrsa3/pki/issued/$client_x509\_client.crt /etc/openvpn/easyrsa3/pki/private/$client_x509\_client.key /etc/openvpn/server/$ip_server/clients/$client_name/
cp /etc/openvpn/server/$ip_server/clients/$client_name/ca.crt /etc/openvpn/server/$ip_server/clients/$client_name/ta.key /etc/openvpn/server/$ip_server/clients/$client_name/$client_x509\_client.key /etc/openvpn/server/$ip_server/clients/$client_name/$client_x509\_client.crt /etc/openvpn/server/$ip_server/clients/$client_name/ovpn

# Création du fichier configuration du client adapté pour Windows
cd /etc/openvpn/server/$ip_server/clients/$client_name/ovpn
cat >> client.ovpn <<EOF
port $port # protocole de communication
proto tcp # protocole de communication
dev $interface # type d'interface
client # config client
remote 88.177.168.133 # Adresse IP du serveur interne OpenVPN 
ca ca.crt
cert $client_name_crt
key $client_name_key
tls-auth ta.key 1
resolv-retry infinite
persist-key # rendre la connexion persistante
persist-tun
route-method exe 
route-delay 2
keepalive 10 120
comp-lzo # activation de la compression
verb 4 # niveau de verbosité (de 1 à 9)
EOF

# Compression en zip du client.ovpn et des certificats du client
cd /etc/openvpn/server/$ip_server/clients/$client_name
tar cvzf $client_name.tar.gz ovpn/
fi
