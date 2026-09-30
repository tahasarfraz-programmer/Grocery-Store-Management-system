<?php
session_start();
const APP = 'Grocery Store Management system';
$pdo = new PDO('mysql:host=localhost;dbname=grocery_db;charset=utf8mb4', 'root', '', [
  PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]);
function e($s){ return htmlspecialchars((string)$s, ENT_QUOTES); }
function auth(){ if (empty($_SESSION['u'])) { header('Location: login.php'); exit; } }
