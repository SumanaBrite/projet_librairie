<?php

namespace App\Entity;

use App\Repository\FournisseurRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=FournisseurRepository::class)
 */
class Fournisseur
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=60)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $tva;

    /**
     * @ORM\Column(type="string", length=80)
     */
    private $contact;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=150)
     */
    private $adresse_web;

    /**
     * @ORM\Column(type="string", length=40)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\ManyToMany(targetEntity=ArticleStock::class, mappedBy="fournisseur")
     */
    private $articleStocks;

    public function __construct()
    {
        $this->articleStocks = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTva(): ?string
    {
        return $this->tva;
    }

    public function setTva(string $tva): self
    {
        $this->tva = $tva;

        return $this;
    }

    public function getContact(): ?string
    {
        return $this->contact;
    }

    public function setContact(string $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAdresseWeb(): ?string
    {
        return $this->adresse_web;
    }

    public function setAdresseWeb(string $adresse_web): self
    {
        $this->adresse_web = $adresse_web;

        return $this;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|ArticleStock[]
     */
    public function getArticleStocks(): Collection
    {
        return $this->articleStocks;
    }

    public function addArticleStock(ArticleStock $articleStock): self
    {
        if (!$this->articleStocks->contains($articleStock)) {
            $this->articleStocks[] = $articleStock;
            $articleStock->addFournisseur($this);
        }

        return $this;
    }

    public function removeArticleStock(ArticleStock $articleStock): self
    {
        if ($this->articleStocks->removeElement($articleStock)) {
            $articleStock->removeFournisseur($this);
        }

        return $this;
    }
}
