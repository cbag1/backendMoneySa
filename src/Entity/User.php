<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;


/**
 * @ApiResource(
 *      attributes={
 *              "security"="is_granted('ROLE_ADMIN')",
 *              "security_message"=" Seul l'admin Systeme peut avoir acces aux agences"            
 *      },
 *      collectionOperations={
 *              "GET"={
 *                      "method"="GET",
 *                      "path"="/users"
 *                    },
 * 
 *              "POST"={
 *                      "method"="POST",
 *                      "path"="/users"
 *                    },        
 * 
 *      },
 *      normalizationContext={"groups":{"user:read"}} ,
 *      denormalizationContext={"groups":{"user:write"}} ,
 *      
 * )
 * 
 * 
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"agence:write"})
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     * @Groups({"user:read","user:write"})
     * @Groups({"agence:read","agence:write"})
     */
    private $username;

    /**
     * 
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"agence:read","agence:write"})
     */
    private $password;



    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user:write"})
     * @Groups({"agence:read","agence:write"})
     */
    private $prenom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user:write"})
     * @Groups({"agence:read","agence:write"})
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user:write"})
     * @Groups({"agence:read","agence:write"})
     */
    private $telephone;

    /**
     * @ORM\ManyToOne(targetEntity=Profil::class, inversedBy="users")
     * @Groups({"user:read","user:write"})
     * @Groups({"agence:read","agence:write"})
     */
    private $profil;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"user:read","user:write"})
     * @Groups({"agence:read","agence:write"})
     */
    private $email;

    /**
     * @ORM\OneToOne(targetEntity=Agence::class, mappedBy="agent", cascade={"persist", "remove"})
     */
    private $agence;

    /**
     *  @SerializedName("password")
     * 
     */
    private $plainPassword="cbag";

    /**
     * @ORM\OneToMany(targetEntity=Transaction::class, mappedBy="agentDepot")
     */
    private $transactions;

    public function __construct()
    {
        $this->transactions = new ArrayCollection();
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
    public function getUsername(): string
    {
        return (string) $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_' . $this->profil->getLibelle();

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }


    /**
     * @see UserInterface
     */
    public function getPassword(): string
    {
        return (string) $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt()
    {
        // return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getProfil(): ?Profil
    {
        return $this->profil;
    }

    public function setProfil(?Profil $profil): self
    {
        $this->profil = $profil;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        // unset the owning side of the relation if necessary
        if ($agence === null && $this->agence !== null) {
            $this->agence->setAgent(null);
        }

        // set the owning side of the relation if necessary
        if ($agence !== null && $agence->getAgent() !== $this) {
            $agence->setAgent($this);
        }

        $this->agence = $agence;

        return $this;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    /**
     * @return Collection|Transaction[]
     */
    public function getTransactions(): Collection
    {
        return $this->transactions;
    }

    public function addTransaction(Transaction $transaction): self
    {
        if (!$this->transactions->contains($transaction)) {
            $this->transactions[] = $transaction;
            $transaction->setAgentDepot($this);
        }

        return $this;
    }

    public function removeTransaction(Transaction $transaction): self
    {
        if ($this->transactions->removeElement($transaction)) {
            // set the owning side to null (unless already changed)
            if ($transaction->getAgentDepot() === $this) {
                $transaction->setAgentDepot(null);
            }
        }

        return $this;
    }
}
