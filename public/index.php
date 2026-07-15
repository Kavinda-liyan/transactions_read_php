<?php
declare(strict_types=1);

//Define root directory to easy use without typing multiple places
#DIRECTORY_SEPARATOR is a predefined PHP constant that represents the directory separator used by the operating system.
$root = dirname(__DIR__) . DIRECTORY_SEPARATOR;


//Defining all app, transaction_fils and views as CONSTRAINTS 
#\Learn_PHP_TUT_PROJECT\app\
define('APP_PATH', $root . 'app' . DIRECTORY_SEPARATOR);
#\Learn_PHP_TUT_PROJECT\transaction_files\
define('FILES_PATH', $root . 'transaction_files' . DIRECTORY_SEPARATOR);
##\Learn_PHP_TUT_PROJECT\views\
define('VIEWS_PATH', $root . 'views' . DIRECTORY_SEPARATOR);

//get app.php using require
require APP_PATH . "app.php";

//calling Business fuc:getTransaction file Transactions.csv 
$files = getTransactionFiles(FILES_PATH);

$transactions = [];
foreach ($files as $file) {
    $transactions = array_merge($transactions, getTransactions($file));

}
//getting View 
require VIEWS_PATH . 'transactions.php';


