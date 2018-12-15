<?php
include_once '../includes/session.php';

session_destroy();

session_start();
$_SESSION['success_messages'][] = "Logged out successfully!";

header('Location: ../pages/login.php');
