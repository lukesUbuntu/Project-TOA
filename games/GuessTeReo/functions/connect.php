<!--Can only connect database if in dev or prod environment-->
<?php
$dbConnect = array(
    'server' => '127.0.0.1',
    'user' => 'guessTeReo',
    'pass' => 'myadmin123',
    'name' => 'guessTeReo'
);
$db = new mysqli(
    $dbConnect['server'],
    $dbConnect['user'],
    $dbConnect['pass'],
    $dbConnect['name']
);
if ($db->connect_errno > 0) {
    echo "DATABASE CONNECTION ERROR " . $db->connect_error;
    exit;
}
?>

<!-- Can connect to local host only, this will only be used for testing purposes -->
<?php/*
    $dbConnect = array(
        'server' => 'localhost',
        'user' => 'root',
        'pass' => '',
        'name' => 'users'
    );
    $db = new mysqli(
        $dbConnect['server'],
        $dbConnect['user'],
        $dbConnect['pass'],
        $dbConnect['name']
    );
    if ($db->connect_error>0) {
        echo "DATABASE CONNECTION ERROR " . $db->connect_error;
        exit;
    }*/
?>
