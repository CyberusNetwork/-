#!/bin/sh
# Guide d'utilisation : ./del_static_client_pre_shared_keys.sh "ip_client" "client_name"
# Révoque le certificat du client et supprime les répertoires du client

# Pointeur
ip_server=$1
client_name=$2
psk="$1_psk"

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./del_static_client_pre_shared_keys.sh "ip_server" "client_name""
    exit 2
fi

if [ -d /etc/openvpn/server/$psk/client/$client_name ] # Vérifie si le répertoire du client existe sinon il créait
	then
	 echo "En cours de suppresion ..."

# Supprime les répetoires et les certificats du client
rm -r /etc/openvpn/server/$psk/client/$client_name/

# Montre les répertoires des clients
ls -la /etc/openvpn/server/$psk/client/

else
    echo "Le répertoire $client_name n'existe pas."
    ls -la /etc/openvpn/server/$psk/client/
fi