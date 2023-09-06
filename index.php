<?php
require_once 'User.php';

$host = 'localhost';
$dbname = 'user_management';
$username = 'root';
$password = 'root';

$db = new PDO("pgsql:host=$host;dbname=$dbname", $username, $password);

$user = new User($db);

$user->register('john_doe', 'password123', 'john@example.com');

$loggedInUser = $user->login('john_doe', 'password123');

if ($loggedInUser) {
    echo 'Logged in as: ' . $loggedInUser['username'];
} else {
    echo 'Invalid username or password';
}
?>
