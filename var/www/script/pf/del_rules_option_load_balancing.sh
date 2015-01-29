#!/bin/sh
# ./del_rules_load_balancing.sh macro_main_fai_macro macro_other_fai
# Ajoute deux option load balancing

# Pointeur
main_fai=$1
other_fai=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
  then
  echo "Erreur : il faut entrer 2 argument."
  echo "./del_rules_load_balancing.sh macro_main_fai_macro macro_other_fai"  
	sudo /bin/cat /etc/pf/load_balancing.conf
  exit 2
fi

# Supprime les règles
  sudo /usr/local/bin/gsed -i '/pass out log on '\$$main_fai\_macro' from '\$$other_fai\_macro' route-to/d' /etc/pf/load_balancing.conf
  sudo /usr/local/bin/gsed -i '/pass out log on '\$$other_fai\_macro' from '\$$main_fai\_macro' route-to/d' /etc/pf/load_balancing.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then
# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "
  
# Affiche les ports ip bloqué
	sudo /bin/cat /etc/pf/load_balancing.conf
  exit 2
else
  echo "Error de syntaxe"
  exit 2
fi