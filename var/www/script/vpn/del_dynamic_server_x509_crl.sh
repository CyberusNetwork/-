#!/bin/sh
# Guide d'utilisation: del_dynamic_server_x509_crl.sh ip_server
# Permet de supprimer le repertoire d'un serveur de configuration

# Pointeur
ip_server="$1_x509"
server_conf="$1_x509_server.conf"

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
	then
	echo "Erreur : il faut entrer 1 argument."
	echo "./del_dynamic_server_x509_crl.sh "ip_server""
	exit 2
fi

if [ -d /etc/openvpn/server/$ip_server ] # Vérifie si le répertoire du server existe
	then
	echo "En cours de suppression ..."
	echo "Désactivation du daemon VPN du serveur"	
# Recherche l'id du serveur VPN pour le kill
id_kill=`ps -ax | grep /etc/openvpn/server/$ip_server/$server_conf | awk NR==1'{print $1}'`

# Désactive le serveur VPN
	sudo kill -9 $id_kill

# Rentre dans le répertoire de révocation
	cd /etc/openvpn/easyrsa3/

# Révoque le certificat du client
./easyrsa revoke $ip_server\_server <<FIN
yes
FIN

# Supprime le répertoire de la configuration du server
	sudo rm -r /etc/openvpn/server/$ip_server
	sudo rm -r /var/log/openvpn/server-log/$ip_server
	sudo rm /etc/openvpn/easyrsa3/pki/issued/$ip_server\_server.crt
	sudo rm /etc/openvpn/easyrsa3/pki/issued/*_$ip_server\_client.crt
	sudo rm /etc/openvpn/easyrsa3/pki/private/$ip_server\_server.key
	sudo rm /etc/openvpn/easyrsa3/pki/private/*_$ip_server\_client.key
	sudo rm /etc/openvpn/easyrsa3/pki/reqs/$ip_server\_server.req
	sudo rm /etc/openvpn/easyrsa3/pki/reqs/*_$ip_server\_client.req
	sudo rm /etc/openvpn/ipp/$ip_server\_ipp.txt
	echo "OK"

# Montre à l'intérieur du /etc/openvpn/server_conf
	echo server_conf
	sudo ls -la /etc/openvpn/server/
	echo server-log
	sudo ls -la /var/log/openvpn/server-log/
	exit 2
else
	echo "Le répertoire $ip_server n'existe pas."
	sudo ls -la /etc/openvpn/server # Montre les répertoires d'adressage IP VPN
	exit 2
fi