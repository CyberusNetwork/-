#!/bin/sh
# ./del_rules_macro.sh name_macro

# Pointeur
name_macro=$1_macro

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./del_rules_macro.sh "name_macro""
    sudo /usr/bin/sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf.conf
    exit 2
fi

# Vérifie si la macro existe déjà si oui il le supprime
	sudo /usr/local/bin/gsed -i '/'$name_macro'/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
	sudo /sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
	sudo /sbin/pfctl -f /etc/pf.conf

# montre les macros
	sudo /usr/bin/sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf.conf
	exit 2