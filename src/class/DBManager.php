<?php

class DbManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Récupère un enregistrement dans la base de données en fonction de sa Colonne
     * @return object Objet de la classe associée à l'enregistrement
     */
    public function getAll($tableName)
    {
        $stmt = $this->db->prepare("SELECT * FROM $tableName");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function getWhere($tableName, $whereCondition, $where)
    {
        $stmt = $this->db->prepare("SELECT * FROM $tableName WHERE $whereCondition = $where");
        $stmt->execute();
        return $stmt->fetch();
    }

    /**
     * Récupère un enregistrement d'une table en fonction de son identifiant
     * @param int $id Identifiant de l'enregistrement
     * @param string $className Nom de la classe associée à la table
     * @return mixed L'enregistrement sous forme d'objet de la classe donnée
     */
    public function getById($id, $className)
    {
        $tableName = strtolower($className);
        $stmt = $this->db->prepare("SELECT * FROM $tableName WHERE id = :id");
        $stmt->execute(["id" => $id]);
        return $stmt->fetchObject($className);
    }

    /**
     * Récupère un enregistrement d'une table en fonction de son identifiant
     * @param string $tableName Nom de la table
     * @param int $id Identifiant de l'enregistrement
     * @return mixed L'enregistrement sous forme de tableau associatif
     */
    public function getById_basic($tableName, $id)
    {
        $stmt = $this->db->prepare("SELECT * FROM $tableName WHERE id = :id");
        $stmt->execute(["id" => $id]);
        return $stmt->fetch();
    }

    /**
     * Insère un objet enregistrement dans la table correspondante
     * @param object $obj Objet à insérer
     */
    public function insert($obj)
    {
        $tableName = strtolower(get_class($obj));
        $columns = array_keys(get_object_vars($obj));
        $values = array_map(function ($col) use ($obj) {
            return $obj->$col;
        }, $columns);
        $columns = implode(", ", $columns);
        $placeholders = implode(", ", array_fill(0, count($values), "?"));
        $stmt = $this->db->prepare("INSERT INTO $tableName ($columns) VALUES ($placeholders)");
        $stmt->execute($values);
    }

    /**
     * Insère un enregistrement dans une table
     * @param string $tableName Nom de la table
     * @param array $data Données de l'enregistrement à insérer
     */
    public function insert_basic($tableName, $data)
    {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $stmt = $this->db->prepare("INSERT INTO $tableName ($columns) VALUES ($placeholders)");
        $stmt->execute(array_values($data));
    }

    /**
     * Met à jour un objet dans la base de données.
     * @param object $obj L'objet à mettre à jour.
     * @return void
     */
    public function update($obj)
    {
        $tableName = strtolower(get_class($obj));
        $columns = array_keys(get_object_vars($obj));
        $values = array_map(function ($col) use ($obj) {
            return $obj->$col;
        }, $columns);
        $set = implode(", ", array_map(function ($col) {
            return "$col = ?";
        }, $columns));
        $values[] = $obj->id;
        $stmt = $this->db->prepare("UPDATE $tableName SET $set WHERE id = ?");
        $stmt->execute($values);
    }

    /**
     * Supprime un objet de la base de données.
     * @param object $obj L'objet à supprimer.
     * @return void
     */
    public function remove($obj)
    {
        $tableName = strtolower(get_class($obj));
        $stmt = $this->db->prepare("DELETE FROM $tableName WHERE id = ?");
        $stmt->execute([$obj->id]);
    }

    /**
     * Supprime un objet de la base de données en utilisant son ID.
     * @param string $tableName Le nom de la table où l'objet est stocké.
     * @param int $id L'ID de l'objet à supprimer.
     * @return void
     */
    public function removeById($tableName, $id)
    {
        $stmt = $this->db->prepare("DELETE FROM $tableName WHERE id = ?");
        $stmt->execute([$id]);
    }
}