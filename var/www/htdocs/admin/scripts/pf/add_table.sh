#!/bin/sh
# ./add_table.sh table_name
# Ajoute une table

# Pointeur
table_name=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./add_table.sh "table_name""
    exit 2
fi

# Ajoute une table dans pf.conf
/usr/local/bin/gsed -i '/Table_list/a table <'$table_name'> persist' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Montre toute les tables
cat /etc/pf.conf | grep "table <"