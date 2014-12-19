#!/bin/sh
# Guide d'utilisation: ./add_static_server_conf_pre_shared_keys.sh "ip_server" "localhost" "remote" "port" "interface""
# Permet de créer le fichier de conf du serveur avec son propre adressage ip

# Pointeur
ip_server=$1
localhost=$2 
remote=$3
port=$4
interface=$5
ipp="$1_ipp.txt"
static_key="$1_psk_static.key"
psk="$1_psk"

if [ $# -ne 5 ] # Vérifie qu'il y a seulement 5 argument entré
    then
    echo "Erreur : il faut entrer 5 argument."
    echo "./add_static_server_conf_pre_shared_keys.sh "ip_server" "localhost" "remote" "port" "interface""
    exit 2
fi

if [ -d /etc/openvpn/server/$ip_server ] # Vérifie si le répertoire du client existe
    then
    echo "L'adressage $ip_server est déjà utilisé."
    echo "Veuillez supprimer ou utiliser un autre adressage ip"
    # Montre le fichier server_conf
    ls -la /etc/openvpn/server
else
    echo "L'adressage $ip_server est pas utilisé."
    echo "Création en cours ..."

# Création du repertoire serveur et du répertoire de log
mkdir /etc/openvpn/server/$psk # Répertoire du serveur.conf
mkdir /var/log/openvpn/server-log/$psk # Répertoire log du serveur
mkdir /etc/openvpn/server/$psk/client # Répertoires clients

# Génération de la clé pre shared keys
openvpn --genkey --secret /etc/openvpn/server/$psk/$static_key

# Entre dans le fichier là où il va avoir le fichier de conf du serveur psk
cd /etc/openvpn/server/$psk/

# Créer le fichier de conf du serveur psk
cat >> $psk\_server.conf <<EOF
dev $interface # type d'interface
ifconfig $localhost $remote # ip du serveur local et du client
port $port # Numéro du port utilisé

user cyberus_openvpn # l'utilisateur root devient cyberus_openvpn
group cyberus_openvpn # groupe cyberus_openvpn

keepalive 10 120 # ping toutes les 10 secondes, down after 120secondes 
ping-timer-rem # teste la connexion pour le relancer s'il est coupé

# rend la connexion persistante
persist-key 
persist-tun

comp-lzo # compression des données

# pre-shared keys static key
secret /etc/openvpn/server/$psk/$static_key

# Log
status /var/log/openvpn/server-log/$psk/openvpn-status.log # fichier statut
log /var/log/openvpn/server-log/$psk/openvpn.log # fichier log

verb 4 # verbosité du log (1-9)

daemon
EOF

echo "OK"

# Vérifie si un serveur VPN utilisant le même ip
id_kill=`ps -ax | grep /etc/openvpn/server_conf/$ip_server/$psk\_server.conf | awk NR==1'{print $1}'`
# Si, oui alors il le kill
kill -9 $id_kill
echo "Démarrage du serveur VPN"
# Sinon, il démarre le serveur VPN
openvpn --config /etc/openvpn/server/$psk/$psk\_server.conf --daemon
# Confirmation du lancement du serveur VPN
echo "Vérification du lancement du serveur VPN"
ps -ax | grep /etc/openvpn/server_conf/$ip_server/$psk\_server.conf
# Affiche le répertoire du serveur.conf
ls -la /etc/openvpn/server
fi