<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get" = {
 *              "normalization_context" = {
 *                  "groups" = {"Product/Collection/Read"}
 *              }
 *          },
 *          "Custom" = {"method"="GET", "path"="Mon/Chemin"}
 *     },
 *     itemOperations={
 *          "get"
 *     }
 * )
 * @ORM\Entity
 */
class Product
{
    /**
     * @var int Unique identifier of a product.
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Groups({"Product/Collection/Read"})
     */
    public $id;

    /**
     * @var string Product name.
     * @ORM\Column
     * @Assert\NotBlank()
     * @Assert\Length(min="2")
     * @Groups({"Product/Collection/Read"})
     */
    public $name;

    /**
     * @var int Product price.
     * @ORM\Column(type="integer")
     * @Assert\NotBlank()
     * @Assert\Type(type="int")
     * @Assert\GreaterThan(0)
     */
    public $price;

    /**
     * @var Collection Product category.
     * @ORM\ManyToMany(targetEntity=Category::class, inversedBy="products")
     */
    public $categories;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function addCategory(Category $category): void
    {
        if (!$this->categories->contains($category)) {
            $this->categories->add($category);
            $category->addProduct($this);
        }
    }

    public function removeCategory(Category $category): void
    {
        if ($this->categories->contains($category)) {
            $category->removeProduct($this);
            $this->categories->removeElement($category);
        }
    }
}
