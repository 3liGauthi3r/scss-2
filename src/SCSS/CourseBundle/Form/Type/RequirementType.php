<?php
namespace SCSS\CourseBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use SCSS\CourseBundle\Entity\Requirement;

class RequirementType extends AbstractType {
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder->add('name');
    $builder->add('optional');
    $builder->add('parent');
    $builder->add('text');
    $builder->add('meritbadge');

  }

  public function getName() {
    return 'requirement';
  }
}
