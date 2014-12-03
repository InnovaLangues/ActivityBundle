<?php

namespace Innova\ActivityBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

use Innova\SelfBundle\Entity\ActivityTypeAvailable;

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
            $typologies = array(
                array("TVF", "Vrai-Faux"), array("TQRU", "Question à Réponse Unique"),
                array("TQRM", "Question à Réponses Multiples"), array("TLCMLDM", "Liste de mots"),
                array("APP", "Appariemment"), array("TVFNM", "Vrai-Faux-Non Mentionné"),
                array("TLCMLMULT", "Listes de choix multiple"), array("TLQROC", "Question Réponse Ouverte Courte")
            );
/*
            foreach ($typologies as $typology) {

                if (!$typo = $em->getRepository('InnovaSelfBundle:Typology')->findOneByName($typology[0])) {
                    $typo = new Typology();
                    $typo->setName($typology[0]);
                    $typo->setDescription($typology[1]);
                    $em->persist($typo);
                    $output->writeln("Add new Typology (".$typology[0]." : ".$typology[1].").");
                } else {
                    if ($typo->getDescription() != $typology[1]) {
                        $typo->setDescription($typology[1]);
                        $em->persist($typo);
                        $output->writeln("Edit ".$typology[0]." description (".$typology[1].").");
                    }
                }
            }
            $em->flush();
 */
            $now = time();
            $duration = $now - $start;

            $output->writeln("Fixtures exécutées en ".$duration." sec.");
    }
}
