#!/bin/sh
# ./add_rules_queue_parent.sh parent_name macro_interface bandwidth
# Ajoute la règle parent de la queue

# Pointeur
name_parent=$1
interface=$2
bandwidth=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 arguments entré
  then
  echo "Erreur : il faut entrer 3 arguments."
  echo "add_rules_queue_parent.sh name_parent interface_macro bandwidth"
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Purge les règles de queue
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_QOS/,/# Fin_'$name_parent'/d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/# Default_QOS_'$name_parent'/,/# Fin_block/d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_block_QOS/,/# Fin_block_'$name_parent'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_pass_QOS/,/# Fin_pass_'$name_parent'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_pass_quick_QOS/,/# Fin_pass_quick_'$name_parent'/d' /etc/pf/quick_pass.conf

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf

# Créer les balises des règles enfants
  sudo /usr/local/bin/gsed -i '/Queue/a \# '$name_parent'_QOS' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_QOS/a \# Fin_'$name_parent'\n' /etc/pf/queue.conf

# Créer les balises des règles block
  sudo /usr/local/bin/gsed -i '/Block_queue/a \# '$name_parent'_block_QOS' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_block_QOS/a \# Fin_block_'$name_parent'\n' /etc/pf/block.conf

# Créer les balises des règles pass
  sudo /usr/local/bin/gsed -i '/Pass_queue/a \# '$name_parent'_pass_QOS' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_QOS/a \# Fin_pass_'$name_parent'\n' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_QOS/a \# '$name_parent'_pass_tcp_QOS' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_tcp_QOS/a \# Fin_pass_tcp_'$name_parent'' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/Fin_pass_tcp_'$name_parent'/a \# '$name_parent'_pass_udp_QOS' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_udp_QOS/a \# Fin_pass_udp_'$name_parent'' /etc/pf/pass.conf

# Créer les balises des règles quick pass
  sudo /usr/local/bin/gsed -i '/Pass_quick_queue/a \# '$name_parent'_pass_quick_QOS' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_quick_QOS/a \# Fin_pass_quick_'$name_parent'\n' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_quick_QOS/a \# '$name_parent'_pass_tcp_quick_QOS' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_tcp_quick_QOS/a \# Fin_pass_tcp_quick_'$name_parent'' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/Fin_pass_tcp_quick_'$name_parent'/a \# '$name_parent'_pass_udp_quick_QOS' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_udp_quick_QOS/a \# Fin_pass_udp_quick_'$name_parent'' /etc/pf/quick_pass.conf  

# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/quick_pass.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/block.conf

# Créer les balises de règle par défaut enfant
  sudo /usr/local/bin/gsed -i '/'$name_parent'_QOS/a \# Default_'$name_parent'' /etc/pf/queue.conf
  
# Ajoute le parent de la queue
  sudo /usr/local/bin/gsed -i '/'$name_parent'_QOS/a queue '$name_parent' on '\$$interface\_macro' bandwidth '$bandwidth'' /etc/pf/queue.conf

# Montre les règles de queue du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin_end'/ p' /etc/pf/queue.conf
  exit 2