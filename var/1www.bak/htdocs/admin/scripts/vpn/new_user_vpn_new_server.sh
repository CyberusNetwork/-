#!/bin/sh
# Guide d'utilisation : ./new_user_vpn_new_server.sh User
# Permet de créer un client vpn avec la configuration d'un autre serveur avec la génération de certificat par X.509

# Pointeur
client_name=$1
ip_private=$2
ip_public=$3
port=$4
interface=$5

if [ $# -ne 5 ] # Vérifie qu'il y a seulement 5 arguments entré
    then
    echo "Erreur : il faut entrer 5 arguments."
    echo "./new_user_vpn.sh "client_name" "ip_private" "ip_public" "port" "interface""
    exit 2
fi

if [ -d /etc/openvpn/client_conf/$client_name ] # Vérifie si le répertoire du client existe sinon il créait son répertoire.
	then
	echo "Le client $client_name existe déjà."
	echo "Veuillez supprimer et révoquer l'utisateur."
else
	echo "Le client $client_name n'existe pas."
	echo "Création en cours ..."
# Création des certificats client
# .key
cd /etc/openvpn/easyrsa3/
./easyrsa gen-req $client_name\_client nopass <<FIN

FIN
# .crt
cd /etc/openvpn/easyrsa3/
./easyrsa sign client $client_name\_client <<FIN1
yes
FIN1

# Création des repertoires client + log
mkdir /etc/openvpn/client_conf/$client_name
mkdir /etc/openvpn/client_conf/$client_name/log
mkdir /etc/openvpn/client_conf/$client_name/ovpn

# Copier les certificats de l'emplacement easyRSA dans le repertoire du client
cp /etc/openvpn/keys/ca.crt /etc/openvpn/keys/ta.key /etc/openvpn/easyrsa3/pki/issued/$client_name\_client.crt /etc/openvpn/easyrsa3/pki/private/$client_name\_client.key /etc/openvpn/client_conf/$client_name/
cp /etc/openvpn/client_conf/$client_name/ca.crt /etc/openvpn/client_conf/$client_name/ta.key /etc/openvpn/client_conf/$client_name/$client_name\_client.key /etc/openvpn/client_conf/$client_name/$client_name\_client.crt /etc/openvpn/client_conf/$client_name/ovpn

# Création du fichier configuration du client
cd /etc/openvpn/client_conf/$client_name
cat >> client.conf <<EOF
port  $port # protocole de communication
proto tcp # protocole de communication
dev $interface # type d'interface
client # config client
remote $ip_private # Adresse IP du serveur interne OpenVPN 
ca /etc/openvpn/client_conf/$client_name/ca.crt
cert /etc/openvpn/client_conf/$client_name/$client_name\_client.crt
key /etc/openvpn/client_conf/$client_name/$client_name\_client.key
tls-auth /etc/openvpn/client_conf/$client_name/ta.key 1
resolv-retry infinite
persist-key # rendre la connexion persistante
persist-tun
route-method exe 
route-delay 2
keepalive 10 120
comp-lzo # activation de la compression
verb 4 # niveau de verbosité (de 1 à 9)
EOF

# Création du fichier configuration du client adapté pour Windows
cd /etc/openvpn/client_conf/$client_name/ovpn
cat >> client.ovpn <<EOF
port  $port # protocole de communication
proto tcp # protocole de communication
dev $inteface # type d'interface
client # config client
remote $ip_public # Adresse IP du serveur interne OpenVPN 
ca ca.crt
cert $client_name\_client.crt
key $client_name\_client.key
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
cd /etc/openvpn/client_conf/$client_name
tar cvzf $client_name.tar.gz ovpn
fi
