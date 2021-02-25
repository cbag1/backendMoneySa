<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\TransactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;


/**
 * @ApiResource(
 * attributes={
 *              "security"="is_granted('ROLE_ADMIN_AGENCE')",
 *              "security_message"=" Seul l'admin de l'agence peut avoir acces aux agences"            
 *      },
 *      collectionOperations={
 *              "GET"={
 *                      "method"="GET",
 *                      "path"="/transaction"
 *                    },
 * 
 *              "POST"={
 *                      "method"="POST",
 *                      "path"="/transaction"
 *                    },        
 * 
 *      },
 *      normalizationContext={"groups":{"transaction:read"}} ,
 *      denormalizationContext={"groups":{"transaction:write"}} ,
 *     
 * )
 * @ORM\Entity(repositoryClass=TransactionRepository::class)
 */
class Transaction
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups({"transaction:write"})
     * 
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"transaction:read","transaction:write"})
     */
    private $code;

    /**
     * @ORM\Column(type="integer", length=255)
     * @Groups({"transaction:read","transaction:write"})
     */
    private $montant;

    /**
     * @ORM\Column(type="datetime")
     * @Groups({"transaction:read","transaction:write"})
     */
    private $dateDepot;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @Groups({"transaction:read","transaction:write"})
     */
    private $dateRetrait;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"transaction:read","transaction:write"})
     */
    private $partEtat;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"transaction:read","transaction:write"})
     */
    private $partEnt;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"transaction:read","transaction:write"})
     */
    private $partAgenceRetrait;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"transaction:read","transaction:write"})
     */
    private $partAgenceDepot;

    
    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="transactions")
     */
    private $agentDepot;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="transactions")
     */
    private $agentRetrait;

    /**
     * @ORM\OneToOne(targetEntity=Client::class, inversedBy="transaction", cascade={"persist", "remove"})
     * @Groups({"transaction:read","transaction:write"})
     */
    private $client;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(string $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function getDateDepot(): ?\DateTimeInterface
    {
        return $this->dateDepot;
    }

    public function setDateDepot(\DateTimeInterface $dateDepot): self
    {
        $this->dateDepot = $dateDepot;

        return $this;
    }

    public function getDateRetrait(): ?\DateTimeInterface
    {
        return $this->dateRetrait;
    }

    public function setDateRetrait(\DateTimeInterface $dateRetrait): self
    {
        $this->dateRetrait = $dateRetrait;

        return $this;
    }

    public function getPartEtat(): ?int
    {
        return $this->partEtat;
    }

    public function setPartEtat(int $partEtat): self
    {
        $this->partEtat = $partEtat;

        return $this;
    }

    public function getPartEnt(): ?int
    {
        return $this->partEnt;
    }

    public function setPartEnt(int $partEnt): self
    {
        $this->partEnt = $partEnt;

        return $this;
    }

    public function getPartAgenceRetrait(): ?int
    {
        return $this->partAgenceRetrait;
    }

    public function setPartAgenceRetrait(int $partAgenceRetrait): self
    {
        $this->partAgenceRetrait = $partAgenceRetrait;

        return $this;
    }

    public function getPartAgenceDepot(): ?int
    {
        return $this->partAgenceDepot;
    }

    public function setPartAgenceDepot(int $partAgenceDepot): self
    {
        $this->partAgenceDepot = $partAgenceDepot;

        return $this;
    }

 
   
    public function getAgentDepot(): ?User
    {
        return $this->agentDepot;
    }

    public function setAgentDepot(?User $agentDepot): self
    {
        $this->agentDepot = $agentDepot;

        return $this;
    }

    public function getAgentRetrait(): ?User
    {
        return $this->agentRetrait;
    }

    public function setAgentRetrait(?User $agentRetrait): self
    {
        $this->agentRetrait = $agentRetrait;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }
}
