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

namespace MonsieurBiz\SyliusAdvancedOptionPlugin\Twig;

use MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption\RenderedOptionInterface;
use MonsieurBiz\SyliusAdvancedOptionPlugin\Source\RendererSourceInterface;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Symfony\Component\Form\FormView;
use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

final class AdvancedOptionExtension extends AbstractExtension
{
    private Environment $twigEnvironment;

    private RendererSourceInterface $rendererSource;

    /**
     * AdvancedOptionExtension constructor.
     */
    public function __construct(
        Environment $twigEnvironment,
        RendererSourceInterface $rendererSource
    ) {
        $this->twigEnvironment = $twigEnvironment;
        $this->rendererSource = $rendererSource;
    }

    /**
     * @return array|TwigFunction[]
     */
    public function getFunctions()
    {
        return [
            new TwigFunction('monsieurbiz_advancedoption_has_renderer', [$this, 'hasOptionRenderer']),
            new TwigFunction('monsieurbiz_advancedoption_form_row', [$this, 'renderFormRow'], [
                'is_safe' => ['html'],
                'needs_context' => true,
            ]),
        ];
    }

    private function getTemplate(?string $rendererCode): ?string
    {
        if (null === $rendererCode) {
            return null;
        }

        return $this->rendererSource->getRendererTemplate($rendererCode);
    }

    private function getOptionRenderer(ProductOptionInterface $option): ?string
    {
        if ($option instanceof RenderedOptionInterface && $option->getRenderer()) {
            return $option->getRenderer();
        }

        return null;
    }

    /**
     * @return bool
     */
    public function hasOptionRenderer(ProductOptionInterface $option)
    {
        return (bool) $this->getOptionRenderer($option);
    }

    /**
     * @throws LoaderError
     * @throws RuntimeError
     * @throws SyntaxError
     */
    public function renderFormRow(array $context, FormView $optionForm): string
    {
        $optionValue = $optionForm->vars['data'];
        $option = $optionValue->getOption();

        if ($this->hasOptionRenderer($option)) {
            $template = $this->getTemplate($this->getOptionRenderer($option));
            if (null !== $template) {
                return $this->twigEnvironment->render($template, [
                    'option_form' => $optionForm,
                    'option' => $option,
                ] + $context);
            }
        }

        return $this->renderDefaultFormRow($optionForm);
    }

    /**
     * @throws LoaderError
     * @throws SyntaxError
     */
    private function renderDefaultFormRow(FormView $optionForm): string
    {
        $formRowFunction = $this->twigEnvironment->getFunction('form_row');
        if (false !== $formRowFunction) {
            $formRow = $formRowFunction->getCallable();
            if (null !== $formRow) {
                return $this->twigEnvironment
                    ->createTemplate(
                        $formRow(
                            $optionForm,
                            [
                                'attr' => [
                                    'data-option' => $optionForm->vars['name'],
                                ],
                            ]
                        )
                    )
                    ->render([])
                ;
            }
        }

        return '';
    }
}
