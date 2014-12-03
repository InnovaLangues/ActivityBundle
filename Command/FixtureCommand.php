<?php

namespace Innova\ActivityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Innova\ActivityBundle\Entity\ActivityTypeAvailable;

class FixtureCommand extends ContainerAwareCommand
{

    protected function configure()
    {
        $this
            ->setName('activity:fixtures:load')
            ->setDescription('Load needed datas')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
            $start = time();
            $em = $this->getContainer()->get('doctrine')->getEntityManager('default');

            /* TYPOLOGY */
            $activityTypeAvailables = array(
                array("A", "A1"), array("B", "B1"),
                array("C", "C1")
            );
            foreach ($activityTypeAvailables as $activityTypeAvailable) {
                $activityType = new ActivityTypeAvailable();
                $activityType->setName($activityTypeAvailable[0]);
                $activityType->setClass($activityTypeAvailable[1]);
                $em->persist($activityType);
                $output->writeln("Add new activityTypeAvailable (".$activityTypeAvailable[0]." : ".$activityTypeAvailable[1].").");
            }
            $em->flush();

            $now = time();
            $duration = $now - $start;

            $output->writeln("Fixtures exécutées en ". $duration." sec.");
    }
}
