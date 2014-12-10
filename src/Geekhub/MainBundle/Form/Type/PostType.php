<?php

namespace Geekhub\MainBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PostType extends AbstractType
{

    /**
     * {@inheritDoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('title', 'text', ['label' => 'Title'])
        ->add('content', 'textarea', ['label' => 'Content'])
        ->add('tagList', 'choice', [
                'choices'=> ['News' => 'News', 'World of Tanks' => 'World of Tanks'],
                'label' => 'Tags',
                'multiple' => true,
                'expanded' => false,
            ])
        ->add('submit', 'submit', ['label' => 'Create']);
    }

    /**
     * {@inheritDoc}
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults([
            'data_class' => 'Geekhub\MainBundle\Entity\Post',
        ]);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'post';
    }
} 