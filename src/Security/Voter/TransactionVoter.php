<?php

namespace App\Security\Voter;

use App\Entity\AbstractTransaction;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class TransactionVoter extends Voter
{
    const TRANSACTION_VIEW = "TRANSACTION_VIEW";
    const TRANSACTION_EDIT = "TRANSACTION_EDIT";

    protected function supports(string $attribute, $subject)
    {
        if (!in_array($attribute, [self::TRANSACTION_VIEW, self::TRANSACTION_EDIT]))
        {
            return false;
        }

        if(!$subject['transaction'] instanceof AbstractTransaction)
        {
            throw new \LogicException('Ups!');
        }

        return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token)
    {
        $authUser = $token->getUser();

        if(!$authUser instanceof User)
        {
            return false;
        }

        $transaction = $subject['transaction'];

        switch ($attribute)
        {
            case self::TRANSACTION_VIEW:
            case self::TRANSACTION_EDIT:
                return $this->youCanDoIt($transaction, $authUser);
        }

        throw new \LogicException('xD!');
    }

    private function youCanDoIt(AbstractTransaction $transaction, User $authUser): bool
    {
        return $authUser === $transaction->getOwner();
    }


}