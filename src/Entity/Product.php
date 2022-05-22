<?php

namespace App\Entity;

use App\Repository\ProductRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProductRepository::class)]
class Product
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $model;

    #[ORM\Column(type: 'integer')]
    private $price;

    #[ORM\Column(type: 'string', length: 255)]
    private $manufacturer;

    #[ORM\Column(type: 'string', length: 255)]
    private $image;

    #[ORM\ManyToOne(targetEntity: Category::class, inversedBy: 'products')]
    #[ORM\JoinColumn(nullable: false)]
    private $category;

    #[ORM\Column(type: 'string', length: 255)]
    private $chipset;

    #[ORM\OneToMany(mappedBy: 'product', targetEntity: ContentListProduct::class, orphanRemoval: true)]
    private $contentListProducts;

    public function __construct()
    {
        $this->contentListProducts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getModel(): ?string
    {
        return $this->model;
    }

    public function setModel(string $model): self
    {
        $this->model = $model;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getChipset(): ?string
    {
        return $this->chipset;
    }

    public function setChipset(string $chipset): self
    {
        $this->chipset = $chipset;

        return $this;
    }

    /**
     * @return Collection<int, ContentListProduct>
     */
    public function getContentListProducts(): Collection
    {
        return $this->contentListProducts;
    }

    public function addContentListProduct(ContentListProduct $contentListProduct): self
    {
        if (!$this->contentListProducts->contains($contentListProduct)) {
            $this->contentListProducts[] = $contentListProduct;
            $contentListProduct->setProduct($this);
        }

        return $this;
    }

    public function removeContentListProduct(ContentListProduct $contentListProduct): self
    {
        if ($this->contentListProducts->removeElement($contentListProduct)) {
            // set the owning side to null (unless already changed)
            if ($contentListProduct->getProduct() === $this) {
                $contentListProduct->setProduct(null);
            }
        }

        return $this;
    }
}
