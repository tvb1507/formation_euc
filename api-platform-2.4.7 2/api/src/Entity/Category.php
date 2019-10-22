<?php

declare(strict_types=1);

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ApiResource(
 *     collectionOperations={
 *          "get" = {
 *              "normalization_context" = {
 *                  "groups" = {"Category/Collection/Read"}
 *              }
 *          },
 *          "post"
 *     },
 *     itemOperations={
 *          "get" = {
 *              "normalization_context" = {
 *                  "groups" = {"Category/Item/Read"}
 *              }
 *          },
 *          "put",
 *          "delete"
 *     }
 * )
 * @ORM\Entity
 */
class Category
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @Assert\Type(type="int")
     * @Groups({"Category/Item/Read", "Category/Collection/Read"})
     */
    public $id;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Length(min="2")
     * @Groups({"Category/Item/Read", "Category/Collection/Read"})
     */
    public $name;

    /**
     * @ORM\Column
     * @Assert\NotBlank
     * @Assert\Length(min="10")
     * @Groups({"Category/Item/Read"})
     */
    public $description;

    /**
     * @ORM\Column(type="boolean")
     * @Assert\Type(type="bool")
     * @Groups({"Category/Collection/Read"})
     */
    public $isActive = true;
}
