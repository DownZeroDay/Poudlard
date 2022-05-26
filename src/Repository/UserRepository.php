<?php
namespace App\Repository;

use App\Entity\User;

final class UserRepository extends AbstractRepository
{
  public function userExist($id)
  {
    if (empty($id) && $id != 0) return false;
    $user = new User($id);
    $user = $user->get();
    return !empty($user['id']) ?  true : false;
  }
}
