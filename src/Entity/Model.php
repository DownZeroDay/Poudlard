<?php

namespace App\Entity;

use App\Config\PdoConnection;

class Model
{
    protected $from_db = FALSE;
    protected $fields_to_update = array();
    protected $pdoConnect = 0;

    const TABLE_NAME = 'undefined';
    const PRIMARY_FIELD_NAME = 'undefined';

    /**
     * @param mixed $primary_field Clé primaire de la table cible
     */
    public function __construct($primary_field = NULL)
    {
        $this->pdoConnect = new PdoConnection();
        if (!empty($primary_field)) {
            $query = "SELECT * FROM " . static::TABLE_NAME . " WHERE " . static::PRIMARY_FIELD_NAME . " = " . $this->pdoConnect->quote($primary_field);
            $resultat = $this->pdoConnect->query_one($query);
            if ($resultat) {
                $this->initialiser($resultat);
                $this->{static::PRIMARY_FIELD_NAME} = $resultat[static::PRIMARY_FIELD_NAME];
                $this->from_db = TRUE;
                $this->fields_to_update = array();
            }
        }
    }

    /**
     * Retourne les valeurs de l'objet 
     *
     * @return 	array	les valeurs
     * @access  public
     */
    public function get()
    {
        $to_return = get_object_vars($this);
        unset($to_return['from_db']);
        unset($to_return['fields_to_update']);
        return $to_return;
    }

    /**
     * Initialise les attributs de l'objet 
     *
     * @param  array	$enregistrement		Tableau contenant les valeurs
     * @access  public
     */
    public function initialiser($enregistrement)
    {
        foreach ($enregistrement as $nomChamp => $valeur) {
            if (property_exists($this, $nomChamp)) {
                $this->fields_to_update[$nomChamp] = 0;
                $this->$nomChamp = $valeur;
            }
        }
    }

    public function enregistrer() : bool
    {
        $this->pdoConnect = new PdoConnection();
        $attributs = get_object_vars($this);
        if (!empty($this->{static::PRIMARY_FIELD_NAME}) || $this->{static::PRIMARY_FIELD_NAME} === 0) {
            $champsNonEnregistres = !empty($this->fields_to_update) ? array_diff_key($attributs, $this->fields_to_update) : array();
            $contenuRequete = $this->pdoConnect->makeRequestVal($attributs, $champsNonEnregistres);

            if ($this->from_db) {
                $requete = ' UPDATE ' . static::TABLE_NAME . ' SET ' . $contenuRequete['columns_values'] . ' WHERE ' . static::PRIMARY_FIELD_NAME . '=' . $this->pdoConnect->quote($this->{static::PRIMARY_FIELD_NAME}) . ';';
            } else {
                $requete = ' INSERT INTO ' . static::TABLE_NAME . ' (' . $contenuRequete['columns'] . ') VALUES (' . $contenuRequete['values'] . ');';
                $this->from_db = TRUE;
            }
            $this->fields_to_update = array();
            return $this->pdoConnect->query_noresult($requete);
        }
    }
}