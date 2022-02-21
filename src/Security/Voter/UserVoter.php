<?php

namespace App\Security\Voter;

use App\Repository\UserRepository;
use App\Entity\AbstractTransaction;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use App\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;

use function PHPUnit\Framework\throwException;

class UserVoter extends Voter
{
    const USER_VIEW = 'USER_VIEW';
    const USER_EDIT = 'USER_EDIT';
    // czy votttter ...
    protected function supports(string $attribute, $subject)
    {
       if (!in_array($attribute, [self::USER_VIEW, self::USER_EDIT]))
       {
           return false;
       }

       if(!$subject['user'] instanceof User)
       {
           throw new \Exception('xxx');
       }

       return true;
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
       $authUser = $token->getUser();

       if(!$authUser instanceof User)
       {
           return false;
       }

       $user = $subject;

       switch ($attribute)
       {
           case self::USER_VIEW:
           case self::USER_EDIT:
               return $this->can($user, $authUser);
       }

        throw new \LogicException('xD');
    }

    private function can(User $user, User $authUser): bool
    {
        return $user === $authUser;
    }

}