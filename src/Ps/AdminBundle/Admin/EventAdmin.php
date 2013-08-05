<?php
/**
 * User: nikk
 * Date: 7/30/13
 * Time: 6:13 PM
 */

namespace Ps\AdminBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class EventAdmin extends Admin
{
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('organizer')
            ->add('dateStart')
            ->add('dateEnd')
            ->add('place')
            ->add('privacy')
            ->add('sport')
        ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('organizer')
            ->add('dateStart', 'datetime')
            ->add('dateEnd', 'datetime')
            ->add('place')
            ->add('privacy')
            ->add('sport')
            ->end()
        ;
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->addIdentifier('organizer')
            ->addIdentifier('dateStart', 'datetime')
            ->addIdentifier('dateEnd', 'datetime')
            ->addIdentifier('place')
            ->addIdentifier('privacy')
            ->addIdentifier('sport')
        ;
    }

    public function getBatchActions()
    {
        return [];
    }
}