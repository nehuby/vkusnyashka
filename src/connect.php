<?
try {
    $connect = new PDO('mysql:host=mysql;dbname=nehuby', 'root', '');
} catch (PDOException $e) {
    print "Error!: " . $e->getMessage();
    die();
}
