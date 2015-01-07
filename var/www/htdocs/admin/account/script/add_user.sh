#!/bin/bash

#  add_user_ftp.sh - 17/08/2014 - 19h32

#  Fichier de création des USER - sFTP

user=$1
passwd=$2

    #  Création du USER

sudo useradd --create-home --password $(echo $passwd | openssl passwd -1 -stdin) --shell /bin/sh $user
sudo useradd -p