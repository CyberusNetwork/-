#!/bin/sh
# Guide d'utilisation : del_dynamic_client_x509.sh "ip_client" "client_name"
# Révoque le certificat du client et supprime les répertoires du client

# Pointeur
ip_server="$1_x509"
client_name=$2
client_x509="$2_x509"

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./del_dynamic_client_x509.sh "ip_server" "client_name""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server/clients/$client_name ] # Vérifie si le répertoire du client existe sinon il créait
	then
	echo "En cours de suppresion ..."
# Rentre dans le répertoire de révocation
cd /etc/openvpn/easyrsa3/

# Révoque le certificat du client
./easyrsa revoke $client_x509\_client <<FIN
yes
FIN

# Met à jour la liste de vérification révocation crl.pem
cd /etc/openvpn/easyrsa3/
./easyrsa gen-crl

    echo "Changement du chmod 600 en 605 crl.pem"

chmod 605 /etc/openvpn/easyrsa3/pki/crl.pem
    
    echo "Déplace crl.pem dans le répertoire keys"
rm /etc/openvpn/keys/crl.pem
mv /etc/openvpn/easyrsa3/pki/crl.pem /etc/openvpn/keys

# Supprime les répetoires et les certificats du client
rm -r /etc/openvpn/server/$ip_server/clients/$client_name/
rm /etc/openvpn/easyrsa3/pki/issued/$client_x509\_client.crt
rm /etc/openvpn/easyrsa3/pki/private/$client_x509\_client.key
rm /etc/openvpn/easyrsa3/pki/reqs/$client_x509\_client.req
else
    echo "Le répertoire $client_name n'existe pas."
    ls -la /etc/openvpn/server/$ip_server/clients/
fi