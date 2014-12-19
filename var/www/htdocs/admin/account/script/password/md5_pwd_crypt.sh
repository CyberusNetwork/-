#!/bin/bash

#  md5_pwd_crypt.sh - 3/09/2014 - 14h14

#  Shell de cryptage du mot de passe pour dovecot

passwd_crypted=$(echo "$1" | openssl passwd -1 -stdin)
echo $passwd_crypted