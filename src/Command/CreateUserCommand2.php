<?php

namespace App\Command;

use App\Entity\User;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputOption;

class CreateUserCommand2 extends Command
{
    protected static $defaultName = 'app:test';

    protected function configure(): void
    {
        $this
            ->addArgument('name', InputArgument::REQUIRED, 'Podaj imię')
            ->addArgument('age', InputArgument::REQUIRED, 'Podaj swój wiek')
            ->addOption(
                'x',
                null,
                InputOption::VALUE_REQUIRED,
                'Przez ile podzielić Twój wiek?',
                1
            )
        ;
    }

    protected function execute(
        InputInterface $input,
        OutputInterface $output
    ): int
    {
        $name = $input->getArgument('name');
        $age = $input->getArgument('age');

        $output->writeln([
            'User Creator',
            '============',
            '',
        ]);


        $output->writeln('Name: '.$name);
        $output->writeln('Age: '.$age);

        $result = $age / $input->getOption('x');

        $output->writeln($result);

        return Command::SUCCESS;
    }
}