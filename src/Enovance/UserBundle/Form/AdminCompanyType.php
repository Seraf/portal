<?php

namespace Enovance\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;


class AdminCompanyType extends AbstractType {

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name', 'text', array('label' => 'Name'));
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => 'Enovance\UserBundle\Entity\Company'
      ));
  }

  public function getName()
  {
      return 'enovance_userbundle_admincompanytype';
  }
}
