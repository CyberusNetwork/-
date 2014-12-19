#!/bin/bash

#  add_sd_dns.sh - 24/08/2014 - 14h12

#  Création d'entrée DNS

subdomain=$1
user=$2
type=$3
target=$4
dns_user=/etc/bind/db.dev.fairsys.fr
date=$(date +"%Y%m%d")
serial=$(head -n 4 $dns_user | tail -n 1 | cut -d " " -f 33)
serial_date=$(head -n 4 $dns_user | tail -n 1 | cut -d " " -f 33 | cut -b 1-8)
serial_1=$((serial+1))
serial_new=$(date +"%Y%m%d"00)


    #  Modification d'une entrée DNS

echo "$subdomain.$user			IN	$type		$target" >> $dns_user

    #  Modification sur Serial

        #  Vérification de la date du Serial
if [ $serial_date = $date ]; then
    sed -i -e 's|'"$serial"'|'"$serial_1"'|g' $dns_user

        #  Si mauvaise date --> Remplacement par la nouvelle
else
    sed -i -e 's|'"$serial"'|'"$serial_new"'|g' $dns_user

fi

    #  Redémarrage de Bind9

sudo service bind9 restart

