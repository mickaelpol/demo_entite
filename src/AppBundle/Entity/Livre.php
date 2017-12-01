<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Livre
 *
 * @ORM\Table(name="livre")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\LivreRepository")
 */
class Livre
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
     * @ORM\Column(name="nom", type="string", length=255)
     */
    private $nom;

    /**
     * @var int
     *
     * @ORM\ManyToOne(targetEntity="Genre", inversedBy="livres")
     * @ORM\JoinColumn(name="genre_id", referencedColumnName="id")
     */
    private $genre;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Livre
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set genre
     *
     * @param integer $genre
     *
     * @return Livre
     */
    public function setGenre($genre)
    {
        $this->genre = $genre;

        return $this;
    }

    /**
     * Get genre
     *
     * @return int
     */
    public function getGenre()
    {
        return $this->genre;
    }
}

