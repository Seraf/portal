<?php

namespace Enovance\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\EntityRepository;


class AdminGroupType extends AbstractType {

  protected $group, $isNew;

  public function __construct($group) {
    $this->group = $group;
    $this->isNew = $group->getId() ? FALSE : TRUE;
  }

  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add('name', 'text', array('label' => 'Name'));
    if ($this->isNew || $this->group->getRoles() != 'ROLE_ADMIN') {
      $builder->add('permissions', 'entity', array(
        'label' => 'Permissions',
        'class' => 'EnovanceUserBundle:Permission',
        'query_builder' => function(EntityRepository $er) {
          return $er->createQueryBuilder('p')
                  ->orderBy('p.weight', 'ASC');
        },
        'multiple' => TRUE,
        'expanded' => TRUE,
      ));
    }
  }

  public function setDefaultOptions(OptionsResolverInterface $resolver)
  {
      $resolver->setDefaults(array(
          'data_class' => 'Enovance\UserBundle\Entity\Group'
      ));
  }

  public function getName()
  {
      return 'enovance_userbundle_admingrouptype';
  }
}
