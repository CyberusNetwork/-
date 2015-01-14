#!/bin/sh
# ./test.sh
# Monter les interfaces

ifconfig | cut -d ":" -f 1 | sed "s/.$//"