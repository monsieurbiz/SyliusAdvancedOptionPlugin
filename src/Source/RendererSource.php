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

namespace MonsieurBiz\SyliusAdvancedOptionPlugin\Source;

final class RendererSource implements RendererSourceInterface
{
    private array $renderers;

    /**
     * RendererSource constructor.
     */
    public function __construct(array $renderers)
    {
        $this->renderers = $renderers;
    }

    /**
     * @inheritdoc
     */
    public function getChoices(): array
    {
        $choices = [];
        foreach ($this->renderers as $code => $renderer) {
            $choices[$renderer['label']] = $code;
        }

        return $choices;
    }

    public function getRendererTemplate(string $rendererCode): ?string
    {
        if (!\array_key_exists($rendererCode, $this->renderers)) {
            return null;
        }

        return $this->renderers[$rendererCode]['template'];
    }
}
