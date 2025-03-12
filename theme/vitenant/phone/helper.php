<?php
error_reporting(E_ALL); 

function parseAmportalConf() {
    $filePath = '/etc/amportal.conf';
    $settings = [];
    if (file_exists($filePath) && is_readable($filePath)) {
        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        foreach ($lines as $line) {
            $line = trim($line);
            if (strpos($line, '#') === 0) {
                continue; // skip comment lines
            }
            // Remove inline comments
            $line = preg_replace('/\s+#.*/', '', $line);
            if (strpos($line, '=') !== false) {
                list($key, $value) = explode('=', $line, 2);
                $settings[trim($key)] = trim($value);
            }
        }
    }
    else{
        echo "file not found";
    }
    
    return $settings;
}

function amportalSettings($setting) {
    $settings = parseAmportalConf();
    if (isset($settings[$setting])) {
        echo $setting. ":" . $amportalSettings[$setting] . "\n";
        return $settings[$setting];
    }
    else
        return null;
}

function sqliteExtensionFind($userName) {
    try {
        // SQL query to fetch a single data item
        $query = "SELECT extension FROM acl_user WHERE name = '$userName' LIMIT 1";

        // Database file path
        $dbFilePath = '/var/www/db/acl.db';

        // Establish connection to SQLite database using PDO
        $db = new PDO('sqlite:' . $dbFilePath);

        // Set error mode to exception for better error handling
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Execute the query
        $result = $db->query($query);

        // Fetch the result as an associative array
        if ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            // Get the value of the first column
            $data = reset($row);
            return $data; // Return the fetched data
        } else {
            return null; // Return null if no data is found
        }

        // Close the database connection
        $db = null;
    } catch (PDOException $e) {
        // Return error message if an exception occurs
        return "Error: " . $e->getMessage();
    }
}

function getAsteriskExtensionPassword($extension) {
    // Veritabanı bağlantı bilgileri
    
    $settings = parseAmportalConf();
    
    $asterisk_host = $settings["AMPDBHOST"];
    $asterisk_user = $settings["AMPDBUSER"];
    $asterisk_password = $settings["AMPDBPASS"];
    $asterisk_db = $settings["AMPDBNAME"];
    

    try {
        // MySQL bağlantısı oluştur
        $conn = new PDO("mysql:host=$asterisk_host;dbname=$asterisk_db", $asterisk_user, $asterisk_password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // SQL sorgusu
        $stmt = $conn->prepare("SELECT data FROM sip WHERE id = :extension AND keyword = 'secret';");
        $stmt->bindParam(':extension', $extension);
        $stmt->execute();

        // Sonucu al
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && isset($result['data'])) {
            return $result['data'];
        } else {
            return null; // Uzantı bulunamazsa null döndür
        }
    } catch (PDOException $e) {
        return "Hata: " . $e->getMessage();
    } finally {
        // Bağlantıyı kapat
        $conn = null;
    }
}