#!/bin/sh
#Guide ./del_table_badguys ip
# Supprime l'ip dans la liste d'ip bannie

# Pointeur
ip=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
    then
    echo "Erreur : il faut entrer 1 argument."
    echo "./del_table_badguys "ip""
    sudo /sbin/pfctl -t blacklist -T show
    exit 2
fi

# Enleve l'ip bannie de la table blacklist
  sudo /sbin/pfctl -t blacklist -T delete $ip

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