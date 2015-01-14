#!/bin/sh
# ./add_table.sh table_name
# Ajoute une table

# Pointeur
table_name=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./add_table.sh "table_name""
    sudo cat /etc/pf.conf | grep "table <"
    exit 2
fi

# Vérifie si la table existe dans pf si oui il le supprime
	sudo /usr/local/bin/gsed -i '/table <'$table_name'> persist/d' /etc/pf.conf

# Ajoute une table dans pf.conf
	sudo /usr/local/bin/gsed -i '/Table_list/a table <'$table_name'> persist' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# Montre toutes les tables
	sudo cat /etc/pf.conf | grep "table <"
	exit 2