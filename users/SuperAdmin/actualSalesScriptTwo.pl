#!/usr/bin/perl
use strict;
use warnings;
use DBI;
 
#C:/xampp/htdocs/Site/jnj_bi_project/users/SuperAdmin/uploads/actualSalesFileTemplate_new.csv

my $file = 'uploads/actualSalesFileTemplate_new.csv' or die "Please pass CSV file on command line\n";
my $username = "root";
my $password = "";
my $dbh = DBI->connect("DBI:mysql:database=test;host=localhost", $username, $password, {'RaiseError' => 1});
my @fields;
 
#Drop table test if it exists
$dbh->do("DROP TABLE if exists test");
 
#Create table test
$dbh->do("CREATE TABLE test (id INT(2) PRIMARY KEY, username VARCHAR(25), email VARCHAR(15))");
 
open(my $data, '<', $file) or die "Could not open '$file' $!\n";
 
while (my $line = <$data>) {
    chomp $line;
    @fields = split "," , $line;
    my $output = pushvalues(@fields);
  print "$output";
}
 
sub pushvalues {
    my @toinsert = @_;
    my $rowinsert = $dbh->prepare("INSERT INTO jnj_actualsalesvalue VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $rowinsert->execute($toinsert[0],$toinsert[1],$toinsert[2],$toinsert[3],$toinsert[4],$toinsert[5],$toinsert[6],$toinsert[7],$toinsert[8],$toinsert[9],$toinsert[10],$toinsert[11],$toinsert[12],$toinsert[13],$toinsert[14],$toinsert[15],$toinsert[16],$toinsert[17],$toinsert[18],$toinsert[19],$toinsert[20],$toinsert[21],$toinsert[22],$toinsert[23],$toinsert[24],$toinsert[25],$toinsert[26],$toinsert[27],$toinsert[28]);
}
