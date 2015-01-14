#!/bin/sh
# ./test.sh
# Prototype vérification

# Pointeur
t_interface=t$1
interface=$1
ip=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
	then
	echo "Erreur : il faut entrer 2 argument."
	exit 2
fi

if [[ "$t_interface" == t* ]] # si la variable à un t alors il rentre.
	then 
	cut=`echo ${t_interface} = \" | sed 's/.\{2\}//'` # Enlève le premier caractère
	# Recherche l'interface par rapport au paramètre de la macro
	search_if=`cat /etc/pf.conf |grep "$cut" | cut -d= -f2 | sed -n 1p | sed 's/"//' | sed 's/.$//'`
	ifconfig | grep $search_if
# La variable $? contient le code retour (0 = vrai et 1 = faux)
	if [ "$?" == 0 ]
		then
		echo $bool
		echo "Interface ON"
	cat /var/www/htdocs/admin/scripts/pf/test.txt | grep 'match out on '$interface' from '$ip' nat-to ('$interface')'
# La variable $? contient le code retour (0 = vrai et 1 = faux)
		if [ "$?" == 0 ] 
			then
			echo " La règle existe déjà !"
			exit 2
		else
			echo " La règle n'existe pas. "
			echo " Création en cours ... "
		fi
	else
		echo "Interface OFF"
		exit 2
	fi
else
	echo "erreur"
	exit 2
fi