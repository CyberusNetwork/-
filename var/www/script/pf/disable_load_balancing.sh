#!/bin/sh
# ./disable_load_balancing.sh y
# Désactive le load_balancing

# Pointeur
answer=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 arguments entré
    then
    echo "Voulez-vous désactiver le Load Balancing"
    echo " YES or NO "
    exit 2
fi

if [ -f /var/www/script/pf/answer/$answer ] # Vérifie si la réponse existe
  then
# Place un # entre deux mot clé
  sudo /usr/local/bin/gsed -i '/\#\ Load_balancing/,/\#\ Fin/ s/^/#/' /etc/pf/load_balancing.conf
  
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

# Montre les règles de load balancing du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Load_balancing'/,/'\#\ Fin'/ p' /etc/pf/load_balancing.conf
  exit 2
else
  echo "Erreur de syntaxe"
  exit 2
fi