<?php

namespace App\Entity;

use DateTime;

class Evenement
{
  private int $id;
  private string $titre;
  private int $number;
  private int $numberMax;
  private int $prix;
  private DateTime $dateDebut;
  private DateTime $dateFin;
  private string $adresse;
  private string $description;
  private string $image;



    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber(int $number): void
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getNumberMax(): int
    {
        return $this->numberMax;
    }

    /**
     * @param int $numberMax
     */
    public function setNumberMax(int $numberMax): void
    {
        $this->numberMax = $numberMax;
    }

    /**
     * @return int
     */
    public function getPrix(): int
    {
        return $this->prix;
    }

    /**
     * @param int $prix
     */
    public function setPrix(int $prix): void
    {
        $this->prix = $prix;
    }

    public function getDateDebut(): DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(DateTime $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

  
    public function getDateFin(): DateTime
    {
        return $this->dateFin;
    }

   
    public function setDateFin(DateTime $dateFin): self
    {
        $this->dateFin = $dateFin;
        return $this;
    }


    /**
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->adresse;
    }

    /**
     * @param string $adresse
     */
    public function setAdresse(string $adresse): void
    {
        $this->adresse = $adresse;
    }
  

  public function getId(): int
  {
    return $this->id;
  }

  public function getTitre(): string
  {
    return $this->titre;
  }

  public function setTitre(string $titre): self
  {
    $this->titre = $titre;

    return $this;
  }

  public function getDescription(): string
  {
    return $this->description;
  }

  public function setDescription(string $description): self
  {
    $this->description = $description;

    return $this;
  }

  
    public function getImage(): string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
      $this->image = $image;
      return $this;
    }


}
