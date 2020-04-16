<?php

namespace App\Command;

use App\Controller\HomeController;
use App\Repository\WebsiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CheckStatusCommand extends Command
{
    protected static $defaultName = 'check:status';

    public function __construct(HomeController $controller, WebsiteRepository $websiteRepo, EntityManagerInterface $manager){
        parent::__construct();
        $this->controller = $controller;
        $this->websiteRepo = $websiteRepo;
        $this->manager = $manager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Add a short description for your command')
            ->addArgument('arg1', InputArgument::OPTIONAL, 'Argument description')
            ->addOption('option1', null, InputOption::VALUE_NONE, 'Option description')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $arg1 = $input->getArgument('arg1');

        if ($arg1) {
            $io->note(sprintf('You passed an argument: %s', $arg1));
        }

        if ($input->getOption('option1')) {
            // ...
        }

        $this->controller->analyse($this->websiteRepo,  $this->manager);

        $io->success('This command is used to retrieve the current status of websites stocked in the database ! Pass --help to see your options.');

        return 0;
    }
}
