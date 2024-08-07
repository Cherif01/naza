<?php

namespace App\modeles;

class ModeleClasse
{
    static function getone($ID, $table, $value)
    {
        global $connect;
        $req = $connect->query("SELECT * FROM " . $table . " WHERE " . $ID . "=" . $value);
        $result = $req->fetch();
        return $result;
    }

    static function getall($table)
    {
        global $connect;
        $req = $connect->query("SELECT * FROM " . $table);
        $result = $req->fetchAll();
        return $result;
    }
    static function getallJoin2($tablepk, $tablefk)
    {
        global $connect;
        $req = $connect->query("SELECT * FROM " . $tablepk . " INNER JOIN " . $tablefk . " WHERE " . $tablepk . ".id=" . $tablefk . ".id" . $tablepk);
        $result = $req->fetchAll();
        return $result;
    }

    static function delete($name, $table, $value)
    {
        global $connect;
        $req = $connect->prepare("DELETE FROM " . $table . " WHERE " . $name . "= ?");
        $req->execute([$value]);
    }

    public static function update($table, $data, $whereColumn, $id): void
    {
        // Prepare the column placeholders
        $columns = [];
        $values = [];
        foreach ($data as $column => $value) {
            $columns[] = "$column = ?";
            $values[] = $value;
        }

        // Add the ID to the values array
        $values[] = $id;

        // Construct the SQL query
        $setClause = implode(", ", $columns);
        $sql = "UPDATE $table SET $setClause WHERE $whereColumn = ?";

        // Execute the query
        global $connect;
        $stmt = $connect->prepare($sql);
        $stmt->execute($values);
    }


    static function getoneByname($name, $table, $value)
    {
        global $connect;
        $req = $connect->prepare("SELECT * FROM " . $table . " WHERE " . $name . "= ?");
        $req->execute([$value]);
        $result = $req->fetch();
        return $result;
    }

    // Se connecter
    static function loginUser($table, $champ1, $value1, $champ2, $value2)
    {
        global $connect;
        $req = $connect->prepare("SELECT * FROM " . $table . " WHERE " . $champ1 . "= ? AND " . $champ2 . "= ?");
        $req->execute([$value1, $value2]);
        $result = $req->fetch();
        return $result;
    }

    public static function add($table, $post)
    {
        $dat = [];
        $names = "";
        foreach ($post as $p => $v) {
            array_push($dat, $v);
            $names .= $p . "=?,";
        }
        $names = "INSERT INTO " . $table . " SET " . substr($names, 0, -1);
        global $connect;
        $req = $connect->prepare($names);
        $req->execute($dat);
        if ($req)
            return true;
    }
}
