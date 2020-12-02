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

namespace MonsieurBiz\SyliusAdvancedOptionPlugin\EventListener;

use MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption\RenderedOptionValueInterface;
use Sylius\Component\Core\Uploader\ImageUploaderInterface;
use Sylius\Component\Product\Model\ProductOptionInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Webmozart\Assert\Assert;

final class ImagesUploadListener
{
    private ImageUploaderInterface $uploader;

    public function __construct(ImageUploaderInterface $uploader)
    {
        $this->uploader = $uploader;
    }

    public function uploadImages(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, ProductOptionInterface::class);

        $this->processProductOption($subject);
    }

    private function processProductOption(ProductOptionInterface $subject): void
    {
        foreach ($subject->getValues() as $value) {
            Assert::isInstanceOf($value, RenderedOptionValueInterface::class);
            $this->uploadSubjectImages($value);
        }
    }

    private function uploadSubjectImages(RenderedOptionValueInterface $subject): void
    {
        $images = $subject->getImages();
        foreach ($images as $image) {
            if ($image->hasFile()) {
                $this->uploader->upload($image);
            }

            $image->setOwner($subject);

            // Upload failed? Let's remove that image.
            if (null === $image->getPath()) {
                $images->removeElement($image);
            }
        }
    }
}
