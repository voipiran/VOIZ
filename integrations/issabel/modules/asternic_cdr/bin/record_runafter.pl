#!/usr/bin/perl
#
# Script to post process recordings in Asterisk / IssabelPBX
#
# You can set in IssabelPBX the "Run After Record" parameter
# to be: 
#
#  /var/lib/asterisk/bin/record_runafter.pl ^{UNIQUEID} ^{MIXMONITOR_FILENAME}
#
#
# In order to process queue recordings for Asternic, you will have
# to patch FreePBX queue module so it ads the following to the dialplan
# just before calling Queue ( in the queue module ):
#
# exten => XXX,n,Set(MONITOR_EXEC=${MIXMON_POST} queue)
#

use DBI;
my %config;
my $dbh;
use File::Basename;

# Destination Directory for recordings
$config{'destDir'} = "/var/spool/asterisk/monitor/";

# This is needed for Asternic queue recordings
$config{'lame'}     = '/usr/local/bin/lame';
$config{'asternicRecordingTable'}     = 'qstats.recordings';

# Read FreePBX configuration
open( CONFIG, "</etc/amportal.conf" ) or die("Could not open /etc/amportal.conf. Aborting...");
while (<CONFIG>) {
    chomp;
    $_ =~ s/^\s+//g;
    $_ =~ s/([^#]*)[#](.*)/$1/g;
    $_ =~ s/\s+$//g;
    if ($_ ne "") {
        my($key,$val) = split(/\=/);
        $config{$key}=$val;
    }
}

$config{'cdrHost'} = defined($config{'CDRDBHOST'})?$config{'CDRDBHOST'}:$config{'AMPDBHOST'};
$config{'cdrDBName'} = defined($config{'CDRDBNAME'})?$config{'CDRDBNAME'}:'asteriskcdrdb';
$config{'cdrTableName'} = defined($config{'CDRDBTABLENAME'})?$config{'CDRDBTABLENAME'}:'cdr';
$config{'cdrUser'} = defined($config{'CDRDBUSER'})?$config{'CDRDBUSER'}:$config{'AMPDBUSER'};
$config{'cdrPass'} = defined($config{'CDRDBPASS'})?$config{'CDRDBPASS'}:$config{'AMPDBPASS'};

my $uniqueid           = $ARGV[0];
my $directorio_archivo = $ARGV[1];
my $type               = $ARGV[2];

my ($archivo, $directorio, $suffix) = fileparse($directorio_archivo);

sub connect_db() {
    my $return = 0;
    my %attr = (
        PrintError => 0,
        RaiseError => 0,
    );
    my $dsn = "DBI:mysql:database=$config{'cdrDBName'};host=$config{'cdrHost'}";
    $dbh->disconnect if $dbh;
    $dbh = DBI->connect( $dsn, $config{'cdrUser'}, $config{'cdrPass'}, \%attr ) or $return = 1;
    return $return;
}

$time = localtime(time);
($sec,$min,$hour,$mday,$mon,$year,$wday,$yday,$isdst)=localtime(time);
$newtime = sprintf ("%4d-%02d-%02d",$year+1900,$mon+1,$mday);

my $dest_dir_date = $config{'destDir'}."/".$newtime;

# Conecta a la base
&connect_db();

# Crea el directorio de destino
system("mkdir -p $dest_dir_date");

if ($type eq "queue") {

    my $archimp3 = $archivo.".mp3";
    my $dest_fin_mp3 = $config{'destDir'}."/".$newtime."/".$archimp3;
    my $dest_sql_mp3 = $newtime."/".$archimp3;

    my $query = "INSERT INTO ".$config{'asternicRecordingTable'}." VALUES('$uniqueid','$dest_sql_mp3')";
    $dbh->do($query);
    $dbh->disconnect if $dbh;

    system($config{'lame'}." --silent --resample 44.1 --tt $archivo --add-id3v2 $directorio_archivo $archimp3");
    system("cp $archimp3 $dest_fin_mp3");
    system("rm -f $archivo");
    system("rm -f $archimp3");

} else {

    my $dest_fin     = $config{'destDir'}."/".$newtime."/".$archivo;

    my $query = "UPDATE ".$config{'cdrDBName'}.".".$config{'cdrTableName'}." SET userfield = '$dest_fin' WHERE uniqueid='$uniqueid'";
    $dbh->do($query);
    $dbh->disconnect if $dbh;

    system("cp $directorio_archivo $dest_fin");
    system("rm -f $directorio_archivo");
}
