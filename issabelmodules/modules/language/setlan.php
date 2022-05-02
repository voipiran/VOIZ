<?php
	
	$dbfile="/var/www/db/settings.db";
	$t="False";
	if (isset($_POST['setlan'])){
		if (!empty($_POST['setlan'])){
			
			$db = new SQLite3($dbfile);
			if ($_POST['setlan']=='fa'){
				//echo "<script type='text/javascript'>alert('fa');</script>";				
				$sqlstr = "Update settings set value = 'vitenant' where key = 'theme'";
				$results = $db->query($sqlstr);
				$sqlstr = "Update settings set value = 'fa' where key = 'language'";
				$results = $db->query($sqlstr);
				$t="True";
			}
			if ($_POST['setlan']=='en'){
				//echo "<script type='text/javascript'>alert('en');</script>";
				$sqlstr = "Update settings set value = 'tenant' where key = 'theme'";
				$results = $db->query($sqlstr);
				$sqlstr = "Update settings set value = 'en' where key = 'language'";
				$results = $db->query($sqlstr);
				$t="True";
			}
			//Header('Location: ?menu='.$module_name);
		}
	}
	echo $t;
?>