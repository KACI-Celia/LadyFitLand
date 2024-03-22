<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'Cet email est déja associé à un compte existant')]//contrainte pour l'identidiant email
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column(type:'boolean')]
    private $is_verified = false;

    #[ORM\Column(type:'string',length:100 , nullable: true)]
    private $resetToken;

    /**
     * @var string The hashed password
     */
    #[ORM\Column(length: 100, nullable: true)]
    private ?string $nomUser = null;

    #[ORM\Column(length: 100, nullable: true)]
    private ?string $prenomUser = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateNaissanceUser = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresseUser = null;

    #[ORM\Column(length: 255)]
    private ?string $zipcode = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $adresseFacturationUser = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $telUser = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\ManyToMany(targetEntity: Cours::class, inversedBy: 'users')]
    private Collection $Cours;

    #[ORM\OneToOne(inversedBy: 'user', cascade: ['persist', 'remove'])]
    private ?Abonnement $Abonnement = null;

    #[ORM\ManyToMany(targetEntity: Idees::class, inversedBy: 'users')]
    private Collection $Idees;

    #[ORM\ManyToMany(targetEntity: Espaces::class, inversedBy: 'users')]
    private Collection $Espaces;

    public function __construct()
    {
        $this->Cours = new ArrayCollection();
        $this->Idees = new ArrayCollection();
        $this->Espaces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // toute personne connectée a le  ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    public function getIsVerified():?bool
    {
        return $this->is_verified;
    }
    public function setIsVerified(bool $is_verified):self
    {
        $this->is_verified = $is_verified;
        return $this;
    }

    public function getResetToken():?string
    {
        return $this->resetToken;
    }
    public function setResetToken(?string $resetToken):self//self:renvoi de l'instance elle meme
    {
        $this->resetToken = $resetToken;
        return $this;
    }

    public function getNomUser(): ?string
    {
        return $this->nomUser;
    }
    public function setNomUser(?string $nomUser): static
    {
        $this->nomUser = $nomUser;

        return $this;
    }

    public function getPrenomUser(): ?string
    {
        return $this->prenomUser;
    }
    public function setPrenomUser(?string $prenomUser): static
    {
        $this->prenomUser = $prenomUser;

        return $this;
    }

    public function getDateNaissanceUser(): ?\DateTimeInterface
    {
        return $this->dateNaissanceUser;
    }
    public function setDateNaissanceUser(?\DateTimeInterface $dateNaissanceUser): static
    {
        $this->dateNaissanceUser = $dateNaissanceUser;
        return $this;
    }

    public function getAdresseUser(): ?string
    {
        return $this->adresseUser;
    }
    public function setAdresseUser(?string $adresseUser): static
    {
        $this->adresseUser = $adresseUser;
        return $this;
    }
    public function getZipcode(): ?string
    {
        return $this->zipcode;
    }

    public function setZipcode(string $zipcode): static
    {
        $this->zipcode = $zipcode;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }
    public function setCity(string $city): static
    {
        $this->city = $city;
        return $this;
    }
    
    public function getAdresseFacturationUser(): ?string
    {
        return $this->adresseFacturationUser;
    }
    public function setAdresseFacturationUser(?string $adresseFacturationUser): static
    {
        $this->adresseFacturationUser = $adresseFacturationUser;
        return $this;
    }

    public function getTelUser(): ?string
    {
        return $this->telUser;
    }
    public function setTelUser(?string $telUser): static
    {
        $this->telUser = $telUser;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }
    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @return Collection<int, Cours>
     */
    public function getCours(): Collection
    {
        return $this->Cours;
    }

    public function addCour(Cours $cour): static
    {
        if (!$this->Cours->contains($cour)) {
            $this->Cours->add($cour);
        }

        return $this;
    }

    public function removeCour(Cours $cour): static
    {
        $this->Cours->removeElement($cour);

        return $this;
    }

    public function getAbonnement(): ?Abonnement
    {
        return $this->Abonnement;
    }

    public function setAbonnement(?Abonnement $Abonnement): static
    {
        $this->Abonnement = $Abonnement;

        return $this;
    }

    /**
     * @return Collection<int, Idees>
     */
    public function getIdees(): Collection
    {
        return $this->Idees;
    }

    public function addIdee(Idees $idee): static
    {
        if (!$this->Idees->contains($idee)) {
            $this->Idees->add($idee);
        }

        return $this;
    }

    public function removeIdee(Idees $idee): static
    {
        $this->Idees->removeElement($idee);

        return $this;
    }

    /**
     * @return Collection<int, Espaces>
     */
    public function getEspaces(): Collection
    {
        return $this->Espaces;
    }

    public function addEspace(Espaces $espace): static
    {
        if (!$this->Espaces->contains($espace)) {
            $this->Espaces->add($espace);
        }

        return $this;
    }

    public function removeEspace(Espaces $espace): static
    {
        $this->Espaces->removeElement($espace);

        return $this;
    }
}
