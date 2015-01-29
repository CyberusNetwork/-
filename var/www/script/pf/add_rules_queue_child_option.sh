#!/bin/sh
# ./add_rules_queue_child_option.sh name_parent name_child name_child_option bandwidth
# Ajoute une option de queue enfant

# Pointeur
name_parent=$1
name_child=$2
name_child_option=$3
bandwidth=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 arguments entré
	then
	echo "Erreur : il faut entrer 4 arguments."
	echo "sh add_rules_queue_child_option.sh name_parent name_child name_child_option bandwidth"
	echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
	exit 2
fi

# Vérifie si la règle existe si oui il le supprime
	sudo /usr/local/bin/gsed -i '/queue '$name_child_option\_$name_parent' parent '$name_child' bandwidth/d' /etc/pf/queue.conf

# Ajoute l'option de queue sous l'enfant
	sudo /usr/local/bin/gsed -i '/queue '$name_child' parent '$name_parent' bandwidth/a queue '$name_child_option\_$name_parent' parent '$name_child'' /etc/pf/queue.conf
	sudo /usr/local/bin/gsed -i "s/queue ${name_child_option}\_${name_parent} parent ${name_child}/queue ${name_child_option}\_${name_parent} parent ${name_child} bandwidth ${bandwidth}/g" /etc/pf/queue.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
	sudo /sbin/pfctl -nf /etc/pf.conf

# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
	#sudo /sbin/pfctl -f /etc/pf.conf

	echo " La configuration ne contient pas d'erreur de syntaxe "

# Montre les règles de QOS du fichier pf.conf
	sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin_end'/ p' /etc/pf/queue.conf
	exit 2
else
	echo "Erreur de syntaxe"
	exit 2
fi