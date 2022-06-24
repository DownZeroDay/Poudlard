<?php

namespace App\Entity;

use App\Config\PdoConnection;
use phpDocumentor\Reflection\Types\Array_;

class User extends Model
{
  protected $id = 0;
  protected int $droit = 0;
  protected string $nom = "";
  protected string $prenom = "";
  protected string $dateNaissance= "";
  protected string $email = "";
  protected string $password = "";
  protected string $token = "";
  protected int $idSection = 0;

  const TABLE_NAME = 'utilisateurs';
  const PRIMARY_FIELD_NAME = 'id';

  /**
   * Retourne l'id de l'utilisateur correspondant à l'email
   */
  public function getIdByMail(string $email) : int
  {
    $query = "SELECT id FROM " . static::TABLE_NAME . " WHERE email=" . $this->pdoConnect->quote($email);
    return (($result = $this->pdoConnect->query_one($query))!== false) ? $result['id'] : 0;
  }

  public function deleteById($id)
  {
    $sql = 'DELETE FROM '.self::TABLE_NAME.' WHERE id='.$id;
    return $this->pdoConnect->query_noresult($sql); 
  }

  public function getId(): int
  {
    return $this->id;
  }

  public function getName(): string
  {
    return $this->nom;
  }

  public function setName(string $name): self
  {
    $this->nom = $name;

    return $this;
  }

  public function getFirstName(): string
  {
    return $this->prenom;
  }

  public function setFirstName(string $firstName): self
  {
    $this->prenom = $firstName;

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
    return $this->dateNaissance;
  }

  public function setBirthDate(string $birthDate): self
  {
    $this->dateNaissance = $birthDate;

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

  /**
   * Get the value of token
   */ 
  public function getToken()
  {
    return $this->token;
  }

  /**
   * Set the value of token
   *
   * @return  self
   */ 
  public function setToken($token)
  {
    $this->token = $token;

    return $this;
  }

  /**
   * Get the value of idSection
   */ 
  public function getIdSection()
  {
    return $this->idSection;
  }

  /**
   * Set the value of idSection
   *
   * @return  self
   */ 
  public function setIdSection($idSection)
  {
    $this->idSection = $idSection;

    return $this;
  }
}
