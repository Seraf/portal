<?php

namespace Enovance\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AdminUserType extends AbstractType
{
    protected $user, $isNew;

    public function __construct($user) {
        $this->user = $user;
        $this->isNew = $user->getId() ? FALSE : TRUE;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $passwordLabel = $this->isNew ? 'Password' : 'New password';
        $builder
            ->add('username')
            ->add('firstname')
            ->add('lastname')
            ->add('email')
            ->add('password', 'repeated', array(
                  'first_options'  => array('label' => $passwordLabel,'required' => $this->isNew),
                  'second_options' => array('label' => 'Repeat Password','required' => $this->isNew)))
            ->add('file', 'file', array('label' => 'Avatar', 'required' => FALSE))
        ;
        if (!$this->isNew) {
            $builder->add('enabled', 'checkbox', array('label' => 'Enabled', 'required' => FALSE));
        }
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Enovance\UserBundle\Entity\User'
        ));
    }

    public function getName()
    {
        return 'enovance_userbundle_adminusertype';
    }
}
