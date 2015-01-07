#!/bin/sh
# ./add_rules_queue_child.sh "name_parent" "name_child" "bandwidth"
# Ajoute une règle enfant QOS

# Pointeur
name_parent=$1
name_child=$2
bandwidth=$3

if [ $# -ne 3 ] # Vérifie qu'il y a seulement 3 arguments entré
  then
  echo "Erreur : il faut entrer 3 arguments."
  echo "add_rules_queue_child.sh "name_parent" "name_child" "bandwidth""
  echo "bandwidth = K kilobits, M mégabits et G gigabits par seconde."
  exit 2
fi

# Vérifie si la règle existe si oui il le supprime
  sudo /usr/local/bin/gsed -i '/'$name_child' parent '$name_parent' bandwidth/d' /etc/pf.conf

# Ajoute le parent de la QOS
  sudo /usr/local/bin/gsed -i '/queue '$name_parent' on /a queue '$name_child' parent '$name_parent'' /etc/pf.conf

# Ajoute le nom de la macro + sa fonction
	#sudo /usr/local/bin/gsed -i "s/${name_macro}/${name_macro} = \"${macro_fonction}\"/g" /etc/pf.conf
	sudo /usr/local/bin/gsed -i "s/queue ${name_child} parent ${name_parent}/queue ${name_child} parent ${name_parent} bandwidth ${bandwidth}/g" /etc/pf.conf

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ QOS'/,/'\#\ Fin'/ p' /etc/pf.conf
  exit 2