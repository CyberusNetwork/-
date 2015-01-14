#!/bin/sh
# ./del_rules_pass.sh interface proto table port
# Supprime la régle de pass TCP/UDP

# Pointeur
interface=$1
protocol=$2
table=$3
port=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
    then
    echo "Erreur : il faut entrer 4 argument."
    echo "./del_rules_pass.sh "interface" "proto" "table" "port""
    sudo /bin/cat /etc/pf/pass.conf
    exit 2
fi

# Supprime la règle block pass
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto '$protocol' from { <'$table'> } port '$port'/d' /etc/pf/pass.conf

# Teste la config pf.conf
	sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then
# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "
  
# Affiche les règles de pass
	sudo /bin/cat /etc/pf/pass.conf
  exit 2
else
  echo "Error de syntaxe"
  exit 2
fi