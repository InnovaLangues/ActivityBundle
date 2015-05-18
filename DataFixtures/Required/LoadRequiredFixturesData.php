<?php

namespace Innova\ActivityBundle\DataFixtures\Required;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use Innova\ActivityBundle\Entity\ActivityAvailable\CategoryAvailable;
use Innova\ActivityBundle\Entity\ActivityAvailable\TypeAvailable;
use Innova\ActivityBundle\Entity\ActivityProperty\MediaTypeProperty;

class LoadRequiredFixturesData extends AbstractFixture
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $availableCategories = array (
            // Choice Type category
            array (
                'name' => 'ChoiceType',
                'icon' => 'fa fa-fw fa-check-square-o',
                'types' => array (
                    array (
                        'name' => 'BooleanChoiceType', 'class' => 'Choice\\BooleanChoiceType', 'form' => 'innova_activity_type_boolean',
                    ),
                    array (
                        'name' => 'UniqueChoiceType', 'class' => 'Choice\\UniqueChoiceType', 'form' => 'innova_activity_type_unique',
                    ),
                    array (
                        'name' => 'MultipleChoiceType', 'class' => 'Choice\\MultipleChoiceType', 'form' => 'innova_activity_type_multiple',
                    ),
                ),
            )
        );

        foreach ($availableCategories as $category) {
            $entityCategory = new CategoryAvailable();

            $entityCategory->setName($category['name']);

            if (!empty($category['icon'])) {
                $entityCategory->setIcon($category['icon']);
            }

            if (!empty($category['types'])) {
                foreach ($category['types'] as $type) {
                    $entityType = new TypeAvailable();

                    $entityType->setName($type['name']);
                    $entityType->setClass($type['class']);
                    $entityType->setForm($type['form']);

                    $entityCategory->addType($entityType);
                }
            }

            $manager->persist($entityCategory);
        }

        $manager->flush();
        
        $availableMediaTypes = array (
            // Choice Type category
            array (
                'name' => 'Text',
                'description' => 'Raw text',
                'template' => 'text-choice-form.html',
            ),
            array (
                'name' => 'Prosodic',
                'description' => 'Text containing prosodic annotations',
                'template' => 'prosodic-choice-form.html',
            ),
            array (
                'name' => 'Picture',
                'description' => 'Image file',
                'template' => 'image-choice-form.html',
            ),
            array (
                'name' => 'Video',
                'description' => 'Video file',
                'template' => 'video-choice-form.html',
            ),
            array (
                'name' => 'Sound',
                'description' => 'Sound file',
                'template' => 'sound-choice-form.html',
            ),
            array (
                'name' => 'Segment',
                'description' => 'Segment from media resource',
                'template' => 'segment-choice-form.html',
            ),
        );

        foreach ($availableMediaTypes as $mediaType) {
            $entityMediaType = new MediaTypeProperty();

            $entityMediaType->setName($mediaType['name']);

            if (!empty($mediaType['description'])) {
                $entityMediaType->setDescription($mediaType['description']);
            }

            if (!empty($mediaType['template'])) {
                $entityMediaType->setTemplate($mediaType['template']);
            }

            $manager->persist($entityMediaType);
        }

        $manager->flush();
    }
}
