<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ComplexRepository")
 */
class Complex
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $url;

    /**
     * @ORM\Column(type="integer", unique=true)
     */
    private $externalId;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Flat", mappedBy="complex", orphanRemoval=true)
     */
    private $flats;

    public function __construct()
    {
        $this->flats = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getExternalId()
    {
        return $this->externalId;
    }

    public function setExternalId($externalId): void
    {
        $this->externalId = $externalId;
    }

    /**
     * @return Collection|Flat[]
     */
    public function getFlats(): Collection
    {
        return $this->flats;
    }

    public function addFlat(Flat $flat): self
    {
        if (!$this->flats->contains($flat)) {
            $this->flats[] = $flat;
            $flat->setComplex($this);
        }

        return $this;
    }

    public function removeFlat(Flat $flat): self
    {
        if ($this->flats->contains($flat)) {
            $this->flats->removeElement($flat);
            // set the owning side to null (unless already changed)
            if ($flat->getComplex() === $this) {
                $flat->setComplex(null);
            }
        }

        return $this;
    }
}
