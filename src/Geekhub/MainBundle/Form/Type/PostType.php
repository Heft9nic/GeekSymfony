<?php

namespace Geekhub\MainBundle\Form\Type;

use Doctrine\ORM\EntityRepository;
use Geekhub\MainBundle\Repository\TagRepository;
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
            ->add('tags', 'entity', array(
                    'label' => 'Tags',
                    'class' => 'GeekhubMainBundle:Tag',
                    'property' => 'tagName',
                    'empty_value' => 'Choose a tag',
                    'multiple' => true,
                    'expanded' => false,
                    'query_builder' => function (TagRepository $repository) {
                            return $repository->findEnabledTags();
                        }
                )
            );
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
