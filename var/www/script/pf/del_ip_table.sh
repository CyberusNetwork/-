#!/bin/sh
# Guide ./del_ip_table.sh nom_de_la_table ip
# Supprime une ip dans une table

# Pointeur
table=$1
ip=$2

if [ $# -ne 2 ] # Vérifie qu'il y a 2 arguments entré
    then
    echo "Erreur : il faut entrer 2 argument."
    echo "./del_ip_table.sh nom_de_la_table ip"
    sudo /sbin/pfctl -t $table -T show
    exit 2
fi

# Enleve l'ip de la table
  sudo /sbin/pfctl -t $table -T delete $ip

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

# Montre la table d'ip bannie
  sudo /sbin/pfctl -t $table -T show
  exit 2
else
  echo "Erreur de syntaxe"
  exit 2
fi