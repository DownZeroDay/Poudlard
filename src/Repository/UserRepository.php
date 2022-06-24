<?php
namespace App\Repository;
use App\Entity\User;
use GuzzleHttp\Client as HTTPClient;
use PDO;

final class UserRepository extends AbstractRepository
{
  public function userExist($id)
  {
    if (empty($id) && $id != 0) return false;
    $user = new User($id);
    $user = $user->get();
    return !empty($user['id']) ?  true : false;
  }

  /**
     * Get current profile
     *
     * @return array
     */
    public static function getProfile($login, $mdp)
    {
      //récupération token
      $url = "https://authentication.kordis.fr/oauth/authorize?client_id=skolae-app&response_type=token";
      $client = new HTTPClient();
      $response = $client->request('GET', $url, [
          'auth' => [
              $login,
              $mdp
          ],
          'allow_redirects' => false,
          'http_errors' => false,
          'verify' => false,

      ]);
      $headers = $response->getHeaders();
      if($response->getStatusCode() == 401){
        return false;
      }
      $location = $headers['Location'][0];
      $locationUrl = parse_url($location);
      parse_str($locationUrl['fragment'], $queryParams);

      //récupération infos du profile
      $url = "https://api.kordis.fr/me/profile";
      $curl = curl_init($url);
      $headers = array(
        "Authorization: Bearer " . $queryParams['access_token']
     );
      curl_setopt($curl, CURLOPT_URL, $url);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
      curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false);
      curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
      $resp = curl_exec($curl);
      curl_close($curl);
      return json_decode($resp, true);
    }


    /**
     * Methode qui permet de récupérer tous les membres du bde
     *
     * @param [type] $id
     * @return void
     */
  public function findBy($id)
  {
    $sql = "SELECT * FROM utilisateurs WHERE droit = $id" ;
    $resultat = $this->pdo->query($sql);
    $resultat->execute();
    return $resultat->fetchAll(PDO::FETCH_ASSOC);
  }

   /** Requete qui recupère tous les users*/
   public function findAll()
   {
     $sql = "SELECT utilisateurs.* , droit.id as idDroit , libelle FROM utilisateurs INNER JOIN droit ON droit.id = droit";
     $resultat = $this->pdo->query($sql);
     $resultat->execute();
     return $resultat->fetchAll(PDO::FETCH_ASSOC);
   }

   public function findAllBDE()
   {
     $sql = "SELECT utilisateurs.* , droit.id as idDroit , libelle FROM utilisateurs INNER JOIN droit ON droit.id = droit where droit = 1";
     $resultat = $this->pdo->query($sql);
     $resultat->execute();
     return $resultat->fetchAll(PDO::FETCH_ASSOC);
   }
}