<?php

namespace Innova\ActivityBundle\DataFixtures\Required;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Innova\ActivityBundle\Entity\ActivityTypeAvailable;

class LoadRequiredFixturesData extends AbstractFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        /**
         * array format:
         *   - name
         *   - class
         */
        $activityTypes = array (
            array (
                'name' => 'BooleanChoiceType', 'class' => 'BooleanChoiceType'
            ),
            array (
                'name' => 'MultipleChoiceType', 'class' => 'MultipleChoiceType'
            ),
            array (
                'name' => 'UniqueChoiceType', 'class' => 'UniqueChoiceType'
            ),
        );

        foreach ($activityTypes as $activityType) {
            $entity = new ActivityTypeAvailable();

            $entity->setName($activityType['name']);
            $entity->setClass($activityType['class']);

            $manager->persist($entity);
        }

        $manager->flush();
    }
}
