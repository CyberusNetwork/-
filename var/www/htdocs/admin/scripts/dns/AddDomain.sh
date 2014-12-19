#!/bin/sh
echo " Entrez le nom du domaine : "

#on rentre le nom du domaire
read domaine

#crÃ©ation du champ A

echo " " >> /var/tinydns/root/data
echo "Interne de Â$domaine" >> /var/tinydns/root/data
echo " " >> /var/tinydns/root/data
echo "+$domaine.cbnet.itinet.fr:10.8.100.2:1800:::in" >> /var/tinydns/root/data
echo ".$domaine.cbnet.itinet.fr:10.8.100.2:ns.cbnet.itinet.fr:7200:::in" >> /var/tinydns/root/data
echo "@$domaine.cbnet.itinet.fr:10.8.100.2:$domaine.cbnet.itinet.fr::7200:::in" >> /var/tinydns/root/data
echo "C$domaine.cbnet.itinet.fr:$domaine.cbnet.itinet.fr:7200:::in" >> /var/tinydns/root/data

echo " " >> /var/tinydns/root/data
echo "Interne de $domaine" >> /var/tinydns/root/data
echo " " >> /var/tinydns/root/data
echo "+$domaine.cbnet.itinet.fr:88.177.168.133:::ex" >> /var/tinydns/root/data
echo ".$domaine.cbnet.itinet.fr:88.177.168.133:ns.cbnet.itinet.fr:7200:::ex" >> /var/tinydns/root/data
echo "@$domaine.cbnet.itinet.fr:88.177.168.133:$domaine.cbnet.itinet.fr::7200:::ex" >> /var/tinydns/root/data
echo "C$domaine.cbnet.itinet.fr:$domaine.cbnet.itinet.fr:7200:::ex" >> /var/tinydns/root/data

