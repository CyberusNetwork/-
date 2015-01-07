#!/bin/sh
# Guide d'utilisation : show_crl.sh YES or NO
# Permet de lire le fichier de revocation crl.pem

# Pointeur
answer=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 arguments entré
    then
    echo "Voulez-vous consulter les révocations ?"
    echo " YES or NO "
    exit 2
fi

if [ -f /etc/openvpn/script/$answer ] # Vérifie si la réponse existe
    then

	sudo openssl crl -in /etc/openvpn/keys/crl.pem -text
	exit 2
else
    echo "A bientôt !"
    exit 2
fi