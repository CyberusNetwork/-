#!/usr/bin/perl -w
use strict;

my $mailadmin = 'a.thibault@fairsys.fr';
my $services = '/var/www/htdocs/admin/db/pslist.log';
my $pathpsfile = '/var/www/htdocs/admin/db/psfile.log';

# Génération du fichier listant les processus ouverts
system("/bin/ps -auxc > $pathpsfile");

# Traitement du fichier des processus ouvert
if (open (SERVICE, $services))
{
    while (defined (my $service = <SERVICE>))
    {
    	chomp $service;
    	my $command = "cat $pathpsfile | grep $service | awk '{print " . '$11' . "}' | head -n1";
#    	print $command . "\n";
    	my $psfilecheck = qx{$command};
#    	print $psfilecheck;

        my $result = $psfilecheck cmp $service;
    	if ($result > 0)
        {
            print "$service is running" . "\n";
#            print $psfilecheck  . "\n";
#            print $result  . "\n";
        }
        else
        {
            print "MAJOR Alert: The service $service is NOT running" . "\n";
#            print $psfilecheck  . "\n";
#            print $result  . "\n";
            system("ps -auxc | mail -s \"MAJOR Alert: The service $service is NOT running\" $mailadmin");
        }
    }
}
else
{
    print "Erreur lors de l'ouverture du fichier $services\n";
    exit(1);
}
