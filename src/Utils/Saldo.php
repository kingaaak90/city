<?php

namespace App\Utils;

use App\Repository\IRepository;
use App\Repository\ExpensesRepository;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;



class Saldo
{
    private $iRepository;
    private $expensesRepository;


    public function __construct(
        IRepository $iRepository,
        ExpensesRepository $expensesRepository,

    ) {
        $this->iRepository = $iRepository;
        $this->expensesRepository = $expensesRepository;

    }

    public function calculateSaldo(User $user) {

        $myIncome = $this->iRepository->getSumOfIncomes($user);
        $myExpenses = $this->expensesRepository->getSumOfExpenses($user);

        $saldo = $myIncome - $myExpenses;
        return $saldo;

    }

}