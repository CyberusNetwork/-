#!/bin/bash

# dovecot_pwd_crypt.sh - 21/08/2014 - 23h35

# Cryptage du mot de passe pour la base de donnée de DOVECOT

password=$1

passwd_crypted=$(sudo doveadm pw -s md5-CRYPT -p $password | cut -b 12-50)
echo $passwd_crypted