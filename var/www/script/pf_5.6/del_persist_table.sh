#!/bin/sh
# ./del_persist_table.sh name
# Supprime une table

# Pointeur
table_name=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./del_persist_table.sh "table_name""
    sudo cat /etc/pf.conf | grep "table <"
    exit 2
fi

# Supprime la table dans pf.conf
	sudo /usr/local/bin/gsed -i '/table <'$table_name'> persist/d' /etc/pf.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
	sudo /sbin/pfctl -nf /etc/pf.conf

# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
	sudo /sbin/pfctl -f /etc/pf.conf

	echo " La configuration ne contient pas d'erreur de syntaxe "

	# Montre toutes les tables
	sudo cat /etc/pf.conf | grep "table <"
	exit 2
else
	echo "Erreur de syntaxe"
	exit 2
fi