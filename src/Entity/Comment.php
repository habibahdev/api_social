<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class Comment
 * @package App\Entity
 */
#[ORM\Entity]
#[ORM\Table(name: 'comment')]
class Comment
{
    /**
     * Undocumented variable
     *
     * @var integer
     */
    #[ORM\Id]
    #[ORM\Column(type: "integer")]
    #[ORM\GeneratedValue]
    private ?int $id;

    /**
     * Undocumented variable
     *
     * @var string
     */
    #[ORM\Column(type: 'text')]
    private string $message;

    /**
     * Undocumented variable
     *
     * @var \DateTimeInterface
     */
    #[ORM\Column(type: "datetime_immutable")]
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
     * @var Post
     */
    #[ORM\ManyToOne(targetEntity: Post::class)]
    #[ORM\JoinColumn(onDelete: 'cascade')]
    private Post $post;

    /**
     * Undocumented function
     *
     * @param string $message
     * @param User $author
     * @param Post $post
     * @return self
     */
    public static function create(string $message, User $author, Post $post): self
    {
        $comment = new self();
        $comment->message = $message;
        $comment->author = $author;
        $comment->post = $post;
        return $comment;
    }

    /**
     * Undocumented function
     */
    public function __construct()
    {
        $this->publishedAt = new \DateTimeImmutable();
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
    public function getMessage(): string
    {
        return $this->message;
    }

    /**
     * Undocumented function
     *
     * @param string $message
     * @return void
     */
    public function setMessage(string $message): void
    {
        $this->message = $message;
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
     * @return Post
     */
    public function getPost(): Post
    {
        return $this->post;
    }

    /**
     * Undocumented function
     *
     * @param Post $post
     * @return void
     */
    public function setPost(Post $post): void
    {
        $this->post = $post;
    }
}