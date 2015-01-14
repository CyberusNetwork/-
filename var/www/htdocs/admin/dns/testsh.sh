#!/bin/sh
domain="test3.cbnet.itinet.fr"
type="A"
target="10.8.100.13"
local="local_data"

#echo $domain
#echo $type
#echo $target
#echo $local

req="unbound-control $local $domain $type $target"
#echo $req
final=$($req)
echo $final
