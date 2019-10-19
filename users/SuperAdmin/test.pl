#!/usr/bin/perl
use strict;
use warnings;
use v5.10; # for say() function
 
use DBI;
say "Perl MySQL Connect Demo";
# MySQL database configuration
my $dsn = "DBI:mysql:test";
my $username = "root";
my $password = '';
 
# connect to MySQL database
my %attr = ( PrintError=>0,  # turn off error reporting via warn()
             RaiseError=>1);   # turn on error reporting via die()           
 
my $dbh  = DBI->connect($dsn,$username,$password, \%attr);
 
say "Connected to the MySQL database.";