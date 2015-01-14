#!/bin/sh
# Guide d'utilisation: ./add_static_server_pre_shared_keys.sh "ip_server" "localhost" "remote" "port" "interface""
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
psk_conf="$1_psk_server.conf"

if [ $# -ne 5 ] # Vérifie qu'il y a seulement 5 argument en entré
    then
    echo "Erreur : il faut entrer 5 argument."
    echo "./add_static_server_pre_shared_keys.sh "ip_server" "localhost" "remote" "port" "interface""
    exit 2
fi

if [ -d /etc/openvpn/server/$psk ] # Vérifie si le répertoire du server existe
    then
    echo "L'adressage $psk est déjà utilisé."
    echo "Veuillez supprimer ou utiliser un autre adressage ip"
    # Montre le fichier server_conf
    sudo ls -la /etc/openvpn/server
    exit 2
else
    echo "L'adressage $psk est pas utilisé."
    echo "Création en cours ..."

# Création du repertoire serveur et du répertoire de log
    sudo mkdir /etc/openvpn/server/$psk # Répertoire du serveur.conf
    sudo mkdir /var/log/openvpn/server-log/$psk # Répertoire log du serveur
    sudo mkdir /etc/openvpn/server/$psk/clients # Répertoires clients

# Génération de la clé pre shared keys
    openvpn --genkey --secret /etc/openvpn/server/$psk/$static_key

# Entre dans le fichier là où il va avoir le fichier de conf du serveur psk
    cd /etc/openvpn/server/$psk/

# Créer le fichier de conf du serveur psk
    sudo cat >> $psk\_server.conf <<EOF
dev $interface # type d'interface
ifconfig $localhost $remote # ip du serveur local et du client
port $port # Numéro du port utilisé
user cyberus_openvpn # l'utilisateur root devient cyberus_openvpn
group cyberus_openvpn # groupe cyberus_openvpn
keepalive 10 120 # ping toutes les 10 secondes, down after 120secondes 
ping-timer-rem # teste la connexion pour le relancer s'il est coupé
# client-to-client # permet la connexion entre clients
# rend la connexion persistante
persist-key 
persist-tun
comp-lzo # compression des données
# pre-shared keys static key
secret /etc/openvpn/server/$psk/$static_key
# Log
status /var/log/openvpn/server-log/$psk/openvpn-status.log # log serveur statut
log /var/log/openvpn/server-log/$psk/openvpn.log # log serveur
verb 4 # verbosité du log (1-9)
daemon
EOF

echo "OK"

# Vérifie si un serveur VPN utilisant le même ip
id_kill=`ps -ax | grep /etc/openvpn/server/$psk/$psk_conf | awk NR==1'{print $1}'`
# Si, oui alors il le kill
    sudo kill -9 $id_kill
    echo "Démarrage du serveur VPN"
# Sinon, il démarre le serveur VPN
    openvpn --config /etc/openvpn/server/$psk/$psk\_server.conf --daemon
# Confirmation du lancement du serveur VPN
    echo "Vérification du lancement du serveur VPN"
    sudo ps -ax | grep /etc/openvpn/server/$psk/$psk\_server.conf
# Affiche le répertoire du serveur.conf
    sudo ls -la /etc/openvpn/server
    exit 2
fi