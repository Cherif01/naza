<?php

namespace App\modeles;

class ModeleClasse
{
    static function getone($ID, $table, $value)
    {
        global $connect;
        $ID = preg_replace('/[^a-zA-Z0-9_]/', '', $ID); // Sanitize column name
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $req = $connect->prepare("SELECT * FROM {$table} WHERE {$ID} = ?");
        $req->execute([$value]);
        $result = $req->fetch();
        return $result;
    }
    static function getOneDesc($table)
    {
        global $connect;
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $req = $connect->query("SELECT * FROM {$table} ORDER BY ID DESC LIMIT 1");
        $result = $req->fetch();
        return $result;
    }

    static function getall($table)
    {
        global $connect;
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $req = $connect->query("SELECT * FROM {$table}");
        $result = $req->fetchAll();
        return $result;
    }

    static function getallJoin2($tablepk, $tablefk)
    {
        global $connect;
        $tablepk = preg_replace('/[^a-zA-Z0-9_]/', '', $tablepk); // Sanitize table name
        $tablefk = preg_replace('/[^a-zA-Z0-9_]/', '', $tablefk); // Sanitize table name
        $req = $connect->query("SELECT * FROM {$tablepk} INNER JOIN {$tablefk} ON {$tablepk}.id = {$tablefk}.id{$tablepk}");
        $result = $req->fetchAll();
        return $result;
    }

    static function delete($name, $table, $value)
    {
        global $connect;
        $name = preg_replace('/[^a-zA-Z0-9_]/', '', $name); // Sanitize column name
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $req = $connect->prepare("DELETE FROM {$table} WHERE {$name} = ?");
        $req->execute([$value]);
    }

    public static function updateI($table, $post, $varID, $id): void
    {
        $dat = [];
        $names = "";
        foreach ($post as $p => $v) {
            array_push($dat, $v);
            $names .= $p . "=?,";
        }
        array_push($dat, $id);
        $names = "UPDATE " . $table . " SET " . substr($names, 0, -1) . " WHERE " . $varID . "=?";
        global $connect;
        $req = $connect->prepare($names);
        $req->execute($dat);
    }

    public static function update($table, $data, $whereColumn, $id): void
    {
        global $connect;
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $whereColumn = preg_replace('/[^a-zA-Z0-9_]/', '', $whereColumn); // Sanitize column name

        // Prepare the column placeholders
        $columns = [];
        $values = [];
        foreach ($data as $column => $value) {
            $column = preg_replace('/[^a-zA-Z0-9_]/', '', $column); // Sanitize column name
            $columns[] = "{$column} = ?";
            $values[] = $value;
        }
        // Add the ID to the values array
        $values[] = $id;

        // Construct the SQL query
        $setClause = implode(", ", $columns);
        $sql = "UPDATE {$table} SET {$setClause} WHERE {$whereColumn} = ?";

        try {
            $stmt = $connect->prepare($sql);
            $stmt->execute($values);
            echo "Mise à jour réussie. Lignes affectées: " . $stmt->rowCount();
        } catch (\PDOException $e) {
            die("Erreur lors de la mise à jour : " . $e->getMessage());
        }
    }

    // GeallByName
    static function getallbyNameIntervall($table, $name1, $value1, $name2, $value2)
    {
        global $connect;
        $req = $connect->prepare("SELECT * FROM " . $table . " WHERE " . $name1 . ">= ? AND " . $name2 . "<= ? ");
        $req->execute([$value1, $value2]);
        $result = $req->fetchAll();
        return $result;
    }

    // GeallByName different by clause
    static function getallbyNameDiff($table, $name, $value)
    {
        global $connect;
        $req = $connect->prepare("SELECT * FROM " . $table . " WHERE " . $name . "!= ?");
        $req->execute([$value]);
        $result = $req->fetchAll();
        return $result;
    }


    static function getoneByname($name, $table, $value)
    {
        global $connect;
        $name = preg_replace('/[^a-zA-Z0-9_]/', '', $name); // Sanitize column name
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $req = $connect->prepare("SELECT * FROM {$table} WHERE {$name} = ?");
        $req->execute([$value]);
        $result = $req->fetch();
        return $result;
    }
    static function getAllByName($name, $table, $value)
    {
        global $connect;
        $name = preg_replace('/[^a-zA-Z0-9_]/', '', $name); // Sanitize column name
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $req = $connect->prepare("SELECT * FROM {$table} WHERE {$name} = ?");
        $req->execute([$value]);
        $result = $req->fetchAll();
        return $result;
    }

    // Transaction
    static function verifTransac($table, $champ1, $value1, $champ2, $value2)
    {
        global $connect;
        $champ1 = preg_replace('/[^a-zA-Z0-9_]/', '', $champ1); // Sanitize column names
        $champ2 = preg_replace('/[^a-zA-Z0-9_]/', '', $champ2); // Sanitize column names
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $req = $connect->prepare("SELECT * FROM {$table} WHERE {$champ1} = ? AND {$champ2} = ?");
        $req->execute([$value1, $value2]);
        $result = $req->fetch();
        if (!empty($result)) :
            return ["state" => 1, "info" => $result];
        else :
            return ["state" => 0];
        endif;
    }

    // Se connecter
    static function loginUser($table, $champ1, $value1, $champ2, $value2)
    {
        global $connect;
        $champ1 = preg_replace('/[^a-zA-Z0-9_]/', '', $champ1); // Sanitize column names
        $champ2 = preg_replace('/[^a-zA-Z0-9_]/', '', $champ2); // Sanitize column names
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name
        $req = $connect->prepare("SELECT * FROM {$table} WHERE {$champ1} = ? AND {$champ2} = ?");
        $req->execute([$value1, $value2]);
        $result = $req->fetch();
        if (!empty($result)) :
            return ["state" => 1, "info" => $result];
        else :
            return ["state" => 0];
        endif;
    }

    public static function add($table, $post)
    {
        global $connect;
        $table = preg_replace('/[^a-zA-Z0-9_]/', '', $table); // Sanitize table name

        $dat = [];
        $names = "";
        foreach ($post as $p => $v) {
            $p = preg_replace('/[^a-zA-Z0-9_]/', '', $p); // Sanitize column name
            $dat[] = $v;
            $names .= "{$p} = ?, ";
        }
        $names = "INSERT INTO {$table} SET " . rtrim($names, ', ');

        $req = $connect->prepare($names);
        $req->execute($dat);
        return $req ? true : false;
    }
}
