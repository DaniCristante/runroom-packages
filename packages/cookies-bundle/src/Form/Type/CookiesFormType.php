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

namespace Runroom\CookiesBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class CookiesFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('mandatoryCookies', CheckboxType::class, [
                'label' => 'cookies.mandatory_cookies.label',
                'mapped' => false,
                'required' => false,
                'disabled' => true,
                'data' => true,
            ])
            ->add('performanceCookies', CheckboxType::class, [
                'label' => 'cookies.performance_cookies.label',
                'mapped' => false,
                'required' => false,
                'data' => true,
            ])
            ->add('targetingCookies', CheckboxType::class, [
                'label' => 'cookies.targeting_cookies.label',
                'mapped' => false,
                'required' => false,
            ])
            ->add('send', SubmitType::class, [
                'label' => 'cookies.save_settings',
            ]);
    }
}