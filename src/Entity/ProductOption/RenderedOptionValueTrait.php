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

namespace MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\ImageInterface;
use Symfony\Component\Validator\Constraints as Assert;

trait RenderedOptionValueTrait
{
    /**
     * @ORM\OneToMany(
     *     targetEntity="MonsieurBiz\SyliusAdvancedOptionPlugin\Entity\ProductOption\ProductOptionValueImage",
     *     mappedBy="owner",
     *     cascade={"all"},
     *     orphanRemoval=true
     * )
     *
     * @Assert\Valid
     *
     * @var Collection|null
     */
    protected $images;

    public function __construct()
    {
        $this->images = new ArrayCollection();
    }

    public function getImages(): Collection
    {
        if (null === $this->images) {
            $this->images = new ArrayCollection();
        }

        return $this->images;
    }

    public function getImagesByType(string $type): Collection
    {
        return $this->images->filter(function (ImageInterface $image) use ($type): bool {
            return $type === $image->getType();
        });
    }

    public function hasImages(): bool
    {
        return !$this->images->isEmpty();
    }

    public function hasImage(ImageInterface $image): bool
    {
        return $this->images->contains($image);
    }

    public function addImage(ImageInterface $image): void
    {
        $image->setOwner($this);
        $this->images->add($image);
    }

    public function removeImage(ImageInterface $image): void
    {
        if ($this->hasImage($image)) {
            $image->setOwner(null);
            $this->images->removeElement($image);
        }
    }
}
