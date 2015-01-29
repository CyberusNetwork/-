#!/bin/sh
# ./pf_purge.sh yes
# Remet la configuration à zéro

# Pointeur
answer=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 arguments entré
    then
    echo "Voulez-vous rénitialiser la configuration PF ?"
    echo " YES or NO "
    exit 2
fi

if [ -f /var/www/script/pf/answer/$answer ] # Vérifie si la réponse existe
  then
    sudo /bin/rm -r /etc/pf_old/
    sudo /bin/mv -r /etc/pf/ etc/pf_old/
    sudo /bin/cp -r /etc/pf_backup /etc/pf/
else
  echo "Bonne décision ..."
  exit 2
fi

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

  exit 2
else
  echo "Erreur de syntaxe"
  exit 2
fi