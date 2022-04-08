<?php

/*
 * This file is part of Monsieur Biz' Advanced Option plugin for Sylius.
 *
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE.txt
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusAdvancedOptionPlugin\Form\Extension;

use MonsieurBiz\SyliusAdvancedOptionPlugin\Form\Type\ProductOption\ProductOptionValueImageType;
use Sylius\Bundle\ProductBundle\Form\Type\ProductOptionValueType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductOptionValueTypeExtension extends AbstractTypeExtension
{
    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('images', CollectionType::class, [
                'label' => 'monsieurbiz_advanced_option.ui.images',
                'required' => false,
                'allow_add' => true,
                'allow_delete' => true,
                'block_name' => true,
                'by_reference' => false,
                'entry_type' => ProductOptionValueImageType::class,
            ])
        ;
    }

    public static function getExtendedTypes(): array
    {
        return [ProductOptionValueType::class];
    }
}
