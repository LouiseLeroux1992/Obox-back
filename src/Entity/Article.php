<?php

namespace App\Entity;

use App\Repository\ArticleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass=ArticleRepository::class)
 */
class Article
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * 
     * @Groups({"article_browse"})
     * @Groups({"article_read"})
     * @Groups({"theme_read"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"article_browse"})
     * @Groups({"article_read"})
     * @Groups({"theme_read"})
     */
    private $title;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"article_browse"})
     * @Groups({"article_read"})
     * @Groups({"theme_read"})
     */
    private $slug;

    /**
     * @ORM\Column(type="string", length=255)
     * 
     * @Groups({"article_browse"})
     * @Groups({"theme_read"})
     * @Groups({"article_read"})
     */
    private $summary;

    /**
     * @ORM\Column(type="text")
     * 
     * @Groups({"article_read"})
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"article_browse"})
     * @Groups({"article_read"})
     * @Groups({"theme_read"})
     */
    private $image;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     * 
     * @Groups({"article_browse"})
     * @Groups({"article_read"})
     * @Groups({"theme_read"})
     */
    private $image_description;

    /**
     * @ORM\ManyToMany(targetEntity=Theme::class, inversedBy="articles")
     * 
     * @Groups({"article_read"})
     */
    private $themes;

    public function __construct()
    {
        $this->themes = new ArrayCollection();
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

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(string $slug): self
    {
        $this->slug = $slug;

        return $this;
    }

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

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
     * @return Collection<int, Theme>
     */
    public function getThemes(): Collection
    {
        return $this->themes;
    }

    public function addTheme(Theme $theme): self
    {
        if (!$this->themes->contains($theme)) {
            $this->themes[] = $theme;
        }

        return $this;
    }

    public function removeTheme(Theme $theme): self
    {
        $this->themes->removeElement($theme);

        return $this;
    }
}
