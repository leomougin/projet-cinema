<?php

function convertirMinutesEnHeures($duree){
   if($duree<60){
       return $duree;
   }else{
       $heures= floor( $duree / 60);
       $minutes = $duree % 60;
       if($minutes<10){
           return $heures."h0".$minutes;
       }
            else{
               return ($heures."h".$minutes);

           }
       }
}
function afficheDateFr($date){
    $format_us = $date;
    $format_fr = implode('/',array_reverse  (explode('-',$format_us)));
    return  $format_fr;
}

function afficheDateAnnee($date){
    list($annee,$jour,$mois) = explode('-', $date);
    echo $annee;
}

