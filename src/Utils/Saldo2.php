<?php

namespace App\Utils;

use App\Entity\AbstractTransaction;
use App\Entity\User;
use App\Repository\TransactionRepository;

class Saldo2
{
    private $transactionRepository;

    public function __construct(TransactionRepository $transactionRepository) {
        $this->transactionRepository = $transactionRepository;
    }

    public function getBilans(User $owner)
    {
        $bilans = 0;

        $transactions = $this->transactionRepository->getTransactions($owner);

        foreach ($transactions as $transaction) {
            $bilans += $transaction->getAmount();

        }
        return $bilans;

    }

}