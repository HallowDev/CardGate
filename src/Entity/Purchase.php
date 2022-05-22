<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PurchaseRepository;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: PurchaseRepository::class)]
#[ORM\HasLifecycleCallbacks]
class Purchase
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'purchases')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : 'You must add the country.')]
    private $country;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : 'You must add the city.')]
    private $city;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : 'You must add the street.')]
    private $street;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : 'You must add the postal code.')]
    private $postalCode;

    #[ORM\Column(type: 'string', length: 255)]
    #[Assert\NotBlank(message : 'You must add the phone.')]
    private $phone;

    #[ORM\OneToOne(mappedBy: 'purchase', targetEntity: ListProduct::class, cascade: ['persist', 'remove'])]
    private $listProduct;

    #[ORM\OneToOne(mappedBy: 'purchase', targetEntity: Invoice::class, cascade: ['persist', 'remove'])]
    private $invoice;

    #[ORM\Column(type: 'string', length: 255, nullable:true)]
    private $number;

    #[ORM\PrePersist]
    public function prePersist()
    {
        if(empty($this->createdAt))
        {
            $this->createdAt = new DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getStreet(): ?string
    {
        return $this->street;
    }

    public function setStreet(string $street): self
    {
        $this->street = $street;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getListProduct(): ?ListProduct
    {
        return $this->listProduct;
    }

    public function setListProduct(ListProduct $listProduct): self
    {
        // set the owning side of the relation if necessary
        if ($listProduct->getPurchase() !== $this) {
            $listProduct->setPurchase($this);
        }

        $this->listProduct = $listProduct;

        return $this;
    }

    public function getInvoice(): ?Invoice
    {
        return $this->invoice;
    }

    public function setInvoice(Invoice $invoice): self
    {
        // set the owning side of the relation if necessary
        if ($invoice->getPurchase() !== $this) {
            $invoice->setPurchase($this);
        }

        $this->invoice = $invoice;

        return $this;
    }

    public function getNumber(): ?string
    {
        return $this->number;
    }

    public function setNumber(string $number): self
    {
        $this->number = $number;

        return $this;
    }
}