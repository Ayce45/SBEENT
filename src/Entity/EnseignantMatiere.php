<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * EnseignantMatiere
 *
 * @ORM\Table(name="enseignant_matiere", indexes={@ORM\Index(name="id_Matiere", columns={"id_Matiere"}), @ORM\Index(name="id_Enseignant", columns={"id_Enseignant"})})
 * @ORM\Entity
 */
class EnseignantMatiere
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Enseignant
     *
     * @ORM\ManyToOne(targetEntity="Enseignant")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Enseignant", referencedColumnName="id")
     * })
     */
    private $idEnseignant;

    /**
     * @var \Matiere
     *
     * @ORM\ManyToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Matiere", referencedColumnName="id")
     * })
     */
    private $idMatiere;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdEnseignant(): ?Enseignant
    {
        return $this->idEnseignant;
    }

    public function setIdEnseignant(?Enseignant $idEnseignant): self
    {
        $this->idEnseignant = $idEnseignant;

        return $this;
    }

    public function getIdMatiere(): ?Matiere
    {
        return $this->idMatiere;
    }

    public function setIdMatiere(?Matiere $idMatiere): self
    {
        $this->idMatiere = $idMatiere;

        return $this;
    }


}
