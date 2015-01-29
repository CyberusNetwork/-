#!/bin/sh
# ./disable_QOS_parent.sh name_parent
# Désactive une règle parent de QOS

# Pointeur
name_parent=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 arguments entré
  then
  echo "Erreur : il faut entrer 1 arguments."
  echo "disable_QOS_parent.sh "name_parent""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Place un # entre deux mot clé
  sudo /usr/local/bin/gsed -i '/'$name_parent'_QOS/,/Fin_'$name_parent'/ s/^/#/' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_block_QOS/,/Fin_block_'$name_parent'/ s/^/#/' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'_pass_QOS/,/\Fin_pass_'$name_parent'/ s/^/#/' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/'$name_parent'\_pass_quick_QOS/,/Fin_pass_quick\_'$name_parent'/ s/^/#/' /etc/pf/quick_pass.conf

# Retient 0 ligne vide au début, 1 à la fin
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

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin_end'/ p' /etc/pf/queue.conf
  exit 2
else
  echo "Erreur de syntaxe"
  exit 2
fi