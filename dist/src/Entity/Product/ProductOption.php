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

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption\RenderedOptionInterface;
use MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption\RenderedOptionTrait;
use Sylius\Component\Product\Model\ProductOption as BaseProductOption;
use Sylius\Component\Product\Model\ProductOptionTranslationInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product_option")
 */
class ProductOption extends BaseProductOption implements RenderedOptionInterface
{
    use RenderedOptionTrait;

    protected function createTranslation(): ProductOptionTranslationInterface
    {
        return new ProductOptionTranslation();
    }
}
