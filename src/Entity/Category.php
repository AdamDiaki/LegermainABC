<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 */
class Category
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
     * @ORM\Column(type="string", length=255)
     */
    private $content;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RequestProject", mappedBy="category")
     */
    private $requestProjects;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Article", mappedBy="category")
     */
    private $articles;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->requestProjects = new ArrayCollection();
        $this->articles = new ArrayCollection();
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
     * @return Collection|RequestProject[]
     */
    public function getRequestProjects(): Collection
    {
        return $this->requestProjects;
    }

    /**
     * @param RequestProject $requestProject
     * @return $this
     */
    public function addRequestProject(RequestProject $requestProject): self
    {
        if (!$this->requestProjects->contains( $requestProject )) {
            $this->requestProjects[] = $requestProject;
            $requestProject->setCategory( $this );
        }

        return $this;
    }

    /**
     * @param RequestProject $requestProject
     * @return $this
     */
    public function removeRequestProject(RequestProject $requestProject): self
    {
        if ($this->requestProjects->contains( $requestProject )) {
            $this->requestProjects->removeElement( $requestProject );
            // set the owning side to null (unless already changed)
            if ($requestProject->getCategory() === $this) {
                $requestProject->setCategory( null );
            }
        }

        return $this;
    }

    /**
     * @return Collection|Article[]
     */
    public function getArticles(): Collection
    {
        return $this->articles;
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function addArticle(Article $article): self
    {
        if (!$this->articles->contains( $article )) {
            $this->articles[] = $article;
            $article->setCategory( $this );
        }

        return $this;
    }

    /**
     * @param Article $article
     * @return $this
     */
    public function removeArticle(Article $article): self
    {
        if ($this->articles->contains( $article )) {
            $this->articles->removeElement( $article );
            // set the owning side to null (unless already changed)
            if ($article->getCategory() === $this) {
                $article->setCategory( null );
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->id . ' : ' . $this->title;
    }


}
