<?php

namespace App\Entity;

use App\Entity\User;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\ClientRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;

/**
 * @ApiResource(
 *  attributes={
 *              "security"="is_granted('ROLE_ADMIN_AGENCE')",
 *              "security_message"=" Seul l'admin de l'agence peut avoir acces aux agences"            
 *      },
 *      collectionOperations={
 *              "GET"={
 *                      "method"="GET",
 *                      "path"="/client"
 *                    },
 * 
 *              "POST"={
 *                      "method"="POST",
 *                      "path"="/client"
 *                    },        
 * 
 *      },
 *      normalizationContext={"groups":{"client:read"}} ,
 *      denormalizationContext={"groups":{"client:write"}} ,
 *     
 * 
 * )
 * @ORM\Entity(repositoryClass=ClientRepository::class)
 */
class Client
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
     * @Groups({"client:read","client:write"})
     * @Groups({"transaction:read","transaction:write"})
     */
    private $nomClient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client:read","client:write"})
     * @Groups({"transaction:read","transaction:write"})
     * 
     */
    private $nomBeneficiaire;



    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client:read","client:write"})
     * @Groups({"transaction:read","transaction:write"})
     * 
     */
    private $cniClient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client:read","client:write"})
     * @Groups({"transaction:read","transaction:write"})
     * 
     */
    private $cniBeneficiaire;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client:read","client:write"})
     * @Groups({"transaction:read","transaction:write"})
     * 
     */
    private $telClient;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups({"client:read","client:write"})
     * @Groups({"transaction:read","transaction:write"})
     * 
     */
    private $telBeneficiaire;

    /**
     * @ORM\OneToOne(targetEntity=Transaction::class, mappedBy="client", cascade={"persist", "remove"})
     */
    private $transaction;

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomClient(): ?string
    {
        return $this->nomClient;
    }

    public function setNomClient(string $nomClient): self
    {
        $this->nomClient = $nomClient;

        return $this;
    }

    public function getNomBeneficiaire(): ?string
    {
        return $this->nomBeneficiaire;
    }

    public function setNomBeneficiaire(string $nomBeneficiaire): self
    {
        $this->nomBeneficiaire = $nomBeneficiaire;

        return $this;
    }

    public function getCniClient(): ?string
    {
        return $this->cniClient;
    }

    public function setCniClient(string $cniClient): self
    {
        $this->cniClient = $cniClient;

        return $this;
    }

    public function getCniBeneficiaire(): ?string
    {
        return $this->cniBeneficiaire;
    }

    public function setCniBeneficiaire(string $cniBeneficiaire): self
    {
        $this->cniBeneficiaire = $cniBeneficiaire;

        return $this;
    }

    public function getTelClient(): ?string
    {
        return $this->telClient;
    }

    public function setTelClient(string $telClient): self
    {
        $this->telClient = $telClient;

        return $this;
    }

    public function getTelBeneficiaire(): ?string
    {
        return $this->telBeneficiaire;
    }

    public function setTelBeneficiaire(string $telBeneficiaire): self
    {
        $this->telBeneficiaire = $telBeneficiaire;

        return $this;
    }

    public function getTransaction(): ?Transaction
    {
        return $this->transaction;
    }

    public function setTransaction(?Transaction $transaction): self
    {
        // unset the owning side of the relation if necessary
        if ($transaction === null && $this->transaction !== null) {
            $this->transaction->setClient(null);
        }

        // set the owning side of the relation if necessary
        if ($transaction !== null && $transaction->getClient() !== $this) {
            $transaction->setClient($this);
        }

        $this->transaction = $transaction;

        return $this;
    }

    
}
