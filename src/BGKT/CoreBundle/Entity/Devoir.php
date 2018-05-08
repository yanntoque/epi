<?php

namespace BGKT\CoreBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Devoir
 *
 * @ORM\Table(name="devoir")
 * @ORM\Entity(repositoryClass="BGKT\CoreBundle\Repository\DevoirRepository")
 */
class Devoir
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="titre", type="string", length=255)
     */
    private $titre;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateRendu", type="datetime")
     */
    private $dateRendu;

    /**
     * @var string
     *
     * @ORM\Column(name="commentaire", type="string", length=255)
     */
    private $commentaire;


    /**
     * @var string
     *
     * @ORM\Column(name="nomDepositaire", type="string", length=255, nullable=true)
     */
    private $nomDepositaire;


    /**
     * @var string
     *
     * @ORM\Column(name="document", type="string", length=255)
     * @Assert\NotBlank(message="S'il vous plaît, téléchargez le fichier sous format PDF")
     * @Assert\File(mimeTypes={ "application/pdf" })
     */
    private $document;


    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $classe;

    /**
     * @param string $classe
     */
    public function setClasse($classe)
    {
        $this->classe = $classe;
    }

    /**
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set titre
     *
     * @param string $titre
     *
     * @return Devoir
     */
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }

    /**
     * Get titre
     *
     * @return string
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set dateRendu
     *
     * @param \DateTime $dateRendu
     *
     * @return Devoir
     */
    public function setDateRendu($dateRendu)
    {
        $this->dateRendu = $dateRendu;

        return $this;
    }

    /**
     * Get dateRendu
     *
     * @return \DateTime
     */
    public function getDateRendu()
    {
        return $this->dateRendu;
    }

    /**
     * @return string
     */
    public function getNomDepositaire()
    {
        return $this->nomDepositaire;
    }

    /**
     * @param string $nomDepositaire
     */
    public function setNomDepositaire($nomDepositaire)
    {
        $this->nomDepositaire = $nomDepositaire;
    }

    /**
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * @param string $document
     */
    public function setDocument($document)
    {
        $this->document = $document;
    }

    /**
     * Set commentaire
     *
     * @param string $commentaire
     *
     * @return Devoir
     */
    public function setCommentaire($commentaire)
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    /**
     * Get commentaire
     *
     * @return string
     */
    public function getCommentaire()
    {
        return $this->commentaire;
    }
}

