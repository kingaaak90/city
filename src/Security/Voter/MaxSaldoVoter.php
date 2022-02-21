<?php

namespace App\Security\Voter;
use App\Entity\AbstractTransaction;
use App\Entity\User;
use App\Repository\TransactionRepository;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;



class MaxSaldoVoter extends Voter
{
    const MAX_SALDO = "MAX_SALDO";

    protected function supports(string $attribute, $subject)
    {
        if(!in_array($attribute, [self::MAX_SALDO])) {

            return false;
        }
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $authUser = $token->getUser();

        if(!$authUser instanceof User)
        {
            return false;
        }

        $saldo = $subject;

        switch ($attribute) {
            case self::MAX_SALDO:
        return $this->canAddTransaction($saldo, $authUser);
        }
        throw new \LogicException('xD!');
    }

    private function canAddTransaction(TransactionRepository $saldo, User $authUser): bool
    {
        if($saldo->getTransactions($authUser) < 3000){
            return true;
        }
        return "Przekroczyłeś limit transakcji.";
    }
}