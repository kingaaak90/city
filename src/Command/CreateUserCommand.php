<?php

namespace App\Command;

use App\Entity\User;
use App\Facade\AuthFacade;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


class CreateUserCommand extends Command
{
    protected static $defaultName = 'app:create-user';

    public function __construct(
        AuthFacade $authFacade,
        private EntityManagerInterface $entityManager,
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {
        $this->authFacade = $authFacade;

        parent::__construct();
    }


    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::OPTIONAL , 'The email')
            ->addArgument('password', InputArgument::OPTIONAL, 'User password');
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int
    {
        $email = $input->getArgument('email');
        $password = $input->getArgument('password');

        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);

        $output->writeln('Email: '.$email);
        $output->writeln('Password: '.$password);

        $user = new User($input->getArgument('email'),['USER_ROLE']);

        $hashedPassword = $this->userPasswordHasher->hashPassword($user,$input->getArgument('password'));

        $user->setPassword($hashedPassword);

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return Command::SUCCESS;
    }
}