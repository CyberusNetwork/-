#!/bin/sh
# ./add_rules_nat.sh 'in/out' 'macro_interface' ip
# Ajoute une règle de NAT 

# Pointeur
in_out=$1
interface=$2
ip=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 argument entré
    then
    echo "Erreur : il faut entrer 3 argument."
    echo "./add_rules_nat.sh 'in/out' macro_interface' 192.168.0.0/20 "
	sudo /bin/cat /etc/pf/nat.conf
    exit 2
fi

# Vérifie si la NAT existe si oui il le supprime
  sudo /usr/local/bin/gsed -i '/match '$in_out' on '\$$interface\_macro' from '$ip' nat-to ('\$$interface\_macro')/d' /etc/pf/nat.conf

# Ajoute la NAT
  sudo /usr/local/bin/gsed -i '/NAT/a match '$in_out' on '\$$interface\_macro' from '$ip' nat-to ('\$$interface\_macro')' /etc/pf/nat.conf

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