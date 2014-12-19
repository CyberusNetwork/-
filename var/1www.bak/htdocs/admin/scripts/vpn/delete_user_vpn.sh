#!/bin/sh
# Guide d'utilisation : ./delete_user_vpn.sh User
# Révoque le certificat du client et supprime les répertoires du client

# Pointeur
client_name=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./delete_user_vpn.sh "client_name""
    exit 2
fi

if [ -d /etc/openvpn/client_conf/$client_name ] # Vérifie si le répertoire du client existe sinon il créait
	then
	 echo "En cours de suppresion ..."
# Rentre dans le répertoire de révocation
cd /etc/openvpn/easyrsa3/

# Révoque le certificat du client
./easyrsa revoke $client_name\_client <<FIN
yes
FIN

# Supprime les répetoires et les certificats du client
rm -r /etc/openvpn/client_conf/$client_name
rm /etc/openvpn/easyrsa3/pki/issued/$client_name\_client.crt
rm /etc/openvpn/easyrsa3/pki/private/$client_name\_client.key
else
    echo "Le répertoire $client_name n'existe pas."
fi