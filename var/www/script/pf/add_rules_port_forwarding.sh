#!/bin/sh
# ./add_rules_port_forwarding.sh interface proto port_ext ip_lan port_int
# Ajoute une règle de port forwarding

# Pointeur
interface=$1
protocol=$2
port_ext=$3
ip_lan=$4
port_int=$5

if [ $# -ne 5 ] # Vérifie qu'il y a seulement 5 argument entré
    then
    echo "Erreur : il faut entrer 5 argument."
    echo "./add_rules_port_forwarding.sh "interface" "proto" "port_ext" "ip_lan" "port_int""
    echo " MACRO "
    sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf.conf
    echo " Rules Port forwardinfg"
    cat /etc/pf.conf | grep "rdr-to"
    exit 2
fi

# Vérifie si le port forwarding existe si oui il le supprime
	sudo /usr/local/bin/gsed -i '/pass in log on '\$$interface\_macro' proto '$protocol' from any to any port '$port_ext' rdr-to '$ip_lan' port '$port_int'/d' /etc/pf.conf

# Ajoute le port forwarding
	sudo /usr/local/bin/gsed -i '/Forwarding_port/a pass in log on '\$$interface\_macro' proto '$protocol' from any to any port '$port_ext' rdr-to '$ip_lan' port '$port_int'' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# Montre le port forwarding du fichier pf.conf
	sudo /bin/cat /etc/pf.conf | grep "rdr-to"