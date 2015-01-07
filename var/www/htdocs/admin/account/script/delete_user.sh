#!/bin/bash

#  delete_user.sh - 15/08/2014 - 14h07

#  Suppression d'un USER

user=$1

killall -KILL -u $user
sudo userdel -r $user
