#!/bin/sh
# Guide d'utilisation: ./del_static_server_pre_shared_keys.sh ip_server
# Permet de supprimer le repertoire d'un serveur de configuration

# Pointeur
ip_server=$1
psk="$1_psk"

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
	then
	echo "Erreur : il faut entrer 1 argument."
	echo "./del_static_server_pre_shared_keys.sh "ip_server""
	exit 2
fi

if [ -d /etc/openvpn/server/$psk ] # Vérifie si le répertoire du client existe
	then
	echo "En cours de suppression ..."
	echo "Désactivation du daemon VPN du serveur"	
# Recherche l'id du serveur VPN pour le kill
id_kill=`ps -ax | grep /etc/openvpn/server/$psk/$psk\_server.conf | awk NR==1'{print $1}'`

# Désactive le serveur VPN
kill -9 $id_kill

# Confirmation du lancement du serveur VPN
ps -ax | grep /etc/openvpn/server_conf/$ip_server/$psk\_server.conf

# Supprime le répertoire de la configuration du server
rm -r /etc/openvpn/server/$psk
rm -r /var/log/openvpn/server-log/$psk

echo "OK"

# Montre à l'intérieur du /etc/openvpn/server_conf
echo server_conf
ls -la /etc/openvpn/server/
echo server-log
ls -la /var/log/openvpn/server-log/
else
	echo "Le répertoire $ip_server n'existe pas."
	ls -la /etc/openvpn/server # Montre les répertoires d'adressage IP VPN
fi