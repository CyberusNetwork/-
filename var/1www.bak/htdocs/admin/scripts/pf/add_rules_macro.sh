#!/bin/sh
# ./add_rules_macro.sh name_macro + macro_fonction
# Ajoute et vérifie si la macro existe déjà

# Pointeur
name_macro=macro_$1
macro_fonction=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./add_rules_macro.sh "name_macro" "macro_fonction""
    exit 2
fi

# Vérifie si la macro existe déjà si oui il le supprime
/usr/local/bin/gsed -i '/'$name_macro'/d' /etc/pf.conf

# Ajoute une keyword
/usr/local/bin/gsed -i '/Macro/a '$name_macro'' /etc/pf.conf

# Ajoute le nom de la macro + sa fonction
/usr/local/bin/gsed -i "s/${name_macro}/${name_macro} = \"${macro_fonction}\"/g" /etc/pf.conf

# Teste la validité de la configuration avant l'activation
/sbin/pfctl -nf /etc/pf.conf

# Recharge la configuration, lorsque PF est déjà actif 
/sbin/pfctl -f /etc/pf.conf

# Affiche les macros
sed -n '/'\#\ Macro'/,/'\#\ Fin'/ p' /etc/pf.conf