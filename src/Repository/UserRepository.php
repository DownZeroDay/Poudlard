<?php
namespace App\Repository;

use App\Entity\User;

final class UserRepository extends AbstractRepository
{
  protected const TABLE = 'users';

  public function save(User $user): bool
  {
    $stmt = $this->pdo->prepare("INSERT INTO users (`name`, firstName, username, `password`, email, birthDate) VALUES (:name, :firstName, :username, :password, :email, :birthDate)");

    echo $user->getIdDroit();

    $stmt = $this->pdo->prepare("INSERT INTO utilisateurs (`name`, firstName, username, `password`, email, birthDate, idDroit) VALUES (:name, :firstName, :username, :password, :email, :birthDate, :idDroit)");
    
    return $stmt->execute([
      'name' => $user->getName(),
      'firstName' => $user->getFirstName(),
      'username' => $user->getUsername(),
      'password' => password_hash($user->getPassword(), PASSWORD_BCRYPT),
      'email' => $user->getEmail(),
      'birthDate' => $user->getBirthDate(),
      'idDroit' => $user->getIdDroit()
    ]);
  }

  public function userExist($id)
  { 
    if(empty($id) && $id != 0) return false;
    $user = new User($id);
    return !empty($user->id) ?  true : false;
    
  }
}
