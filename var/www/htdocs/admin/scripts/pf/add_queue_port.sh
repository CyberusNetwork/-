#!/bin/sh
# ./add_queue_tcp_port.sh interface/'$free' port name_queue
/usr/local/bin/gsed -i '/pass in log on '$1' proto tcp to port '$2'/d' /etc/pf.conf
/usr/local/bin/gsed -i '/TCP_port/a pass in log on '$1' proto tcp to port '$2' queue '$3'' /etc/pf.conf
/sbin/pfctl -nf /etc/pf.conf
/sbin/pfctl -f /etc/pf.conf
cat /etc/pf.conf | grep "pass in log on"