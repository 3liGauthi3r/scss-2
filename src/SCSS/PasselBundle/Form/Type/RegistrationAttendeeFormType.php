<?php

namespace SCSS\PasselBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface,
    FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationAttendeeFormType extends BaseType
{
    public function buildForm( FormBuilderInterface $builder, array $options )
    {
        parent::buildForm( $builder, $options );

        // add your custom field
        $builder->add('passel',
                      'entity',
                      array(
                        'property'  =>  'name',
                        'class'     => 'SCSS\PasselBundle\Entity\Passel'
        ) );
        $builder->add('faction',
                      'entity',
                      array(
                        'property'  =>  'name',
                        'class'     => 'SCSS\PasselBundle\Entity\Faction'
        ) );
    }

    public function getName()
    {
        return 'SCSS_attendee_registration';
    }
}
