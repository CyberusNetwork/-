#!/bin/sh
# Guide ./add_table_badguys ip
# Ajoute une règle qui bannie une ip

# Pointeur
ip=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./add_table_badguys 'ip'"
# Montre la liste d'ip bannie
	sudo /sbin/pfctl -t blacklist -T show
    exit 2
fi

# Permet d'ajouter un ip à bannir
  sudo /sbin/pfctl -t blacklist -T add $ip

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

# Montre la table d'ip bannie
  /sbin/pfctl -t blacklist -T show
  exit 2
else
  echo "Erreur de syntaxe"
  exit 2
fi