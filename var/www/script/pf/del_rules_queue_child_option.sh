#!/bin/sh
# ./del_rules_queue_child_option.sh name_parent name_child name_child_option
# Supprime une option de queue enfant

# Pointeur
name_parent=$1
name_child=$2
name_child_option=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 4 arguments entré
	then
	echo "Erreur : il faut entrer 3 arguments."
	echo "add_rules_queue_child_option.sh name_parent name_child name_child_option"
	exit 2
fi

# Supprime la règle
	sudo /usr/local/bin/gsed -i '/queue '$name_child_option\_$name_parent' parent '$name_child' bandwidth/d' /etc/pf/queue.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
	sudo /sbin/pfctl -nf /etc/pf.conf

# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
	#sudo /sbin/pfctl -f /etc/pf.conf

	echo " La configuration ne contient pas d'erreur de syntaxe "

# Montre les règles de QOS du fichier pf.conf
	sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin'/ p' /etc/pf/queue.conf
	exit 2
else
	echo "Erreur de syntaxe"
	exit 2
fi