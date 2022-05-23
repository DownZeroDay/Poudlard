<?php

namespace App\Entity;

use DateTime;

class User extends Model
{
  protected int $id;
  protected int $droit;
  protected string $nom;
  protected string $prenom;
  protected string $dateNaissance;
  protected string $email;
  protected string $password;

  const TABLE_NAME = 'utilisateurs';
  const PRIMARY_FIELD_NAME = 'id';

  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): self
  {
    $this->name = $name;

    return $this;
  }

  public function getFirstName(): string
  {
    return $this->firstName;
  }

  public function setFirstName(string $firstName): self
  {
    $this->firstName = $firstName;

    return $this;
  }

  public function getUsername(): string
  {
    return $this->username;
  }

  public function setUsername(string $username): self
  {
    $this->username = $username;

    return $this;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): self
  {
    $this->password = $password;

    return $this;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): self
  {
    $this->email = $email;

    return $this;
  }

  public function getBirthDate(): DateTime
  {
    return $this->birthDate;
  }

  public function setBirthDate(DateTime $birthDate): self
  {
    $this->birthDate = $birthDate;

    return $this;
  }
}
