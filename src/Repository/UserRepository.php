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
    $stmt = $this->pdo->prepare("INSERT INTO users (`name`, firstName, username, `password`, email, birthDate) VALUES (:name, :firstName, :username, :password, :email, :birthDate)");
    
    return $stmt->execute([
      'name' => $user->getName(),
      'firstName' => $user->getFirstName(),
      'username' => $user->getUsername(),
      'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
      'email' => $user->getEmail(),
      'birthDate' => $user->getBirthDate()->format('Y-m-d')
    ]);
  }

  public function userExist()
  {
    return $this->pdo->prepare('SELECT username, password FROM ' . self::TABLE .' WHERE username = ? ');
  }
}
