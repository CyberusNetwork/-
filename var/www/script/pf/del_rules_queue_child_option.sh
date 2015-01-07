#!/bin/sh
# ./del_rules_queue_child_option.sh "name_child" "name_child_option"
# Ajoute une option enfant QOS

# Pointeur
name_child=$1
name_child_option=$2
bandwidth=$3

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 arguments entré
	then
	echo "Erreur : il faut entrer 4 arguments."
	echo "add_rules_queue_child_option.sh "name_child" "name_child_option""
	exit 2
fi

# Supprime la règle
	sudo /usr/local/bin/gsed -i '/queue '$name_child_option' parent '$name_child' bandwidth/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# Montre les règles de QOS du fichier pf.conf
	sudo /usr/bin/sed -n '/'\#\ QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
	exit 2