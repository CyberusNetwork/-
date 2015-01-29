#!/bin/sh
# ./del_rules_port_forwarding.sh macro_interface_ext macro_port_ext macro_port_int
# Supprime le  port forwarding

# Pointeur
interface=$1
port_ext=$2
port_int=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 argument entré
    then
    echo "Erreur : il faut entrer 3 argument."
    echo "./del_rules_port_forwarding.sh macro_interface_ext macro_port_ext macro_port_int"
    sudo /bin/cat /etc/pf/port_forwarding.conf
    exit 2
fi

# Supprime le port forwarding
	sudo /usr/local/bin/gsed -i '/pass in log on '\$$interface\_macro' proto tcp from any to any port '\$$port_ext\_macro' rdr-to $lan_ip_macro  port '\$$port_int\_macro'/d' /etc/pf/port_forwarding.conf

# Teste la config pf.conf
	sudo /sbin/pfctl -nf /etc/pf.conf
	
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then
# Recharge la configuration, si -nf ne renvoie pas d'errreur
	#sudo /sbin/pfctl -f /etc/pf.conf
  
 	echo " La configuration ne contient pas d'erreur de syntaxe "

	# Montre le port forwarding du fichier pf.conf
	sudo /bin/cat /etc/pf/port_forwarding.conf
	exit 2
else
	echo "Error de syntaxe"
	exit 2
fi