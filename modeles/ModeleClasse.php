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

        // Execute the query
        $stmt = $connect->prepare($sql);
        $stmt->execute($values);
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
        return $result;
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
