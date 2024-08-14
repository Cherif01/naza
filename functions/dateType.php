<?php


function ObtenirJMA()
{
    // Définir le fuseau horaire GMT+00
    $timezone = new DateTimeZone('GMT');

    // Créer une nouvelle instance de DateTime avec le fuseau horaire défini
    $date = new DateTime('now', $timezone);

    // Formater la date selon votre besoin
    $date_format = $date->format('d/m/Y');

    // Afficher la date
    return $date_format;
}

function convertOnJMA($votre_date)
{
    // Définir le fuseau horaire GMT+00
    $timezone = new DateTimeZone('GMT');

    // Créer une nouvelle instance de DateTime avec le fuseau horaire défini
    $date = new DateTime($votre_date, $timezone);
    //  $date = $votre_date;

    // Formater la date selon votre besoin
    // $date_format = $date->format('d-m-Y');
    $date_format = $date->format('d/m/Y');

    // Afficher la date
    return $date_format;
}


function obtenirJM()
{
    // Définir le fuseau horaire GMT+00
    $timezone = new DateTimeZone('GMT');

    // Créer une nouvelle instance de DateTime avec le fuseau horaire défini
    $date = new DateTime('now', $timezone);

    // Formater la date selon votre besoin
    $date_format = $date->format('d/m');

    // Afficher la date
    return $date_format;
}
function convertJM($votre_date)
{
    // Définir le fuseau horaire GMT+00
    $timezone = new DateTimeZone('GMT');

    // Créer une nouvelle instance de DateTime avec le fuseau horaire défini
    $date = new DateTime($votre_date, $timezone);
    //  $date = $votre_date;

    // Formater la date selon votre besoin
    // $date_format = $date->format('d-m-Y');
    $date_format = $date->format('d/m');

    // Afficher la date
    return $date_format;
}