#!/bin/sh
# ./del_rules_nat.sh macro_interface macro_ip
# Supprime la règle de NAT 

# Pointeur
interface=$1
ip=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
  then
  echo "Erreur : il faut entrer 2 argument."
  echo "./del_rules_nat.sh macro_interface macro_ip "
  sudo /bin/cat /etc/pf/nat.conf
  exit 2
fi

# Supprime la règle de nat
  sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' from '\$$ip\_macro' nat-to ('\$$interface\_macro')/d' /etc/pf/nat.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

# Montre les règles de NAT du fichier pf.conf
  sudo /bin/cat /etc/pf/nat.conf
  exit 2
else
  echo "Erreur de syntaxe"
  exit 2
fi