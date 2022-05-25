<?php
namespace App\AccessControl;

use App\Repository\DroitRepository;
use App\Repository\UserRepository;
use App\Session\Session;
use App\Entity\Droit;

class AccessControl
{
    private int $idUser;
    private Session $session;
    private UserRepository $userRepository;
    private DroitRepository $droitRepository;

    //Droit Object 
    private Droit $admin;
    private Droit $bde;
    private Droit $student;

    private string $labelUser;

    public function __construct(Session $session,UserRepository $userRepository,DroitRepository $droitRepository){
        $this->session = $session;
        $this->userRepository = $userRepository;
        $this->droitRepository = $droitRepository;

        $this->admin = $droitRepository->getDroitById(3);
        $this->bde = $droitRepository->getDroitById(2);
        $this->student = $droitRepository->getDroitById(1);
    }


    public function isAuthorize($idRight){
        if($idRight == 0) return true;
        return (!empty($idRight)) && ($idRight == $this->getDroitUser()); 
    }

    private function getDroitUser(){
        //get User
        $this->idUser = $this->session->get('id','');
        
        if(!empty($this->idUser))
        {
            $tempId = $this->userRepository->getUserbyId($this->idUser)->getIdDroit();
            //get Label of The User;
            $this->labelUser = $this->droitRepository->getDroitById($tempId)->getLabel();
            return $tempId;
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
?>