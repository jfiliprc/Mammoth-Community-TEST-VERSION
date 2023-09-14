<?php
//DB Params
try {
    $pdo = new PDO("mysql:host=localhost;dbname=forum", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
//Paths
define("SITE_TITLE", "database");

// Define BASE_URL dynamically
define("BASE_URL", "http://" . $_SERVER["HTTP_HOST"] . "/forum/");