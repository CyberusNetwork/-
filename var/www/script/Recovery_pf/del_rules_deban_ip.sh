#!/bin/sh
#Guide ./del_rules_deban_ip ip
# Supprime l'ip dans la liste d'ip bannie

# Pointeur
ip=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./del_rules_deban_ip "ip""
    pfctl -t blacklist -T show
    exit 2
fi

# Enleve l'ip bannie de la table blacklist
pfctl -t blacklist -T delete $ip

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Montre la table d'ip bannie
pfctl -t blacklist -T show