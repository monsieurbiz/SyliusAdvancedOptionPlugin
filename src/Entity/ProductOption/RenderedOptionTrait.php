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

namespace MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption;

use Doctrine\ORM\Mapping as ORM;

trait RenderedOptionTrait
{
    /**
     * @ORM\Column(name="renderer", type="string", nullable=true)
     *
     * @var string|null
     */
    protected ?string $renderer = null;

    /**
     * @return string|null
     */
    public function getRenderer(): ?string
    {
        return $this->renderer;
    }

    /**
     * @param string|null $renderer
     */
    public function setRenderer(?string $renderer): void
    {
        $this->renderer = $renderer;
    }
}
