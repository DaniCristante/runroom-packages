<?php

declare(strict_types=1);

/*
 * This file is part of the Runroom package.
 *
 * (c) Runroom <runroom@runroom.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Runroom\BasicPageBundle\Admin;

use A2lix\TranslationFormBundle\Form\Type\TranslationsType;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use Runroom\BasicPageBundle\Entity\BasicPage;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Form\Type\AdminType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Validator\Constraints as Assert;

final class BasicPageAdmin extends AbstractAdmin
{
    protected function configureDatagridFilters(DatagridMapper $datagridMapper): void
    {
        $datagridMapper
            ->add('translations.title', null, [
                'label' => 'Title',
            ])
            ->add('publish');
    }

    protected function configureListFields(ListMapper $listMapper): void
    {
        $listMapper
            ->addIdentifier('title', null, [
                'sortable' => true,
                'sort_field_mapping' => [
                    'fieldName' => 'title',
                ],
                'sort_parent_association_mappings' => [[
                    'fieldName' => 'translations',
                ]],
            ])
            ->add('location', 'choice', [
                'editable' => true,
                'choices' => [
                    BasicPage::LOCATION_NONE => 'None',
                    BasicPage::LOCATION_FOOTER => 'Footer',
                ],
            ])
            ->add('publish', 'boolean', [
                'editable' => true,
            ])
            ->add('_action', null, [
                'actions' => [
                    'open' => [
                        'template' => '@RunroomBasicPage/open.html.twig',
                    ],
                    'delete' => [],
                ],
            ]);
    }

    protected function configureFormFields(FormMapper $formMapper): void
    {
        $formMapper
            ->with('Basic', [
                'box_class' => 'box box-solid box-primary',
            ])
                ->add('translations', TranslationsType::class, [
                    'label' => false,
                    'fields' => [
                        'title' => [],
                        'content' => [
                            'field_type' => CKEditorType::class,
                        ],
                        'slug' => [
                            'display' => false,
                        ],
                    ],
                    'constraints' => [
                        new Assert\Valid(),
                    ],
                ])
            ->end()
            ->with('Published', [
                'box_class' => 'box box-solid box-primary',
            ])
                ->add('publish')
                ->add('location', ChoiceType::class, [
                    'choices' => [
                        'None' => BasicPage::LOCATION_NONE,
                        'Footer' => BasicPage::LOCATION_FOOTER,
                    ],
                ])
            ->end()
            ->with('SEO', [
                'box_class' => 'box box-solid box-primary',
            ])
                ->add('metaInformation', AdminType::class, [], [
                    'edit' => 'inline',
                ])
            ->end();
    }
}
