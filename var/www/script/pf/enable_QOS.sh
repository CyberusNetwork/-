#!/bin/sh
# ./enable_QOS_parent.sh "name_parent_macro"
# Active la QOS

# Pointeur
answer=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 arguments entré
    then
    echo "Voulez-vous activer la QOS"
    echo " YES or NO "
    exit 2
fi

if [ -f /var/www/script/pf/$answer ] # Vérifie si la réponse existe

# Enlève les # entre deux mot clé
  sudo /usr/local/bin/gsed -i '/# Queue/,/# Fin_end/ s/^#//' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/# Block_queue/,/# Fin/ s/^#//' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/# Pass_queue/,/# Fin/ s/^#//' /etc/pf/pass.conf
  
# Retient 0 ligne vide au début, 1 à la fin
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/pass.conf

# Montre les règles de QOS du fichier pf.conf
  sudo /usr/bin/sed -n '/'\#\ Queue'/,/'\#\ Fin_end'/ p' /etc/pf/queue.conf
    exit 2
else
    echo "Bonne décision ..."
    exit 2
fi