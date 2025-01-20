<?php

namespace App\Entity;

use App\Repository\CategorieRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategorieRepository::class)]
#[ORM\UniqueConstraint("uniqueName", fields: ["name"] )]
class Categorie
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name = null;

    /**
     * @var Collection<int, Films>
     */
    #[ORM\OneToMany(targetEntity: Films::class, mappedBy: 'categorie')]
    private Collection $films;

    /**
     * @var Collection<int, Series>
     */
    #[ORM\OneToMany(targetEntity: Series::class, mappedBy: 'categorie', orphanRemoval: true)]
    private Collection $series;

    public function __construct()
    {
        $this->films = new ArrayCollection();
        $this->series = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(int $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Collection<int, Films>
     */
    public function getFilms(): Collection
    {
        return $this->films;
    }

    public function addFilm(Films $film): static
    {
        if (!$this->films->contains($film)) {
            $this->films->add($film);
            $film->setCategorie($this);
        }

        return $this;
    }

    public function removeFilm(Films $film): static
    {
        if ($this->films->removeElement($film)) {
            // set the owning side to null (unless already changed)
            if ($film->getCategorie() === $this) {
                $film->setCategorie(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Series>
     */
    public function getSeries(): Collection
    {
        return $this->series;
    }

    public function addSeries(Series $series): static
    {
        if (!$this->series->contains($series)) {
            $this->series->add($series);
            $series->setCategorie($this);
        }

        return $this;
    }

    public function removeSeries(Series $series): static
    {
        if ($this->series->removeElement($series)) {
            // set the owning side to null (unless already changed)
            if ($series->getCategorie() === $this) {
                $series->setCategorie(null);
            }
        }

        return $this;
    }


    public function __toString():string
    {
        return $this->getName();
    }
}


