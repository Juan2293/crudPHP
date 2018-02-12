<?php

require_once "conexion.php";

#se extiende la clase cuando se requiere manipular los metodos que hay dentro
class Crud extends Conexion {
  #Registro de usuarios
  public static function registroUsuarioModel($datos,$tabla)
  {
    #PREPARA una sentencia SQL para ser ejecutada por el metodo PDO:excecute();
    $stmt = Conexion::conectar()->prepare("INSERT INTO usuarios (usuario, password, email)
    VALUES (:usuario,:password,:email)");

    $stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
    $stmt->bindParam(":password",$datos["password"],PDO::PARAM_STR);
    $stmt->bindParam(":email",$datos["email"],PDO::PARAM_STR);

    if($stmt->execute()){
      return "success";
    }else {
      return "error";
    }
      $stmt->close();

  }

  //LOGIN
  public static  function consultarUsuarioModel($datos, $tabla)
  {
    $stmt = Conexion::conectar()->prepare("Select * From $tabla where usuario = :usuario");
    $stmt->bindParam(":usuario",$datos["usuario"],PDO::PARAM_STR);
    $stmt->execute();

    // trae el resultados
    return $stmt->fetch();
    $stmt->close();
  }

  public static  function intentosUsuarioModel($datos, $tabla){

    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET  intentos = :intentos WHERE usuario = :usuario");
    $stmt->bindParam(":intentos",$datos["actualizarIntentos"],PDO::PARAM_INT);
    $stmt->bindParam(":usuario",$datos["usuarioActual"],PDO::PARAM_STR);

    if ($stmt->execute()) {
      return "success";
    }else {
      return "error";
    }
      $stmt->close();
  }


  public static  function consultarUsuariosModel($tabla)
  {
    $stmt = Conexion::conectar()->prepare("Select * From $tabla");
    $stmt->execute();
    //fetchAll sirve para traer todos los registros de la bd
    return $stmt->fetchAll();
      $stmt->close();
  }

  public static function editarUsuarioModel($id, $tabla)
  {

    $stmt = Conexion::conectar()->prepare("Select * From $tabla where id =:id");
    $stmt->bindParam(":id",$id,PDO::PARAM_INT);
    $stmt->execute();
    //fetchAll sirve para traer todos los registros de la bd
    return $stmt->fetch();

    $stmt->close();



  }


  public static function actualizarUsuarioModel($datos, $tabla){
    $stmt = Conexion::conectar()->prepare("UPDATE $tabla SET usuario=:usuario,password=:password,email=:email
       WHERE id=:id");
    $stmt->bindParam(":id",$datos['id'],PDO::PARAM_INT);
    $stmt->bindParam(":usuario",$datos['usuario'],PDO::PARAM_STR);
    $stmt->bindParam(":password",$datos['password'],PDO::PARAM_STR);
    $stmt->bindParam(":email",$datos['email'],PDO::PARAM_STR);

    if ($stmt->execute()) {
      return "success";
    }else {
      return "error";
    }
      $stmt->close();

  }

  	public static function borrarUsuarioModel($id, $tabla){

        $stmt = Conexion::conectar()->prepare("DELETE FROM $tabla where id=:id ");
        $stmt->bindParam(":id",$id,PDO::PARAM_INT);
        if($stmt->execute()){
          return "success";
        }else {
          return "error";
        }
        $stmt->close();
    }
}
