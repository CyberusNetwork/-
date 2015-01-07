#!/bin/sh
# ./del_rules_port_forwarding.sh interface proto port_ext
# Supprime le  port forwarding

# Pointeur
interface=$1
protocol=$2
port_ext=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 argument entré
    then
    echo "Erreur : il faut entrer 3 argument."
    echo "./del_rules_port_forwarding.sh "interface" "protocol" "port_ext""
    cat /etc/pf.conf | grep "rdr-to"
    exit 2
fi

# Supprime le port forwarding
	sudo /usr/local/bin/gsed -i '/pass in log on '\$$interface\_macro' proto '$protocol' from any to any port '$port_ext' rdr-to/d' /etc/pf.conf

# Teste la config pf.conf
	sudo /sbin/pfctl -nf /etc/pf.conf
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then
# Recharge la configuration, si -nf ne renvoie pas d'errreur
	sudo /sbin/pfctl -f /etc/pf.conf
	echo " It's Okay "
	# Montre le port forwarding du fichier pf.conf
	sudo /bin/cat /etc/pf.conf | grep "rdr-to"
	exit 2
else
	echo "Error de syntaxe"
	exit 2
fi