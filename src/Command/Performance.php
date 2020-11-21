<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;


class Performance extends Command
{
    protected static $defaultName = 'app:Performance:sas';

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        parent::__construct();
    }

    protected function configure()
    {
        $this
            ->setDescription("Writing data to the sheet");

    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $sm = new SymfonyStyle($input, $output);

        do{
            $selectionMenu = $sm->choice('what you need?',
                [
                    'z' => 'saving data from a file to a record database',
                    'x' => 'next step',
                ]
            );

            switch ($selectionMenu){
                case 'z':
                    $sm->title('saving data from a file to a record database');
                    try {
                        echo 'starting the method';

                    } catch (Exception $e) {
                        $message = $e->getCode() . ' - ' . $e->getMessage();
                    }
                    dump($message);
                    break;
                case 'x':
                    break;
            }

        } while($sm->confirm('Do you need anything more?', false));


    }
}