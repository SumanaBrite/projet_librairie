<?php

namespace App\Entity;

use App\Repository\ArticleStockRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ArticleStockRepository::class)
 */
class ArticleStock
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Article::class, inversedBy="articleStocks")
     * @ORM\JoinColumn(nullable=false)
     */
    private $article;

    /**
     * @ORM\ManyToMany(targetEntity=Fournisseur::class, inversedBy="articleStocks")
     */
    private $fournisseur;

    /**
     * @ORM\Column(type="float")
     */
    private $prixAchat;

    /**
     * @ORM\Column(type="float")
     */
    private $prixVente;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */
    private $tauxTVA;

    /**
     * @ORM\Column(type="decimal", precision=5, scale=2, nullable=true)
     */
    private $remise;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantite;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $dateReception;

    /**
     * @ORM\Column(type="date")
     */
    private $dateCommande;

    public function __construct()
    {
        $this->fournisseur = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getArticle(): ?Article
    {
        return $this->article;
    }

    public function setArticle(?Article $article): self
    {
        $this->article = $article;

        return $this;
    }

    /**
     * @return Collection|Fournisseur[]
     */
    public function getFournisseur(): Collection
    {
        return $this->fournisseur;
    }

    public function addFournisseur(Fournisseur $fournisseur): self
    {
        if (!$this->fournisseur->contains($fournisseur)) {
            $this->fournisseur[] = $fournisseur;
        }

        return $this;
    }

    public function removeFournisseur(Fournisseur $fournisseur): self
    {
        $this->fournisseur->removeElement($fournisseur);

        return $this;
    }

    public function getPrixAchat(): ?float
    {
        return $this->prixAchat;
    }

    public function setPrixAchat(float $prixAchat): self
    {
        $this->prixAchat = $prixAchat;

        return $this;
    }

    public function getPrixVente(): ?float
    {
        return $this->prixVente;
    }

    public function setPrixVente(float $prixVente): self
    {
        $this->prixVente = $prixVente;

        return $this;
    }

    public function getTauxTVA(): ?string
    {
        return $this->tauxTVA;
    }

    public function setTauxTVA(string $tauxTVA): self
    {
        $this->tauxTVA = $tauxTVA;

        return $this;
    }

    public function getRemise(): ?string
    {
        return $this->remise;
    }

    public function setRemise(?string $remise): self
    {
        $this->remise = $remise;

        return $this;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    public function getDateReception(): ?\DateTimeInterface
    {
        return $this->dateReception;
    }

    public function setDateReception(?\DateTimeInterface $dateReception): self
    {
        $this->dateReception = $dateReception;

        return $this;
    }

    public function getDateCommande(): ?\DateTimeInterface
    {
        return $this->dateCommande;
    }

    public function setDateCommande(\DateTimeInterface $dateCommande): self
    {
        $this->dateCommande = $dateCommande;

        return $this;
    }
}
