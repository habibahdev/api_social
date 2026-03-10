<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;

/**
 * Class Post
 * @package App\Entity
 */
#[ORM\Entity]
#[ORM\Table(name: 'post')]
class Post
{
    /**
     * Undocumented variable
     *
     * @var integer|null
     */
    #[ORM\Id]
    #[ORM\Column(type: 'integer')]
    #[ORM\GeneratedValue]
    #[Groups(['get'])]
    private ?int $id = null;

    /**
     * Undocumented variable
     *
     * @var string
     */
    #[ORM\Column(type: 'text')]
    #[Groups(['get'])]
    private string $content;

    /**
     * Undocumented variable
     *
     * @var \DateTimeInterface
     */
    #[ORM\Column(type: "datetime_immutable")]
    #[Groups(['get'])]
    private \DateTimeInterface $publishedAt;

    /**
     * Undocumented variable
     *
     * @var User
     */
    #[ORM\ManyToOne(targetEntity: User::class)]
    private User $author;

    /**
     * Undocumented variable
     *
     * @var User[]|Collection
     */
    #[ORM\ManyToMany(targetEntity: User::class)]
    #[ORM\JoinTable(name: 'post_likes')]
    private Collection $likedBy;

    /**
     * Undocumented function
     *
     * @param string $content
     * @param User $author
     * @return self
     */
    public static function create(string $content, User $author): self
    {
        $post = new self();
        $post->content = $content;
        $post->author = $author;
        return $post;
    }

    /**
     * Undocumented function
     */
    public function __construct()
    {
        // c'est une date qui ne sera jamais miodifiée
        $this->publishedAt = new \DateTimeImmutable();
        $this->likedBy = new ArrayCollection();
    }

    /**
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * Undocumented function
     *
     * @param string $content
     * @return void
     */
    public function setContent(string $content): void
    {
        $this->content = $content;
    }

    /**
     * Undocumented function
     *
     * @return \DateTimeInterface
     */
    public function getPublishedAt(): \DateTimeInterface
    {
        return $this->publishedAt;
    }

    /**
     * Undocumented function
     *
     * @param \DateTimeInterface $publishedAt
     * @return void
     */
    public function setPublishedAt(\DateTimeInterface $publishedAt): void
    {
        $this->publishedAt = $publishedAt;
    }

    /**
     * Undocumented function
     *
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * Undocumented function
     *
     * @param User $author
     * @return void
     */
    public function setAuthor(User $author): void
    {
        $this->author = $author;
    }

    /**
     * Undocumented function
     *
     * @return User[]|Collection
     */
    public function getLikedBy(): Collection
    {
        return $this->likedBy;
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @return void
     */
    public function likeBy(User $user): void
    {
        if ($this->likedBy->contains($user)) {
            return;
        }
        $this->likedBy->add($user);
    }

    /**
     * Undocumented function
     *
     * @param User $user
     * @return void
     */
    public function dislikeBy(User $user): void
    {
        if (!$this->likedBy->contains($user)) {
            return;
        }
        $this->likedBy->removeElement($user);
    }
}