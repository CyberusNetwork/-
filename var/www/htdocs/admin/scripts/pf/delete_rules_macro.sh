#!/bin/sh
# ./delete_rules_macro.sh name_macro

# Pointeur
name_macro=macro_$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./delete_rules_macro.sh "name_macro""
    exit 2
fi

# Vérifie si la macro existe déjà si oui il le supprime
/usr/local/bin/gsed -i '/'$name_macro'/d' /etc/pf.conf

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# cat the macro
sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf.conf