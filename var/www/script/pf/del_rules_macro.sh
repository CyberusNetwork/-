#!/bin/sh
# ./del_rules_macro.sh name_macro

# Pointeur
name_macro=$1_macro

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./del_rules_macro.sh "name_macro""
    sudo /usr/bin/sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf/macro.conf
    exit 2
fi

# Si la macro existe, il le supprime
	sudo /usr/local/bin/gsed -i '/'$name_macro'/d' /etc/pf/macro.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
	sudo /sbin/pfctl -nf /etc/pf.conf
	
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then
	
# Recharge la configuration, si -nf ne renvoie pas d'errreur
	#sudo /sbin/pfctl -f /etc/pf.conf

	echo " La configuration ne contient pas d'erreur de syntaxe "

	# Affiche les macros
	sudo /usr/bin/sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf/macro.conf
	exit 2
else
	echo "Erreur de syntaxe"
	exit 2
fi