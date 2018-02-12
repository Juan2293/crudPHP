<?php

    class Conexion
    {

      public static function conectar()
      {

        #dirección de la bd/ usuario / contraseña
        $link = new PDO("mysql:host=localhost;dbname=cursophp","root","");
        #var_dump($link);
        return $link;
      }
    }


 ?>
