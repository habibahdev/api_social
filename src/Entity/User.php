<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 */
#[ORM\Entity]
#[ORM\Table(name: 'user')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * Undocumented variable
     *
     * @var integer|null
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
    #[ORM\Column(unique: true)]
    private string $email;

    /**
     * Undocumented variable
     *
     * @var string
     */
    #[ORM\Column]
    private string $password;

    /**
     * Undocumented variable
     *
     * @var string
     */
    #[ORM\Column]
    private string $name;

    /**
     * factory method pour créer et instancié directement un utilisateur
     *
     * @param string $email
     * @param string $name
     * @return self
     */
    public static function create(string $email, string $name): self
    {
        $user = new self();
        $user->email = $email;
        $user->name = $name;
        return $user;
    }

    /**
     * Undocumented variable
     *
     * @return integer
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Undocumented variable
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Undocumented variable
     *
     * @param string $email
     * @return void
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * Undocumented variable
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * Undocumented variable
     *
     * @param string $password
     * @return void
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }

    /**
     * Undocumented variable
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Undocumented variable
     *
     * @param string $name
     * @return void
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * Undocumented function
     *
     * @return string[]
     */
    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    /**
     * Undocumented function
     *
     * @return string
     */
    public function getUserIdentifier(): string
    {
        return $this->email;
    }
}