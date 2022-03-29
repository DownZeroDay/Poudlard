<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use phpDocumentor\Reflection\Types\Boolean;

final class UserRepository extends AbstractRepository
{
  protected const TABLE = 'users';

  public function save(User $user): bool
  {
    $stmt = $this->pdo->prepare("INSERT INTO users (`name`, firstName, username, `password`, email, birthDate, idDroit) VALUES (:name, :firstName, :username, :password, :email, :birthDate, :idDroit)");
    
    return $stmt->execute([
      'name' => $user->getName(),
      'firstName' => $user->getFirstName(),
      'username' => $user->getUsername(),
      'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
      'email' => $user->getEmail(),
      'birthDate' => $user->getBirthDate()->format('Y-m-d'),
      'idDroit' => $user->getIdDroit()
    ]);
  }

  public function getUserbyId($id)
  {
    $stmp = $this->pdo->prepare("SELECT * FROM users WHERE id= :id");
    $stmp->execute(['id'=>$id]);
    $table = $stmp->fetch();
    $user = new User();
    $user->setName($table['name'])
    ->setFirstName($table['firstname'])
    ->setUsername($table['username'])
    ->setPassword($table['password'])
    ->setEmail($table['email'])
    ->setBirthDate($table['birthDate'])
    ->setIdDroit($table['idDroit']);

    return $user;
  }


  public function userExist()
  {
   return $check = $this->pdo->prepare('SELECT username, password FROM users WHERE username = ? ');
    //return $check->execute(array($user->getEmail()));
  }

}
