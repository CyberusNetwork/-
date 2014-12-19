#!/bin/sh

mailadmin=a.thibault@fairsys.fr
alertlevelmin=80
alertlevelmax=90
partition=/

diskused=$(/bin/df -kP $partition | /usr/bin/tail -n1 | /usr/bin/awk '{print $5}' | /usr/bin/sed 's/%$//')

if [ $diskused -ge $alertlevelmin ] && [ $diskused -lt $alertlevelmax ]; then
	echo  "[CBNET] MAJOR Alert: Almost out of disk space on Cyberus Server ($diskused % used on $partition)"
	df -h | mail -s "[CBNET] MAJOR Alert: Almost out of disk space on Cyberus Server ($diskused % used on $partition)"  $mailadmin
fi
