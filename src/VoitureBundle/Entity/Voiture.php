<?php

namespace VoitureBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Voiture
 *
 * @ORM\Table(name="voiture")
 * @ORM\Entity(repositoryClass="VoitureBundle\Repository\VoitureRepository")
 */
class Voiture
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
     * @ORM\Column(name="NumSerie", type="string", length=50)
     */
    private $numSerie;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Date_Mise_Circu", type="date")
     */
    private $dateMiseCircu;


    /**  
      * @ORM\ManyToOne(targetEntity="Marque")  
      */
    private $marque;

    function getMarque(){
        return $this ->marque;
    }

    function setMarque($marque){
        $this ->marque=$marque;
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
     * Set numSerie
     *
     * @param string $numSerie
     *
     * @return Voiture
     */
    public function setNumSerie($numSerie)
    {
        $this->numSerie = $numSerie;

        return $this;
    }

    /**
     * Get numSerie
     *
     * @return string
     */
    public function getNumSerie()
    {
        return $this->numSerie;
    }

    /**
     * Set dateMiseCircu
     *
     * @param \DateTime $dateMiseCircu
     *
     * @return Voiture
     */
    public function setDateMiseCircu($dateMiseCircu)
    {
        $this->dateMiseCircu = $dateMiseCircu;

        return $this;
    }

    /**
     * Get dateMiseCircu
     *
     * @return \DateTime
     */
    public function getDateMiseCircu()
    {
        return $this->dateMiseCircu;
    }
}

