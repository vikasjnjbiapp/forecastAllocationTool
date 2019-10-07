#!/usr/bin/perl
use strict;
use warnings;
use DBI;
 
my $file = 'C:/xampp/htdocs/Site/jnj_bi_project/users/SuperAdmin/uploads/actualSalesFileTemplate.csv' or die "Please pass CSV file on command line\n";
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
    pushvalues(@fields);
}
 
sub pushvalues {
    my @toinsert = @_;
    my $rowinsert = $dbh->prepare("INSERT INTO nj_actualsalesvalue VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
    $rowinsert->execute($toinsert[0],$toinsert[1],$toinsert[2],$toinsert[3],$toinsert[4],$toinsert[5],$toinsert[6],$toinsert[7],$toinsert[8],$toinsert[9],$toinsert[10],$toinsert[11],$toinsert[12],$toinsert[13],$toinsert[14],$toinsert[15],$toinsert[16],$toinsert[17],$toinsert[18],$toinsert[19]);
}
