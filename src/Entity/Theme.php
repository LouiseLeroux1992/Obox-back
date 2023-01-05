<?php

namespace App\Entity;

use App\Repository\ThemeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ThemeRepository::class)
 */
class Theme
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"theme_browse"})
     * @Groups({"theme_read"})
     * @Groups({"article_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=128)
     * 
     * @Groups({"theme_browse"})
     * @Groups({"theme_read"})
     * @Groups({"article_read"})
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=128)
     * 
     * @Groups({"theme_browse"})
     * @Groups({"theme_read"})
     * @Groups({"article_read"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"theme_browse"})
     * @Groups({"theme_read"})
     */
    private $image;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Groups({"theme_read"})
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"theme_browse"})
     * @Groups({"theme_read"})
     */
    private $image_description;

    /**
     * @ORM\ManyToMany(targetEntity=Article::class, mappedBy="themes")
     * 
     * @Groups({"theme_read"})
     */
    private $articles;

    public function __construct()
    {
        $this->articles = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(?string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getImageDescription(): ?string
    {
        return $this->image_description;
    }

    public function setImageDescription(?string $image_description): self
    {
        $this->image_description = $image_description;

        return $this;
    }

    /**
     * @return Collection<int, Article>
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains($article)) {
            $this->articles[] = $article;
            $article->addTheme($this);
        }

        return $this;
    }

    public function removeArticle(Article $article): self
    {
        if ($this->articles->removeElement($article)) {
            $article->removeTheme($this);
        }

        return $this;
    }
}
