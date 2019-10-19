#!/usr/bin/perl
use strict;
use warnings;
use v5.10; # for say() function
 
use DBI;

# MySQL database configurations
my $dsn = "DBI:mysql:perlmysqldb";
my $username = "root";
my $password = '';
 
# connect to MySQL database
my %attr = ( PrintError=>0,  # turn off error reporting via warn()
             RaiseError=>1   # report error via die()
           );
my $dbh = DBI->connect($dsn,$username,$password,\%attr);
 
# query data from the links table
query_links($dbh);
 
my $file = 'C:/xampp/htdocs/Site/jnj_bi_project/users/SuperAdmin/uploads/actualSalesFileTemplate.csv' or die; 
open(my $data, '<', $file) or die; 

while (my $line = <$data>) 
{ 
	chomp $line; 

	# Split the line and store it 
	# inside the words array 
	my @words = split ", ", $line; 

	for (my $i = 0; $i <= 2; $i++) 
	{ 
		print "$words[$i] "; 
	} 
	print "\n"; 
} 

sub query_links{
  # query from the links table
 
  my ($dbh) = @_;
  my $sql = "SELECT title,
                    url
             FROM links";
  my $sth = $dbh->prepare($sql);
 
  # execute the query
  $sth->execute();
 
  while(my @row = $sth->fetchrow_array()){
     printf("%s\t%s\n",$row[0],$row[1]);
  }       
  $sth->finish();
}

# disconnect from the MySQL database
$dbh->disconnect();


