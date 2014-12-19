#!/bin/sh
# Guide d'utilisation: ./delete_server_conf ip
# Permet de supprimer le repertoire d'un serveur de configuration

# Pointeur
ip=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
	then
	echo "Erreur : il faut entrer 1 argument."
	echo "./delete_server_conf "ip""
	exit 2
fi

if [ -d /etc/openvpn/server_conf/$ip ] # Vérifie si le répertoire du client existe
	then
	echo "En cours de suppression ..."
# Supprime le répertoire de la configuration du server
rm -r /etc/openvpn/server_conf/$ip
echo "OK"
# Montre à l'intérieur du /etc/openvpn/server_conf
ls -la /etc/openvpn/server_conf
else
	echo "Le répertoire $ip n'existe pas."
	ls -la /etc/openvpn/server_conf # Montre les répertoires d'adressage IP VPN
fi