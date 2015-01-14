#!/bin/sh
# ./add_rules_port_forwarding.sh interface proto port_ext ip_lan port_int
# Ajoute une règle de port forwarding

# Pointeur
in_out=$1
interface=$2
protocol=$3
port_ext=$4
ip_lan=$5
port_int=$6

if [ $# -ne 6 ] # Vérifie qu'il y a seulement 6 argument entré
    then
    echo "Erreur : il faut entrer 6 argument."
    echo "./add_rules_port_forwarding.sh "in_out" "interface" "proto" "port_ext" "ip_lan" "port_int""
    echo " Rules Port forwarding"
    sudo /bin/cat /etc/pf/port_forwarding.conf
    exit 2
fi

# Vérifie si le port forwarding existe si oui il le supprime
	sudo /usr/local/bin/gsed -i '/pass '$in_out' log on '\$$interface\_macro' proto '$protocol' from any to any port '$port_ext' rdr-to '$ip_lan' port '$port_int'/d' /etc/pf/port_forwarding.conf

# Ajoute le port forwarding
	sudo /usr/local/bin/gsed -i '/Forwarding_port/a pass '$in_out' log on '\$$interface\_macro' proto '$protocol' from any to any port '$port_ext' rdr-to '$ip_lan' port '$port_int'' /etc/pf/port_forwarding.conf

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