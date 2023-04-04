<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Metadata\ApiResource;
use App\Repository\ArticleRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;

#[ORM\Entity(repositoryClass: ArticleRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['read:collection', 'read:Article']],
    denormalizationContext: ['groups' => ['write:Article']],
)]
#[ApiFilter(SearchFilter::class, properties: ['ecurie.idApi' => 'exact', 'pilote.idApi' => 'exact'])]
class Article
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['read:collection'])]      
    private ?int $id = null;
    
    #[ORM\Column(length: 255)]
    #[Groups(['read:collection', 'write:Article'])]
    private ?string $title = null;
    
    #[ORM\Column(type: Types::TEXT)]
    #[Groups(['read:collection', 'write:Article'])]
    private ?string $content = null;
    
    #[ORM\Column]
    #[Groups(['read:collection'])]
    private ?\DateTimeImmutable $createdAt = null;
    
    #[ORM\Column(length: 255)]
    #[Groups(['read:collection', 'write:Article'])]
    private ?string $source = null;
    
    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[Groups(['read:collection', 'write:Article'])]
    private ?Pilote $pilote = null;
    
    #[ORM\ManyToOne(inversedBy: 'articles')]
    #[Groups(['read:collection', 'write:Article'])]
    private ?Ecurie $ecurie = null;

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getSource(): ?string
    {
        return $this->source;
    }

    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    public function getPilote(): ?Pilote
    {
        return $this->pilote;
    }

    public function setPilote(?Pilote $pilote): self
    {
        $this->pilote = $pilote;

        return $this;
    }

    public function getEcurie(): ?Ecurie
    {
        return $this->ecurie;
    }

    public function setEcurie(?Ecurie $ecurie): self
    {
        $this->ecurie = $ecurie;

        return $this;
    }
}
