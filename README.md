# Poudlard

## Clément MARTINET

### Hydratation

#### Modifications sur le fichier PdoConnection :

#### Ajout de méthodes pour faires des requêtes plus facilement :
 - query_one : execute la requête donnée en entrée et retourne une seule ligne de résultat dans un tableau associatif.
 - query_multi : exactement pareil que query_one mais dans ce cas on retourne toutes les lignes de résultat.
 - query_noresult : retourne true ou false selon si la requête s'est executé ou non.
 - makeRequestVal : méthode pour créer les parties de la requête qui sera executé => les différentes valeurs à insérer ou mettre à jour ainsi que les noms des colonnes correspondantes.
 - quote : permet de mettre entre guillements simple la valeur à insérer en base pour éviter tout problème avec les types des variables.
 - sql_error_handler : retourne les erreurs qui surviennent pendant une requête.

#### Modifications sur le fonctionnement des entity à l'instanciation et modification :

Ajout d'un fichier Model qui va être étendu à toutes nos entity :
Le constructeur va prendre en paramètre une valeur ou non, si elle est renseignée une requête va être effectué pour essayer de récupérer l'objet correspondant en base de donnée, 
pour cela il se base sur la constante PRIMARY_FIELD_NAME qui est déclarée dans chaque entity et qui désigne la clé primaire de la table désignée par la constante TABLE_NAME.
Si un objet est récupéré les valeurs sont hydraté à notre objet et nous pouvons dès lors les récupérer via la fonction get() qui va nous permettre de manipuler et afficher les données 
de notre objet car à l'instanciation les valeurs ont les mêmes attributs que la class donc si les attributs sont private ou protected ils ne seront pas accessibles en dehors de la classe.

Ce fichier Model a aussi 2 autres méthodes :
 - Initialiser : permet d'hydrater un objet à partir d'un tableau associatif envoyé en paramètre.
 - Enregistrer : met à jour ou créé une nouvelle entrée dans la base de données à partir de l'objet cible et retourne une query_noresult.

#### Exemples : 

Enregistrement ou mise à jour d'un utilisateur : 
 - Instanciation : $user = new User(), nous avons donc un objet vierge comme nous n'avons renseignés aucune valeur, les valeurs seront donc les valeurs par défaut des différents attributs de l'objet.
 - Ajout des valeurs : $newData = array('nom' => 'Doe', 'prenom' => 'John') et ensuite $user->initialiser($newData), nous avons donc un objet User qui aura un nom et un prénom.
 - Enregistrement en base de donnée : $user->enregistrer(), retourne true ou false si l'enregistrement s'est effectué ou non.
Dans le cas d'une mise à jour il aurait fallu faire exactement la même chose tout en ajoutant l'id de l'utilisateur cible au moment de créer notre utilisateur.

Pour récupérer des données nous ferons quelque chose d'assez similaire : 
 - Instanciation : $userOBJ = new User(1), nous aurons donc un objet User qui aura toutes les valeurs de l'utilisateur ayant comme clé primaire 1.
 - Récupération pour affichage : $user = $userOBJ->get(), nous aurons donc un tableau associatif rassemblant toutes les données de l'utilisateur
Si on veut manipuler des objet on a juste à ajouter "(object)" devant le $userOBJ->get(), nous aurons donc un objet utilisateur qui sera manipulable.

On peut retrouver des situations réelles dans les controller LoginController et RegisterController.

##Alex Robbrecht
## Lansana KEITA
### Inscription 
Dans cette partie du devoir on a opté pour une authentification classique qui nous permet de nous inscrire et ensuite pouvoir se connecter à l'aide des identifiants (email et password)

Pour ce faire, à l'inscription on s'assure que tous les champs du formulaire sont bien renseignés avant de soumettre le formulaire pour le contrôle.

Après la soumission du formulaire, on s'assure que l'adresse email saisie n'est pas déjà dans la table, dans le cas contraire on affiche un message pour informer l'utilisateur.

Pour finaliser l'inscription, on utilise un algorithme pour hacher le mot de passe.
### Connexion 
Pour pouvoir se connecter, l’utilisateur renseigne son adresse email et le mot de passe, si l’un des champs n’est pas correct, on affiche un message d’erreur jusqu’à ce qu’il renseigne les bonnes informations.

Après validation du formulaire de login, il est ensuite redirigé vers une nouvelle page qui contient un QR_code mis en place avec le système google authenticator qui permet de récupérer un code de validation supplémentaire qui change au bout de quelques secondes s’il n’est pas utilisé. 
Après la validation du code, il est redirigé vers la page contact. 

### Amélioration :
google authenticator étant un système de connexion supplémentaire, on peut enregistrer le code en base de données si l’utilisateur vient de s’inscrire. 
