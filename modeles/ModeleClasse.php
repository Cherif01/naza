<?php

namespace App\modeles;

class ModeleClasse
{
    static function getone($id, $table)
    {
        global $connect;
        $req = $connect->query("SELECT * FROM " . $table . " WHERE id=" . $id);
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

    static function delete($id, $table)
    {
        global $connect;
        $connect->query("DELETE FROM " . $table . " WHERE id=" . $id);
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
        $req = $connect->prepare("SELECT * FROM " . $table . " WHERE " . $champ1 . "= ? AND ". $champ2."= ?");
        $req->execute([$value1, $value2]);
        $result = $req->fetch();
        return $result;
    }

    public static function add($table, $post): void
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
    }


    public static function update($table, $post, $id): void
    {
        $dat = [];
        $names = "";
        foreach ($post as $p => $v) {
            array_push($dat, $v);
            $names .= $p . "=?,";
        }
        array_push($dat, $id);
        $names = "UPDATE " . $table . " SET " . substr($names, 0, -1) . "WHERE id=?";
        global $connect;
        $req = $connect->prepare($names);
        $req->execute($dat);
    }
}
