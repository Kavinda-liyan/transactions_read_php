<?php
declare(strict_types=1);

//Read files form directory

function getTransactionFiles(string $dirPath): array
{
    $files = [];

    foreach (scandir($dirPath) as $file) {
        if (is_dir($file)) {
            continue; //Skipp the directory
        }
        $files[] = $dirPath . $file;
        
    }

    //now the this fucntion return file as Transaction.csv
    return $files;
}

function getTransactions(string $fileName): array
{
    if (!file_exists($fileName)) {
        trigger_error('File"' . $fileName . '" does not exist.', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');
    fgetcsv($file);

    $transactions = [];
    while (($transaction = fgetcsv($file)) !== false) {
        $transactions[] = $transaction;
    }

    return $transactions;

}