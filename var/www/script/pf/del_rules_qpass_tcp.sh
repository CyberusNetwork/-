#!/bin/sh
# ./del_rules_qpass_tcp.sh in/out macro_interface macro_port
# Supprime une règle quick pass tcp

# Pointeur
in_out=$1
interface=$2
port=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 argument entré
  then
  echo "Erreur : il faut entrer 3 argument."
  echo "./del_rules_qpass_tcp.sh in/out macro_interface macro_port"
  sudo /usr/local/bin/gsed -n '/'\#\ Quick_pass_tcp'/,/'\#\ Fin'/ p' /etc/pf/quick_pass.conf
  exit 2
fi

# Supprime une règle quick pass
  sudo /usr/local/bin/gsed -i '/pass '$in_out' log quick on '\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/quick_pass.conf

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/quick_pass.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

  # Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Quick_pass_tcp'/,/'\#\ Fin'/ p' /etc/pf/quick_pass.conf
  exit 2
else
  echo "Error de syntaxe"
  sudo /usr/bin/sed -n '/'\#\ Quick_pass_tcp'/,/'\#\ Fin'/ p' /etc/pf/quick_pass.conf
  exit 2
fi