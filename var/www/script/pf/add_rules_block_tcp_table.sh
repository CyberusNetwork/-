#!/bin/sh
# ./add_rules_block_tcp.sh in/out macro_interface macro_port table
# Ajoute une règle block tcp utilisant une table dynamique


# Pointeur
in_out=$1
interface=$2
port=$3
table=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
  then
  echo "Erreur : il faut entrer 4 argument."
  echo "./add_rules_block_tcp.sh in/out macro_interface macro_port table"
  sudo /usr/local/bin/gsed -n '/'\#\ Block_tcp'/,/'\#\ Fin'/ p' /etc/pf/block.conf
  exit 2
fi

# Vérifie s'il existe, si oui il le supprime
  sudo /usr/local/bin/gsed -i '/'$in_out' log on '\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'$in_out' log on '\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'$in_out' log quick on '\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/quick_block.conf
  sudo /usr/local/bin/gsed -i '/'$in_out' log quick on '\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/quick_block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'$in_out' log on '\$$interface\_macro' proto tcp from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'$in_out' log on '\$$interface\_macro' proto tcp from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'$in_out' log quick on '\$$interface\_macro' proto tcp from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/quick_block.conf
  sudo /usr/local/bin/gsed -i '/'$in_out' log quick on '\$$interface\_macro' proto tcp from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/quick_block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from { <'$table'> } to port '\$$port\_macro'/d' /etc/pf/quick_pass.conf

# Permet d'ajouter une règle de block tcp utilisant une table dynamique
  sudo /usr/local/bin/gsed -i '/Block_tcp/a block '$in_out' log on '\$$interface\_macro' proto tcp from { <'$table'> } to port '\$$port\_macro'' /etc/pf/block.conf

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/block.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

  # Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/local/bin/gsed -n '/'\#\ Block_tcp'/,/'\#\ Fin'/ p' /etc/pf/block.conf
  exit 2
else
  echo "Error de syntaxe"
  sudo /usr/local/bin/gsed -n '/'\#\ Block_tcp'/,/'\#\ Fin'/ p' /etc/pf/block.conf
  exit 2
fi