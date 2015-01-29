#!/bin/sh
# ./disable_QOS_parent.sh
# Désactive la QOS

# Pointeur
answer=$1

if [ $# -ne 1 ] # Vérifie qu'il y a seulement 1 arguments entré
    then
    echo "Voulez-vous désactiver la QOS"
    echo " YES or NO "
    exit 2
fi

if [ -f /var/www/script/pf/answer/$answer ] # Vérifie si la réponse existe
  then
# Place un # entre deux mot clé
  sudo /usr/local/bin/gsed -i '/Queue/,/\Fin_end/ s/^/#/' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/Block_queue/,/Fin_end/ s/^/#/' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/Pass_queue/,/Fin_end/ s/^/#/' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/Pass_quick_queue/,/Fin_end/ s/^/#/' /etc/pf/quick_pass.conf
  
# Retient 0 ligne vide au début, 1 à la fin
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/queue.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/block.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/pass.conf
  sudo /usr/local/bin/gsed -i '/./,/^$/!d' /etc/pf/quick_pass.conf

else
  echo "Bonne décision ..."
  exit 2
fi

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