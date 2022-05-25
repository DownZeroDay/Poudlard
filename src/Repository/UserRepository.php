<?php

namespace App\Repository;

use App\Entity\User;
use Doctrine\ORM\EntityManager;
use phpDocumentor\Reflection\Types\Boolean;
use DateTime;

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

  public function userExist()
  {
    $user = new User(1);
    return new User(1);
   //return $check = $this->pdo->prepare('SELECT email, password FROM utilisateurs WHERE email = ? ');
    //return $check->execute(array($user->getEmail()));
  }

  // public function get($id){
  //   $stmt = $this->pdo->prepare("select * from utilisateurs where id = " . $id);
  //   return $stmt->execute();
  // }

}
