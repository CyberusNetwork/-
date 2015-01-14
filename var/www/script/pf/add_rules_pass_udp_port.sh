#!/bin/sh
# ./add_rules_pass_udp_port.sh interface table port
# Ajoute une règle pour le passage d'un flux de port du protocol udp dans une interface

#Pointeur
in_out=$1
interface=$2
table=$3
port=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
    then
    echo "Erreur : il faut entrer 4 argument."
    echo "./add_rules_pass_udp_port.sh "in_out" "interface" "table" "port""
    sudo /usr/local/bin/gsed -n '/'\#\ UDP_port'/,/'\#\ Fin_tcp'/ p' /etc/pf/pass.conf
    exit 2
fi

# Vérifie s'il existe déjà
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'/d' /etc/pf/quick.conf
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'/d' /etc/pf/block.conf
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'/d' /etc/pf/quick.conf
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'/d' /etc/pf/pass.conf

# Permet d'ajouter le passage du flux
	sudo /usr/local/bin/gsed -i '/UDP_port/a pass '$in_out' log on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'' /etc/pf/pass.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then
# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "
  
# Montre la table de passage du UDP_port
	sed -n '/'\#\ UDP_port'/,/'\#\ Fin_udp'/ p' /etc/pf/pass.conf
  exit 2
else
  echo "Error de syntaxe"
  exit 2
fi