#!/bin/sh
# Guide d'utilisation : purge_pki.sh YES or NO
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
    sudo rm -r /etc/openvpn/easyrsa3/pki_old

    sudo mv /etc/openvpn/easyrsa3/pki /etc/openvpn/easyrsa3/pki_old

# Copie 
    sudo cp -r /etc/openvpn/easyrsa3/pki_recovery /etc/openvpn/easyrsa3/pki

    echo "Création de la nouvelle CA OK"

# Génére une nouvelle CA

    cd /etc/openvpn/easyrsa3/

./easyrsa build-ca nopass<<FIN

FIN
    echo "Création du crl.pem OK"

# crl.pem
    cd /etc/openvpn/easyrsa3/

./easyrsa gen-crl

    echo "Changement du chmod 600 en 605 crl.pem"

    sudo chmod 605 /etc/openvpn/easyrsa3/pki/crl.pem
    
    echo "Déplace crl.pem dans le répertoire keys"
    sudo rm /etc/openvpn/keys/crl.pem
    sudo mv /etc/openvpn/easyrsa3/pki/crl.pem /etc/openvpn/keys

    echo "Reinitialisation terminé"
    exit 2
else
    echo "Bonne décision ..."
    exit 2
fi