#!/bin/sh
# ./add_rules_qpass_qos.sh macro_interface macro_port name_parent name_child 
# Ajoute une queue quick pass in&out tcp&udp

# Pointeur
interface=$1
port=$2
name_parent=$3
name_child=$4

if [ $# -ne 4 ] # Vérifie qu'il y a seulement 4 argument entré
  then
  echo "Erreur : il faut entrer 4 argument."
  echo "./add_rules_qpass_qos.sh macro_interface macro_port name_parent name_child "
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_quick_QOS'/,/'\#\ Fin_pass_quick\_$name_parent'/ p' /etc/pf/quick_pass.conf
  exit 2
fi

# Vérifie s'il existe, si oui il le supprime
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto udp from any to any port '\$$port\_macro'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto udp from any to any port '\$$port\_macro'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto udp from any to any port '\$$port\_macro'/d' /etc/pf/quick_block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto udp from any to any port '\$$port\_macro'/d' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/quick_block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto tcp from any to any port '\$$port\_macro'/d' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/quick_block.conf
  sudo /usr/local/bin/gsed -i '/'\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro'/d' /etc/pf/quick_pass.conf

# Permet d'ajouter la queue quick pass
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_quick_QOS/a pass log quick on '\$$interface\_macro' proto { tcp, udp } from any to any port '\$$port\_macro' set queue '$name_child\_$name_parent'' /etc/pf/quick_pass.conf

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
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_quick_QOS'/,/'\#\ Fin_pass_quick\_$name_parent'/ p' /etc/pf/quick_pass.conf
  exit 2
else
  echo "Error de syntaxe"
  sudo /usr/bin/sed -n '/'\#\ $name_parent\_pass_quick_QOS'/,/'\#\ Fin_pass_quick\_$name_parent'/ p' /etc/pf/quick_pass.conf
  exit 2
fi