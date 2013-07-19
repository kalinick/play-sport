<?php
/**
 * User: nikk
 * Date: 7/16/13
 * Time: 12:02 PM
 */

namespace Ps\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        $builder
            ->add('firstName', null, ['label' => 'form.first_name', 'required' => false, 'translation_domain' => 'FOSUserBundle'])
            ->add('lastName', null, ['label' => 'form.last_name', 'required' => false, 'translation_domain' => 'FOSUserBundle'])
            ->add('phone', null, ['label' => 'form.phone', 'required' => false, 'translation_domain' => 'FOSUserBundle'])
            ->add('city', null, [
                'label' => 'form.city',
                'class' => 'PsAppBundle:City',
                'property' => 'title',
                'translation_domain' => 'FOSUserBundle'
            ])
        ;
    }

    public function getName()
    {
        return 'ps_user_registration';
    }
}