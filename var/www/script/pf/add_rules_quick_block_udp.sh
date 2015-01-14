#!/bin/sh
# ./add_rules_quick_block_udp.sh interface proto table port
# Ajoute une règle quick qui bloque l'accès d'un port du protocol udp

# Pointeur
in_out=$1
interface=$2
table=$3
port=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
  then
  echo "Erreur : il faut entrer 4 argument."
  echo "./add_rules_quick_block_udp.sh "in_out" "interface" "table" "port""
	sudo /bin/cat /etc/pf/quick.conf
  exit 2
fi
# Vérifie s'il existe déjà
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'/d' /etc/pf/quick.conf
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'/d' /etc/pf/block.conf
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'/d' /etc/pf/quick.conf
	sudo /usr/local/bin/gsed -i '/on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'/d' /etc/pf/pass.conf

# Permet de créer la règle de blocage de port par table ip
	sudo /usr/local/bin/gsed -i '/Quick_block_udp/a block '$in_out' log quick on '\$$interface\_macro' proto udp from { <'$table'> } to port '$port'' /etc/pf/quick.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then
# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "
  
# Affiche les ports ip bloqué
	sudo /bin/cat /etc/pf/quick.conf
  exit 2
else
  echo "Error de syntaxe"
  exit 2
fi