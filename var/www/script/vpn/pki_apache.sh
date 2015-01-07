#!/bin/sh
# Guide d'utilisation : pki.sh YES or NO
# Permet de générer un nouveau répertoire pki et archive l'ancien une fois

# Pointeur
answer=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 arguments entré
    then
    echo "Voulez-vous reinitialiser la config pki ?"
    echo " YES or NO "
    exit 2
fi

if [ -f /etc/openvpn/script/$answer ] # Vérifie si la réponse existe
    then

    echo "Reinitialisation du pki en cours ..."

# Sauvergarde et Supprime l'ancien pki
	sudo rm -r /etc/openvpn/easyrsa3/pki

# Copie 
	sudo cp -r /etc/openvpn/easyrsa3/pki_recovery /etc/openvpn/easyrsa3/pki

    echo "Création de la nouvelle CA OK"

# Génére une nouvelle CA

	cd /etc/openvpn/easyrsa3/

./easyrsa build-ca nopass<<FIN

FIN
    echo "Création server.key et crl"

# Création des certificats client

# .key
	cd /etc/openvpn/easyrsa3/
./easyrsa gen-req server nopass <<FIN
cbnet.itinet.fr
FIN

# .crt
	cd /etc/openvpn/easyrsa3/
./easyrsa sign server server <<FIN1
yes
FIN1

	sudo mv /etc/openvpn/easyrsa3/pki/private/server.key /etc/apache2/
	sudo mv /etc/openvpn/easyrsa3/pki/issued/server.crt /etc/apache2/
	exit 2
else
    echo "Bonne décision ..."
    exit 2
fi