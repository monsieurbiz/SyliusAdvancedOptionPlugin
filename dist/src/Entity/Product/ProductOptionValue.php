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

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption\RenderedOptionValueInterface;
use MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption\RenderedOptionValueTrait;
use Sylius\Component\Product\Model\ProductOptionValue as BaseProductOptionValue;
use Sylius\Component\Product\Model\ProductOptionValueTranslationInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product_option_value")
 */
class ProductOptionValue extends BaseProductOptionValue implements RenderedOptionValueInterface
{
    use RenderedOptionValueTrait {
        __construct as private initializeImagesCollection;
    }

    public function __construct()
    {
        $this->initializeImagesCollection();
        parent::__construct();
    }

    protected function createTranslation(): ProductOptionValueTranslationInterface
    {
        return new ProductOptionValueTranslation();
    }
}
