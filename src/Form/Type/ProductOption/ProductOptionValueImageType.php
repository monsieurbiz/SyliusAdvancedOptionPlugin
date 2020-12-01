<?php

/*
 * This file is part of Monsieur Biz' Advanced Option plugin for Sylius.
 *
 * (c) Monsieur Biz <sylius@monsieurbiz.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace MonsieurBiz\SyliusAdvancedOptionPlugin\Form\Type\ProductOption;

use Sylius\Bundle\CoreBundle\Form\Type\ImageType;

final class ProductOptionValueImageType extends ImageType
{
    public function getBlockPrefix(): string
    {
        return 'monsieurbiz_advancedoption_product_option_value_image';
    }
}
