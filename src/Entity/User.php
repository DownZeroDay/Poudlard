<?php

namespace App\Entity;

use App\Config\PdoConnection;

class User extends Model
{
  protected $id = 0;
  protected int $droit = 0;
  protected string $nom = '';
  protected string $prenom = '';
  protected string $dateNaissance = '';
  protected string $email = '';
  protected string $password = '';

  const TABLE_NAME = 'utilisateurs';
  const PRIMARY_FIELD_NAME = 'id';

  /**
   * Retourne l'id de l'utilisateur correspondant à l'email
   */
  public function getIdByMail(string $email) : int
  {
    $query = "SELECT id FROM " . static::TABLE_NAME . " WHERE email=" . $this->pdoConnect->quote($email);
    return (($result = $this->pdoConnect->query_one($query)) !== false) ? $result['id'] : 0;
  }

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

  public function getBirthDate(): string
  {
    return $this->birthDate;
  }

  public function setBirthDate(string $birthDate): self
  {
    $this->birthDate = $birthDate;

    return $this;
  }

  /**
   * Get the value of roleId
   */
  public function getIdDroit()
  {
    return $this->idDroit;
  }

  /**
   * Set the value of roleId
   *
   * @return  self
   */
  public function setIdDroit(int $Idrole)
  {
    $this->idDroit = $Idrole;

    return $this;
  }
}
