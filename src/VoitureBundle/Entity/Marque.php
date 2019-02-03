<?php

namespace VoitureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Marque
 *
 * @ORM\Table(name="marque")
 * @ORM\Entity(repositoryClass="VoitureBundle\Repository\MarqueRepository")
 */
class Marque
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
     * @ORM\Column(name="nomMarque", type="string", length=50)
     */
    private $nomMarque;


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
     * Set nomMarque
     *
     * @param string $nomMarque
     *
     * @return Marque
     */
    public function setNomMarque($nomMarque)
    {
        $this->nomMarque = $nomMarque;

        return $this;
    }

    /**
     * Get nomMarque
     *
     * @return string
     */
    public function getNomMarque()
    {
        return $this->nomMarque;
    }
}

