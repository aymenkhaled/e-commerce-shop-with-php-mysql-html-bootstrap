<?php
session_start();
$id = $_GET['id'];

$total_enlever = $_SESSION['panier'][3][$id][2];

$_SESSION['panier'][1] -= $total_enlever;

unset($_SESSION['panier'][3][$id]);

header('location:../panier.php');









?>