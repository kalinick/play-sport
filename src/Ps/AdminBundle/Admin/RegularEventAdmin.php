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

class RegularEventAdmin extends Admin
{
    public function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('organizer')
            ->add('dayStart')
            ->add('timeStart')
            ->add('dayEnd')
            ->add('timeEnd')
            ->add('place')
        ;
    }

    public function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('organizer')
            ->add('dayStart')
            ->add('timeStart')
            ->add('dayEnd')
            ->add('timeEnd')
            ->end()
        ;
    }

    public function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->addIdentifier('organizer')
            ->addIdentifier('dayStart')
            ->addIdentifier('timeStart')
            ->addIdentifier('dayEnd')
            ->addIdentifier('timeEnd')
            ->addIdentifier('place')
        ;
    }

    public function getBatchActions()
    {
        return [];
    }
}