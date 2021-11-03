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

use MonsieurBiz\SyliusAdvancedOptionPlugin\Source\RendererSourceInterface;
use Sylius\Bundle\ProductBundle\Form\Type\ProductOptionType;
use Symfony\Component\Form\AbstractTypeExtension;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

final class ProductOptionTypeExtension extends AbstractTypeExtension
{
    private RendererSourceInterface $rendererSource;

    /**
     * ProductOptionTypeExtension constructor.
     */
    public function __construct(RendererSourceInterface $rendererSource)
    {
        $this->rendererSource = $rendererSource;
    }

    /**
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->add('renderer', ChoiceType::class, [
            'label' => 'monsieurbiz_advanced_option.ui.renderer',
            'required' => false,
            'choices' => $this->rendererSource->getChoices(),
        ]);
    }

    public static function getExtendedTypes(): array
    {
        return [ProductOptionType::class];
    }
}
