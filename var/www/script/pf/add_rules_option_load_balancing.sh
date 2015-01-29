#!/bin/sh
# ./add_rules_load_balancing.sh macro_main_fai_macro macro_main_ip_fai macro_other_fai macro_other_ip_fai
# Ajoute deux option load balancing

# Pointeur
main_fai=$1
main_ip_fai=$2
other_fai=$3
other_ip_fai=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
  then
  echo "Erreur : il faut entrer 4 argument."
  echo "./add_rules_load_balancing.sh macro_main_fai_macro macro_main_ip_fai macro_other_fai macro_other_ip_fai"  
	sudo /bin/cat /etc/pf/load_balancing.conf
  exit 2
fi

# Vérifie s'il existe déjà
  sudo /usr/local/bin/gsed -i '/pass out log on '\$$main_fai\_macro' from '\$$other_fai\_macro' route-to ('\$$other_fai\_macro' '\$$other_ip_fai\_macro')/d' /etc/pf/load_balancing.conf
  sudo /usr/local/bin/gsed -i '/pass out log on '\$$other_fai\_macro' from '\$$main_fai\_macro' route-to ('\$$main_fai\_macro' '\$$main_ip_fai\_macro')/d' /etc/pf/load_balancing.conf

# Créer les options load balancing 
  sudo /usr/local/bin/gsed -i '/pass in log on $lan_macro from $lan_ip_macro route-to/a pass out log on '\$$main_fai\_macro' from '\$$other_fai\_macro' route-to ('\$$other_fai\_macro' '\$$other_ip_fai\_macro')' /etc/pf/load_balancing.conf
  sudo /usr/local/bin/gsed -i '/pass in log on $lan_macro from $lan_ip_macro route-to/a pass out log on '\$$other_fai\_macro' from '\$$main_fai\_macro' route-to ('\$$main_fai\_macro' '\$$main_ip_fai\_macro')' /etc/pf/load_balancing.conf

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