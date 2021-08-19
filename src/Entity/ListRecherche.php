<?php

namespace App\Entity;

class ListRecherche
{
    private $nom;

    private $dateDebut;

    private $dateFin;

    private $sortiePassee;

    private $sortieInscrit;

    private $sortieNonInscrit;

    private $sortieOrganisateur;

    private $campus;

    /**
     * @return mixed
     */
    public function getNom(): ?string
    {
        return $this->nom;
    }

    /**
     * @param mixed $nom
     */
    public function setNom($nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed
     */
    public function getDateDebut(): ?\DateTimeInterface
    {
        return $this->dateDebut;
    }

    /**
     * @param mixed $dateDebut
     */
    public function setDateDebut($dateDebut): void
    {
        $this->dateDebut = $dateDebut;
    }

    /**
     * @return mixed
     */
    public function getDateFin(): ?\DateTimeInterface
    {
        return $this->dateFin;
    }

    /**
     * @param mixed $dateFin
     */
    public function setDateFin($dateFin): void
    {
        $this->dateFin = $dateFin;
    }

    /**
     * @return mixed
     */
    public function getSortiePassee(): bool
    {
        return $this->sortiePassee;
    }

    /**
     * @param mixed $sortiePassee
     */
    public function setSortiePassee($sortiePassee): void
    {
        $this->sortiePassee = $sortiePassee;
    }

    /**
     * @return mixed
     */
    public function getSortieInscrit(): bool
    {
        return $this->sortieInscrit;
    }

    /**
     * @param mixed $sortieInscrit
     */
    public function setSortieInscrit($sortieInscrit): void
    {
        $this->sortieInscrit = $sortieInscrit;
    }

    /**
     * @return mixed
     */
    public function getSortieNonInscrit(): bool
    {
        return $this->sortieNonInscrit;
    }

    /**
     * @param mixed $sortieNonInscrit
     */
    public function setSortieNonInscrit($sortieNonInscrit): void
    {
        $this->sortieNonInscrit = $sortieNonInscrit;
    }

    /**
     * @return mixed
     */
    public function getSortieOrganisateur(): bool
    {
        return $this->sortieOrganisateur;
    }

    /**
     * @param mixed $sortieOrganisateur
     */
    public function setSortieOrganisateur($sortieOrganisateur): void
    {
        $this->sortieOrganisateur = $sortieOrganisateur;
    }

    /**
     * @return Campus
     */
    public function getCampus(): ?Campus
    {
        return $this->campus;
    }

    /**
     * @param mixed $campus
     */
    public function setCampus($campus): void
    {
        $this->campus = $campus;
    }

    public function __toString()
    {
        return '';
    }
}