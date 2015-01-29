#!/bin/sh
# ./del_rules_load_balancing.sh yes
# Ajoute une règle de load balancing

# Pointeur
answer=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
  then
  echo "Voulez-vous supprimer le load balancing"
  echo " YES or NO "
  exit 2
fi

if [ -f /var/www/script/pf/answer/$answer ] # Vérifie si la réponse existe
  then

# Supprime les règles entre la balise de load balancing
  sudo /usr/local/bin/gsed -i '/Load_balancing/,/Fin/{/Load_balancing/b;/Fin/b;/.*/d}' /etc/pf/load_balancing.conf

else
  echo "Bonne décision ..."
  exit 2
fi

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then
# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "
  
# Affiche les règles de load balancing
	sudo /bin/cat /etc/pf/load_balancing.conf
  exit 2
else
  echo "Error de syntaxe"
  exit 2
fi