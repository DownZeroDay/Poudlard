<?php

namespace App\Config;

use PDO;
use PDOException;

class PdoConnection
{
    private PDO $pdoConnection;

    /**
     * Initialise la connnection avec la BDD
     */
    public function init()
    {
        $this->pdoConnection = new PDO(
            "mysql:host=" . $_ENV['DB_HOST'] . ":" . $_ENV['DB_PORT'] . ";dbname=" . $_ENV['DB_NAME'] . ";charset=utf8mb4",
            $_ENV['DB_USER'],
            $_ENV['DB_PASSWORD']
        );

        if ($_ENV['APP_ENV'] === 'dev') {
            $this->pdoConnection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
    }

    /**
     * Retourne l'objet PDO
     */
    public function getPdoConnection(): PDO
    {
        return $this->pdoConnection;
    }

    /**
     * Execute la requete
     *
     * @param   string  $query  SQL Query
     * @return bool
     * @throws PDOException
     */
    public function query_noresult($query)
    {
        if (!$this->pdoConnection) self::init();

        try {
            $result = $this->pdoConnection->query($query);
            return $result !== FALSE;
        } catch (PDOException $e) {
            static::sql_error_handler($e, $query);
            return false;
        }
    }

    /**
     * Execute la requete et retourne la ligne resultat sous forme de tableau associatif
     *
     * @param   string  $query  SQL Query
     * @return  array   Tableau associatif
     * @throws PDOException
     */
    public function query_one($query)
    {
        if (!$this->pdoConnection) self::init();

        try {
            $result = $this->pdoConnection->query($query);
            $data = $result->fetch(PDO::FETCH_ASSOC);

            return $data;
        } catch (PDOException $e) {
            static::sql_error_handler($e, $query);
            return false;
        }
    }

    /**
     * Execute la requete et retourne les lignes resultats sous forme de tableau associatif
     *
     * @param   string  $query  SQL Query
     * @return  array   Tableau associatif
     * @throws PDOException
     */
    public function query_multi($query)
    {
        if (!$this->pdoConnection) self::init();

        try {
            $result = $this->pdoConnection->query($query);
            $data = $result->fetchAll(PDO::FETCH_ASSOC);

            return $data;
        } catch (PDOException $e) {
            static::sql_error_handler($e, $query);
            return false;
        }
    }

    /**
     * Retourne le contenu de la requete
     *
     * @param array $attribut Tableau associatifs contenant le nom des attributs et leurs valeurs
     * @param array $champsNonEnregistres Tableau contenant les noms de attributs à ne pas traiter
     * @return array Avec les 3 cles [columns_values, columns, values] selon ce que doit contenir la chaine
     */
    public function makeRequestVal($attributs, $champsNonEnregistres = array())
    {
        $contenuRequete['columns_values'] = "";
        $contenuRequete['columns'] = "";
        $contenuRequete['values'] = "";
        foreach ($attributs as $nom => $valeur) {
            if (!array_key_exists($nom, $champsNonEnregistres)) {
                if (($valeur !== "" && $valeur !== NULL) || $valeur === 0) {
                    $contenuRequete['columns_values'] .= " ," . $nom . "=" . $this->quote($valeur) . "";
                    $contenuRequete['values'] .= ' ,' . $this->quote($valeur) . '';
                } else {
                    $contenuRequete['columns_values'] .= " ," . $nom . "=NULL";
                    $contenuRequete['values'] .= ' , NULL';
                }
                $contenuRequete['columns'] .= ' ,' . $nom;
            }
        }
        // on enlève l'espace et la virgule du début
        $contenuRequete['columns_values'] = mb_substr($contenuRequete['columns_values'], 2);
        $contenuRequete['columns'] = mb_substr($contenuRequete['columns'], 2);
        $contenuRequete['values'] = mb_substr($contenuRequete['values'], 2);

        return $contenuRequete;
    }

    /**
     * Retourne la valeur avec PDO::quote appliqué
     * @param string $string Valeur à mettre entre quote pour insertion en BDD
     * @return string Valeur entre quote
     */
    public function quote($string)
    {
        if (empty($this->pdoConnection)) self::init();
        return $this->pdoConnection->quote($string);
    }

    public static function sql_error_handler($e, $sql)
    {
        trigger_error(print_r($e, true));
        $GLOBALS['errors']['SQL'][] = array($e->getCode(), $e->getMessage(), $e->getFile(), $sql);
    }
}
