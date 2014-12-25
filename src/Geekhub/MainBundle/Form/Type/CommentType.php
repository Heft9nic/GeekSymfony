<?php

namespace Geekhub\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommentType extends AbstractType
{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', ['label' => 'Title'])
        ->add('content', 'textarea', ['label' => 'Content']);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Geekhub\MainBundle\Entity\Comment',
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'comment';
    }
}
