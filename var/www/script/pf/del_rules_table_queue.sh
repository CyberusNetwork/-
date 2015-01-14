#!/bin/sh
# ./del_rules_queue_parent.sh
# Supprime toute les règle d'une QOS parent
# Pointeur
name_parent=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 argument entré
  then
  echo "Erreur : il faut entrer 1 arguments."
  echo "del_rules_queue_parent.sh "name_parent_macro""
  exit 2
fi

# Purge les règles de QOS
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_QOS/,/# Fin_'$name_parent'/d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_block_QOS/,/# Fin_block_'$name_parent'/d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/# '$name_parent'_pass_QOS/,/# Fin_pass_'$name_parent'/d' /etc/pf/pass.conf
  
# Retient 0 ligne vide au début, 1 à la fin
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf

# Teste la config pf.conf s'il n'a pas d'erreur il exécute l'option -f
	sudo /sbin/pfctl -nf /etc/pf.conf

# La variable $? contient le code retour (0 = vrai et 1 = faux)
if [ "$?" == 0 ] 
	then

# Recharge la configuration, si -nf ne renvoie pas d'errreur
	#sudo /sbin/pfctl -f /etc/pf.conf

	echo " La configuration ne contient pas d'erreur de syntaxe "
	
# Montre les règles de QOS du fichier pf.conf
 	sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin_end'/ p' /etc/pf/queue.conf
  	exit 2
else
	echo "Erreur de syntaxe"
	exit 2
fi