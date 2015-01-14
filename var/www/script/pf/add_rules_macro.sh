#!/bin/sh
# ./add_rules_macro.sh 'name_macro' 'macro_fonction'
# Ajoute et vérifie si la macro existe déjà

# Pointeur
name_macro=$1_macro
macro_fonction=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./add_rules_macro.sh "name_macro" "macro_fonction""
	sudo /usr/bin/sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf/macro.conf
    exit 2
fi

# Vérifie si la macro existe déjà si oui, il le supprime
	sudo /usr/local/bin/gsed -i '/'$name_macro'/d' /etc/pf/macro.conf

# Ajoute une keyword
	sudo /usr/local/bin/gsed -i '/Macro/a '$name_macro'' /etc/pf/macro.conf

# Ajoute la fonction de la macro
	sudo /usr/local/bin/gsed -i "s/${name_macro}/${name_macro} = \"${macro_fonction}\"/g" /etc/pf/macro.conf

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