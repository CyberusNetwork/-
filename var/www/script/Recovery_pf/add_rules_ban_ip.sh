#!/bin/sh
# Guide ./add_rules_ban_ip ip
# Ajoute une règle qui bannie une ip

# Pointeur
ip=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./add_rules_ban_ip 'ip'"
# Montre la liste d'ip bannie
	pfctl -t blacklist -T show
    exit 2
fi

# Permet d'ajouter un ip à bannir
pfctl -t blacklist -T add $ip

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Montre la liste d'ip bannie
pfctl -t blacklist -T show