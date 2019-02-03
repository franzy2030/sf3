<?php

namespace filmBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * acteur
 *
 * @ORM\Table(name="acteur")
 * @ORM\Entity(repositoryClass="filmBundle\Repository\acteurRepository")
 */
class acteur
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
     * @ORM\Column(name="nomActeur", type="string", length=255)
     */
    private $nomActeur;

    /**
     * @var string
     *
     * @ORM\Column(name="prenomActeur", type="string", length=255)
     */
    private $prenomActeur;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datenaissace", type="date")
     */
    private $datenaissace;

    /**
     * @var string
     *
     * @ORM\Column(name="sexe", type="string", length=255)
     */
    private $sexe;


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
     * Set nomActeur
     *
     * @param string $nomActeur
     *
     * @return acteur
     */
    public function setNomActeur($nomActeur)
    {
        $this->nomActeur = $nomActeur;

        return $this;
    }

    /**
     * Get nomActeur
     *
     * @return string
     */
    public function getNomActeur()
    {
        return $this->nomActeur;
    }

    /**
     * Set prenomActeur
     *
     * @param string $prenomActeur
     *
     * @return acteur
     */
    public function setPrenomActeur($prenomActeur)
    {
        $this->prenomActeur = $prenomActeur;

        return $this;
    }

    /**
     * Get prenomActeur
     *
     * @return string
     */
    public function getPrenomActeur()
    {
        return $this->prenomActeur;
    }

    /**
     * Set datenaissace
     *
     * @param \DateTime $datenaissace
     *
     * @return acteur
     */
    public function setDatenaissace($datenaissace)
    {
        $this->datenaissace = $datenaissace;

        return $this;
    }

    /**
     * Get datenaissace
     *
     * @return \DateTime
     */
    public function getDatenaissace()
    {
        return $this->datenaissace;
    }

    /**
     * Set sexe
     *
     * @param string $sexe
     *
     * @return acteur
     */
    public function setSexe($sexe)
    {
        $this->sexe = $sexe;

        return $this;
    }

    /**
     * Get sexe
     *
     * @return string
     */
    public function getSexe()
    {
        return $this->sexe;
    }
}

