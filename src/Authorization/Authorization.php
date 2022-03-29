<? 
namespace App\Authorization;

use App\Repository\DroitRepository;
use App\Repository\UserRepository;
use App\Session\Session;
use App\Entity\Droit;

class Authorization
{
    private array $idUser;
    private Session $session;
    private UserRepository $userRepository;
    private DroitRepository $droitRepository;

    //Droit Object 
    private Droit $admin;
    private Droit $bde;
    private Droit $student;

    public function __construct(Session $session,UserRepository $userRepository,DroitRepository $droitRepository){
        $this->session = $session;
        $this->userRepository = $userRepository;
        $this->droitRepository = $droitRepository;

        $this->admin = $droitRepository->getDroitById(2);
        $this->bde = $droitRepository->getDroitById(1);
        $this->student = $droitRepository->getDroitById(0);
    }


    public function authorize(){
       
    }


    private function getDroitUser(){
        //get User
        $this->idUser = $this->session->get('user','');
        if(!empty($this->idUser))
        {
            return $this->userRepository->getUserbyId($this->idUser)->getIdDroit();

        } 
    }








}
?>