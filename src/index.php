<?php

function run(string $string): void
{
    $pdo = new PDO('mysql:host=mariadb;dbname=db;charset=utf8mb4', 'root', 'root');
    $stmt = $pdo->prepare("SELECT * FROM $string");
    $stmt->execute();
}

run('string');
