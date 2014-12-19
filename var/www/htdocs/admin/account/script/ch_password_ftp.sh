#!/bin/bash

#  ch_passwd_ftp.sh - 17/08/2014 - 20h25

#  Fichier de création des USER - sFTP

user=$1
passwd=$2

#  Changement du mot de passe du USER

sudo usermod --password $(echo $passwd | openssl passwd -1 -stdin) $user
