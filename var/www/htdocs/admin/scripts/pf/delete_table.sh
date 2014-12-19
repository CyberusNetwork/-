#!/bin/sh
# ./delete_table.sh name
# Supprime une table

# Pointeur
table_name=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./delete_table.sh "table_name""
    exit 2
fi

# Supprime la table dans pf.conf
/usr/local/bin/gsed -i '/table <'$table_name'> persist/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Montre toute les tables
cat /etc/pf.conf | grep "table <"