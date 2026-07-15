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


//geting each transaction 
function getTransactions(string $fileName): array
{
    if (!file_exists($fileName)) {
        trigger_error('File"' . $fileName . '" does not exist.', E_USER_ERROR);
    }

    $file = fopen($fileName, 'r');
    fgetcsv($file);

    $transactions = [];
    while (($transaction = fgetcsv($file)) !== false) {
        $transactions[] = readTransactions($transaction);
    }

    return $transactions;

}

//formatting date and amount
function readTransactions(array $transactionRow): array
{
    [$date, $checkNumber, $description, $amount] = $transactionRow;
    $amount = str_replace(['$', ','], '', $amount);

    return [
        'date' => $date,
        'checkNumber' => $checkNumber,
        'description' => $description,
        'amount' => $amount
    ];
}

//calculate Totals
function calculateTotals(array $transactions): array
{
    $totals = ['netTotal' => 0, 'totalIncome' => 0, 'totalExpense' => 0];

    foreach ($transactions as $transaction) {
        $totals['netTotal'] += $transaction['amount'];

        if ($transaction['amount'] >= 0) {
            $totals['totalIncome'] += $transaction['amount'];
        } else {
            $totals['totalExpense'] += $transaction['amount'];
        }
    }

    return $totals;
}