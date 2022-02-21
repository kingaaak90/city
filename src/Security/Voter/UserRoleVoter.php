<?php

namespace App\Security\Voter;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;
use Symfony\Component\Security\Core\Security;

class UserRoleVoter extends Voter
{
    const USER_ROLE = 'USER_ROLE';
    const ADMIN_ROLE = 'ADMIN_ROLE';
    const ASYSTENT_ROLE = 'ASYSTENT_ROLE';

    protected function supports(string $attribute, $subject)
    {
       return $attribute === 'USER_ROLE';
    }

    protected function voteOnAttribute(string $attribute, $subject, TokenInterface $token): bool
    {
        $authUser = $token->getUser();

        if (!$authUser instanceof User)
        {
            return false;
        }

//        if($this->security->isGranted('USER_ROLE', $subject))
//        {
//            return true;
//        }

        switch ($attribute)
        {
            case self::ADMIN_ROLE:
            case self::ASYSTENT_ROLE:
            case self::USER_ROLE:
                return $this->youCan($authUser, $subject['roles']);
        }
        throw new \LogicException('xD');


    }

    private function youCan(User $authUser, array $roles): bool
    {

        foreach ($authUser->getRoles() as $role)
        {
            if (in_array($role, $roles)){
                return true;
            }
        }

        return false;

    }







}