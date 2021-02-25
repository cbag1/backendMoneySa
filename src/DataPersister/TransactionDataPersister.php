<?php
// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\Transaction;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Security;


/**
 *
 */
class TransactionDataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $_passwordEncoder;
    private $security;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordEncoderInterface $passwordEncoder,
        Security $security
    ) {
        $this->_entityManager = $entityManager;
        $this->_passwordEncoder = $passwordEncoder;
        $this->security = $security;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof Transaction;
    }

    /**
     * @param Transaction $data
     */
    public function persist($data, array $context = [])
    {
        $data->setAgentDepot($this->security->getUser());
        // dd($data);

        // if ($data->getPlainPassword()) {
        //     $data->setPassword(
        //         $this->_passwordEncoder->encodePassword(
        //             $data,
        //             $data->getPlainPassword()
        //         )
        //     );
        //     // dd($data->getPassword());

        //     $data->eraseCredentials();
        // }


        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        // $data->setArchive(1);
        // $this->_entityManager->persist($data);
        // $this->_entityManager->flush();
        // $this->_entityManager->remove($data);
        // $this->_entityManager->flush();
    }
}
