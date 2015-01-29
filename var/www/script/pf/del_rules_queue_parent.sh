#!/bin/sh
# ./del_rules_queue_parent.sh name_parent
# Supprime toute les règle d'une queue

# Pointeur
name_parent=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
  then
  echo "Erreur : il faut entrer 1 arguments."
  echo "del_rules_queue_parent.sh name_parent"
  exit 2
fi

# Purge les règles de queue
  sudo /usr/local/bin/gsed -i '/'$name_parent'_QOS/,/Fin_'$name_parent'/d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_block_QOS/,/Fin_block_'$name_parent'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_QOS/,/Fin_pass_'$name_parent'/d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_quick_QOS/,/Fin_pass_quick_'$name_parent'/d' /etc/pf/quick_pass.conf
  
# Enlève les sauts de ligne en trop
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/quick_pass.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
	sudo /sbin/pfctl -nf /etc/pf.conf

# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
	#sudo /sbin/pfctl -f /etc/pf.conf

	echo " La configuration ne contient pas d'erreur de syntaxe "
	
# Montre les règles de queue du fichier pf.conf
 	sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin_end'/ p' /etc/pf/queue.conf
  	exit 2
else
	echo "Erreur de syntaxe"
	exit 2
fi