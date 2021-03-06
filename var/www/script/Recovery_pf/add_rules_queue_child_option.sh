#!/bin/sh
# ./add_rules_queue_child_option.sh "name_parent" "name_child" "name_child_option" "bandwidth""
# Ajoute une option enfant QOS

# Pointeur
name_parent=$1
name_child=$2
name_child_option=$3
bandwidth=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 arguments entré
	then
	echo "Erreur : il faut entrer 4 arguments."
	echo "sh add_rules_queue_child_option.sh "name_parent" "name_child" "name_child_option" "bandwidth""
	echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
	exit 2
fi

# Vérifie si la règle existe si oui il le supprime
	sudo /usr/local/bin/gsed -i '/queue '$name_child_option' parent '$name_child' bandwidth/d' /etc/pf.conf

# Ajoute le parent de la QOS
	sudo /usr/local/bin/gsed -i '/queue '$name_child' parent '$name_parent' bandwidth/a queue '$name_child_option' parent '$name_child' bandwidth '$bandwidth'' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# Montre les règles de QOS du fichier pf.conf
	sudo /usr/bin/sed -n '/'\#\ QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
	exit 2