<?php

namespace App\Entity;

use DateTime;

class Evenement extends Model
{
  protected int $id = 0;
  protected int $categorie = 0;
  protected string $titre = "";
  protected int $participant  = 0;
  protected int $participantMax = 0;
  protected int $prix = 0 ;
  protected string $dateDebut;
  protected string $dateFin;
  protected string $adresse = "";
  protected string $description = "";
  protected string $accroche = "";
  protected string $image;
  protected int $createur = 0;


    const TABLE_NAME = 'Evenement';
    const PRIMARY_FIELD_NAME = 'id';

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

    public function getDateDebut(): string
    {
        return $this->dateDebut;
    }

    public function setDateDebut(DateTime $dateDebut): self
    {
        $this->dateDebut = $dateDebut;
        return $this;
    }

    public function getDateFin(): string
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



  /**
   * Get the value of participant
   */ 
  public function getParticipant()
  {
    return $this->participant;
  }

  /**
   * Set the value of participant
   *
   * @return  self
   */ 
  public function setParticipant($participant)
  {
    $this->participant = $participant;

    return $this;
  }

  /**
   * Get the value of participantMax
   */ 
  public function getParticipantMax()
  {
    return $this->participantMax;
  }

  /**
   * Set the value of participantMax
   *
   * @return  self
   */ 
  public function setParticipantMax($participantMax)
  {
    $this->participantMax = $participantMax;

    return $this;
  }

  /**
   * Get the value of accroche
   */ 
  public function getAccroche()
  {
    return $this->accroche;
  }

  /**
   * Set the value of accroche
   *
   * @return  self
   */ 
  public function setAccroche($accroche)
  {
    $this->accroche = $accroche;

    return $this;
  }

  /**
   * Get the value of categorie
   */ 
  public function getCategorie()
  {
    return $this->categorie;
  }

  /**
   * Set the value of categorie
   *
   * @return  self
   */ 
  public function setCategorie($categorie)
  {
    $this->categorie = $categorie;

    return $this;
  }

  /**
   * Get the value of createur
   */ 
  public function getCreateur()
  {
    return $this->createur;
  }

  /**
   * Set the value of createur
   *
   * @return  self
   */ 
  public function setCreateur($createur)
  {
    $this->createur = $createur;

    return $this;
  }
}
