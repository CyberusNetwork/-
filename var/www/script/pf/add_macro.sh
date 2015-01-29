#!/bin/sh
# ./add_rules_macro.sh macro_name "macro_function"
# Ajoute et vérifie si la macro existe déjà

# Pointeur
macro_name=$1_macro
macro_function=$2

if [ $# -ne 2 ] # Vérifie qu'il y a 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./add_rules_macro.sh macro_name "macro_function""
	sudo /usr/bin/sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf/macro.conf
    exit 2
fi

# Vérifie si la macro existe déjà si oui, il le supprime
	sudo /usr/local/bin/gsed -i '/'$macro_name'/d' /etc/pf/macro.conf

# Ajoute une keyword
	sudo /usr/local/bin/gsed -i '/Macro/a '$macro_name'' /etc/pf/macro.conf

# Ajoute la fonction de la macro
	sudo /usr/local/bin/gsed -i "s/${macro_name}/${macro_name} = \"${macro_function}\"/g" /etc/pf/macro.conf

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