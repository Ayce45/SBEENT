<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MatiereSemestre
 *
 * @ORM\Table(name="matiere_semestre", indexes={@ORM\Index(name="Matiere_Semestre_Filiere1_FK", columns={"id_Filiere"}), @ORM\Index(name="Matiere_Semestre_Matiere_FK", columns={"id_Matiere"}), @ORM\Index(name="Matiere_Semestre_Semestre0_FK", columns={"id_Semestre"}), @ORM\Index(name="Matiere_Semestre_Type2_FK", columns={"id_Type"})})
 * @ORM\Entity
 */
class MatiereSemestre
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
     * @var int
     *
     * @ORM\Column(name="heure", type="integer", nullable=false)
     */
    private $heure;

    /**
     * @var \Filiere
     *
     * @ORM\ManyToOne(targetEntity="Filiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Filiere", referencedColumnName="id", onDelete="set null")
     * })
     */
    private $idFiliere;

    /**
     * @var \Matiere
     *
     * @ORM\ManyToOne(targetEntity="Matiere")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Matiere", referencedColumnName="id", onDelete="set null")
     * })
     */
    private $idMatiere;

    /**
     * @var \Semestre
     *
     * @ORM\ManyToOne(targetEntity="Semestre")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Semestre", referencedColumnName="id", onDelete="set null")
     * })
     */
    private $idSemestre;

    /**
     * @var \Type
     *
     * @ORM\ManyToOne(targetEntity="Type")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="id_Type", referencedColumnName="id", onDelete="set null")
     * })
     */
    private $idType;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getHeure(): ?int
    {
        return $this->heure;
    }

    public function setHeure(int $heure): self
    {
        $this->heure = $heure;

        return $this;
    }

    public function getIdFiliere(): ?Filiere
    {
        return $this->idFiliere;
    }

    public function setIdFiliere(?Filiere $idFiliere): self
    {
        $this->idFiliere = $idFiliere;

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

    public function getIdSemestre(): ?Semestre
    {
        return $this->idSemestre;
    }

    public function setIdSemestre(?Semestre $idSemestre): self
    {
        $this->idSemestre = $idSemestre;

        return $this;
    }

    public function getIdType(): ?Type
    {
        return $this->idType;
    }

    public function setIdType(?Type $idType): self
    {
        $this->idType = $idType;

        return $this;
    }


}
