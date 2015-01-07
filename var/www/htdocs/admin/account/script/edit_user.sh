#!bin/bash

#  edit_user.sh - 17/08/2014 - 20h21

#  Modification du USER

userold=$1
usernew=$2

sudo usermod -l $userold $usernew
