#!/bin/sh
# ./add_rules_queue_parent.sh "name_parent_macro" "interface_macro" "bandwidth"
# Ajoute la règle parent QOS

# Pointeur
name_parent=$1
interface=$2
bandwidth=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 arguments entré
  then
  echo "Erreur : il faut entrer 3 arguments."
  echo "add_rules_queue_parent.sh "name_parent" "interface_macro" "bandwidth""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Purge les règles de QOS
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_QOS/,/# Fin_'$name_parent'/d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/# Default_QOS_'$name_parent'/,/# Fin_block/d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_block_QOS/,/# Fin_block_'$name_parent'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/# Pass_QOS_'$name_parent'/,/# Fin/d' /etc/pf/pass.conf
  
# Retient 0 ligne vide au début, 1 à la fin
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

# Créer les balises des règles par défaut enfants
  sudo /usr/local/bin/gsed -i '/'$name_parent'_QOS/a \# Default_'$name_parent'' /etc/pf/queue.conf
  
# Ajoute le parent de la QOS
  sudo /usr/local/bin/gsed -i '/'$name_parent'_QOS/a queue '$name_parent' on '\$$interface\_macro' bandwidth '$bandwidth'' /etc/pf/queue.conf

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin_end'/ p' /etc/pf/queue.conf
  exit 2