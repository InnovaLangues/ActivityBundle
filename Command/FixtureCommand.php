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

            /* ActivityTypeAvailables */
            /* id-name-class */
            $activityTypeAvailables = array(
                array("BooleanChoiceType", "BooleanChoiceType"),
                array("MultipleChoiceType", "MultipleChoiceType"),
                array("UniqueChoiceType", "UniqueChoiceType")
            );
            foreach ($activityTypeAvailables as $activityTypeAvailable) {
                // TODO : remove activityTypeAvailable fixture
                // 1 : création de la fixture
                if (!$activityType = $em->getRepository('InnovaActivityBundle:ActivityTypeAvailable')->findOneByName($activityTypeAvailable[0])) {
                    $activityType = new ActivityTypeAvailable();
                    $activityType->setName($activityTypeAvailable[0]);
                    $activityType->setClass($activityTypeAvailable[1]);
                    $em->persist($activityType);
                    $output->writeln("Add new activityTypeAvailable (".$activityTypeAvailable[0]." : ".$activityTypeAvailable[1].").");
                }
                else
                // 2 : modification de la fixture
                {
                    if ($activityType->getClass() != $activityTypeAvailable[1]) {
                        $activityType->setClass($activityTypeAvailable[1]);
                        $em->persist($activityType);
                        $output->writeln("Edit ".$activityTypeAvailable[0]." description (".$activityTypeAvailable[1].").");
                    }
                }
            }
            $em->flush();

            $now = time();
            $duration = $now - $start;

            $output->writeln("Fixtures exécutées en ". $duration." sec.");
    }
}
