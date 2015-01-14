#!/bin/sh
# ./add_persist_table.sh "table_name"
# Ajoute une table

# Pointeur
table_name=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./add_persist_table.sh "table_name""
    sudo cat /etc/pf/table.conf
    exit 2
fi

# Vérifie si la table existe dans pf si oui il le supprime
	sudo /usr/local/bin/gsed -i '/table <'$table_name'> persist/d' /etc/pf/table.conf

# Ajoute une table dans pf.conf
	sudo /usr/local/bin/gsed -i '/Table_list/a table <'$table_name'> persist' /etc/pf/table.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
	sudo /sbin/pfctl -nf /etc/pf.conf

# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
	#sudo /sbin/pfctl -f /etc/pf.conf

	echo " La configuration ne contient pas d'erreur de syntaxe "
	
	# Montre toutes les tables
	sudo cat /etc/pf/table.conf
	exit 2
else
	echo "Erreur de syntaxe"
	exit 2
fi