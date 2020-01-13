<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $content;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     * @ORM\JoinColumn(nullable=false)
     */
    private $category;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\ArticleImages", mappedBy="article")
     */
    private $articleImages;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->articleImages = new ArrayCollection();
    }


    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        $this->createdAt = new \DateTime( 'now' );

        return $this;
    }

    /**
     * @return string|null
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return $this
     */
    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return $this
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category|null $category
     * @return $this
     */
    public function setCategory(?Category $category): self
    {
        $this->category = $category;

        return $this;
    }


    /**
     * @return string
     */
    public function __toString()
    {

        return $this->id . ' : ' . $this->title . '';


    }

    /**
     * @return Collection|ArticleImages[]
     */
    public function getArticleImages(): Collection
    {
        return $this->articleImages;
    }

    /**
     * @param ArticleImages $articleImage
     * @return $this
     */
    public function addArticleImage(ArticleImages $articleImage): self
    {
        if (!$this->articleImages->contains( $articleImage )) {
            $this->articleImages[] = $articleImage;
            $articleImage->setArticle( $this );
        }

        return $this;
    }

    /**
     * @param ArticleImages $articleImage
     * @return $this
     */
    public function removeArticleImage(ArticleImages $articleImage): self
    {
        if ($this->articleImages->contains( $articleImage )) {
            $this->articleImages->removeElement( $articleImage );
            // set the owning side to null (unless already changed)
            if ($articleImage->getArticle() === $this) {
                $articleImage->setArticle( null );
            }
        }

        return $this;
    }


}
