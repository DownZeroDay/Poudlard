<?php

namespace App\Entity;

class Categorie
{
  private int $id;
  private string $libelle;


  public function getId(): int
  {
    return $this->id;
  }

  public function getLibelle(): string
  {
    return $this->libelle;
  }

  public function setLibelle(string $libelle): self
  {
    $this->libelle = $libelle;

    return $this;
  }
}
