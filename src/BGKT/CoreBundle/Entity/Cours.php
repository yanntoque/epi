<?php

namespace BGKT\CoreBundle\Entity;

use BGKT\CoreBundle\Enum\ClasseEnum;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cours
 *
 * @ORM\Table(name="cours")
 * @ORM\Entity(repositoryClass="BGKT\CoreBundle\Repository\CoursRepository")
 */
class Cours
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

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
     *
     * @ORM\Column(name="intitule", type="string", length=255, nullable=true)
     */
    private $intitule;

    /**
     * @var string
     * @ORM\Column(name="type", type="string", length=255, nullable=false)
     */
    private $classe;

    /**
     * Stock l'id du professeur lors de l'ajout d'un cours
     * @ORM\ManyToOne(targetEntity="BGKT\AdminBundle\Entity\User", inversedBy="cours")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user)
    {
        $this->user = $user;
    }

    /**
     * @return string
     */
    public function getClasse()
    {
        return $this->classe;
    }

    /**
     * @param string $classe
     * @return Cours
     */
    public function setClasse($classe)
    {
        if (!in_array($classe, ClasseEnum::getAvailableClasses())) {
            throw new \InvalidArgumentException("Invalid type");
        }

        $this->classe = $classe;

        return $this;
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
     * Set date
     *
     * @param \DateTime $date
     *
     * @return Cours
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set nomDepositaire
     *
     * @param string $nomDepositaire
     *
     * @return Cours
     */
    public function setNomDepositaire($nomDepositaire)
    {
        $this->nomDepositaire = $nomDepositaire;

        return $this;
    }

    /**
     * Get nomDepositaire
     *
     * @return string
     */
    public function getNomDepositaire()
    {
        return $this->nomDepositaire;
    }

    /**
     * Set document
     *
     * @param string $document
     *
     * @return Cours
     */
    public function setDocument($document)
    {
        $this->document = $document;

        return $this;
    }

    /**
     * Get document
     *
     * @return string
     */
    public function getDocument()
    {
        return $this->document;
    }

    /**
     * Set intitule
     *
     * @param string $intitule
     *
     * @return Cours
     */
    public function setIntitule($intitule)
    {
        $this->intitule = $intitule;

        return $this;
    }

    /**
     * Get intitule
     *
     * @return string
     */
    public function getIntitule()
    {
        return $this->intitule;
    }
}

