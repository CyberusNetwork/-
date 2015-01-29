#!/bin/sh
# ./del_rules_pass.sh macro_interface macro_port
# Supprime une règle pass in&out tcp&udp

# Pointeur
interface=$1
port=$2

if [ $# -ne 2 ] # Vérifie qu'il y a seulement 2 argument entré
  then
  echo "Erreur : il faut entrer 2 argument."
  echo "./del_rules_pass.sh macro_interface macro_port"
  sudo /usr/local/bin/gsed -n '/'\#\ Rules_pass'/,/'\#\ Fin'/ p' /etc/pf/pass.conf
  exit 2
fi

# Supprime une règle pass
  sudo /usr/local/bin/gsed -i '/pass log on '\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/pass.conf

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/pass.conf

# Teste la config pf.conf
  sudo /sbin/pfctl -nf /etc/pf.conf
  
# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
  then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
  #sudo /sbin/pfctl -f /etc/pf.conf

  echo " La configuration ne contient pas d'erreur de syntaxe "

  # Montre les règles de block de QOS du fichier pf.conf
  sudo /usr/local/bin/gsed -n '/'\#\ Rules_pass'/,/'\#\ Fin'/ p' /etc/pf/pass.conf
  exit 2
else
  echo "Error de syntaxe"
  sudo /usr/local/bin/gsed -n '/'\#\ Rules_pass'/,/'\#\ Fin'/ p' /etc/pf/pass.conf
  exit 2
fi