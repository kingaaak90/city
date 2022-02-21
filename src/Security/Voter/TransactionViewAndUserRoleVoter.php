<?php

namespace App\Security\Voter;
use App\Entity\AbstractTransaction;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

use function PHPUnit\Framework\throwException;

class TransactionViewAndUserRoleVoter extends Voter
{
    const TRANSACTION_VIEW_AND_USER_ROLE = "TRANSACTION_VIEW_AND_USER_ROLE";

    protected function supports(string $attribute, $subject)
    {
        if(!in_array($attribute, [self::TRANSACTION_VIEW_AND_USER_ROLE]))
        {
            return false;
        }
        if(!$subject['transaction'] instanceof AbstractTransaction OR !is_array($subject['roles']))
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

        switch($attribute)
        {
            case self::TRANSACTION_VIEW_AND_USER_ROLE:
                return $this->youCanDoIt($authUser, $subject['roles'], $transaction);
        }
        throw new \LogicException('xD');

    }

    private function youCanDoIt(User $authUser, array $roles, AbstractTransaction $transaction)
    {

        $isOwner = $authUser === $transaction->getOwner();
        $hasRole = false;

        foreach ($authUser->getRoles() as $role)
        {
            if (in_array($role, $roles)){
                $hasRole = true;
            }

        }

        return $isOwner === true && $hasRole === true;
        
    }

}


//mój voter ma się odpalić w momencie kiedy mam rolę oraz dostęp do transakcji

//sprawdzić czy moja rola znajduje sie w podanych rolach
