<?php

namespace App\AccessControl;

use App\Repository\DroitRepository;
use App\Repository\UserRepository;
use App\Session\Session;
use App\Entity\Droit;
use App\Entity\User;

class AccessControl
{
    private $idUser;
    private Session $session;
    private UserRepository $userRepository;
    private DroitRepository $droitRepository;

    //Droit Object 
    private Droit $admin;
    private Droit $bde;
    private Droit $student;

    private string $labelUser;

    public function __construct(Session $session, UserRepository $userRepository, DroitRepository $droitRepository)
    {
        $this->session = $session;
        $this->userRepository = $userRepository;
        $this->droitRepository = $droitRepository;

        $this->admin = $droitRepository->getDroitById(3);
        $this->bde = $droitRepository->getDroitById(1);
        $this->student = $droitRepository->getDroitById(2);
    }


    public function isAuthorize($idRight)
    {
        if ($idRight == 0) return true;
        return (!empty($idRight)) && ($idRight == $this->getDroitUser());
    }

    private function getDroitUser()
    {
        //get User
        
        $this->idUser = $this->session->get('id', '');


        if (!empty($this->idUser)) {
            $user = new User($this->idUser);
            $user = $user->get();
            //get Label of The User;
            $this->labelUser = $this->droitRepository->getDroitById($user['droit'])->getLabel();
            return (int)$user['droit'];
        }
    }
    /**
     * Get the value of labelUser
     */
    public function getLabelUser()
    {
        return $this->labelUser ?? '';
    }
/**
     * Get the value of labelUser with id
     */
    public function getLabelUserWithId()
    {
        $id = $this->getDroitUser();
        switch ($id) {
            case 1:
                return $this->bde->getLabel();
                break;
            case 3: 
                return $this->admin->getLabel();
                break;
            default:
                return $this->student->getLabel();
                break;
        }
    }

    /**
     * Get the value of admin
     */
    public function getAdmin()
    {
        return $this->admin;
    }

    /**
     * Get the value of bde
     */
    public function getBde()
    {
        return $this->bde;
    }

    /**
     * Get the value of student
     */
    public function getStudent()
    {
        return $this->student;
    }
}
