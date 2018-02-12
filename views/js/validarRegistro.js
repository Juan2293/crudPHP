  //VALIDAR REGISTRO

  function validarRegistro() {

      var usuario = document.querySelector("#usuarioRegistro").value;
      var password = document.querySelector("#passwordRegistro").value;
      var email = document.querySelector("#emailRegistro").value;
      var terminos = document.querySelector("#terminos").checked;

      //que solo acepte este tipos de caracteres.
      var caracteres_especiales = /^[a-zA-Z0-9]*$/

      if (usuario != "") {

          if (usuario.length > 6) {
              document.querySelector("label[for='usuarioRegistro']").innerHTML += "<br>El usuario debe tener menos de 6 caracteres."
              return false;
          }
          //validar que no tenga caracteres especiales
          if (!caracteres_especiales.test(usuario)) {
              document.querySelector("label[for='usuarioRegistro']").innerHTML += "<br>No escriba caracteres especiales"
              return false;
          }

      }

      if (password != "") {

          if (password.length < 6) {
              document.querySelector("label[for='passwordRegistro']").innerHTML += "<br>El password debe al menos de 6 caracteres."
              return false;
          }
          //validar que no tenga caracteres especiales
          if (!caracteres_especiales.test(password)) {
              document.querySelector("label[for='passwordRegistro']").innerHTML += "<br>No escriba caracteres especiales";
              return false;
          }

      }

      if (email != "") {

          var validar_email = /^[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$/;
          //validar que no tenga caracteres especiales
          if (!caracteres_especiales.test(password)) {
              document.querySelector("label[for='emailRegistro']").innerHTML += "<br>Escriba correctamente el email";
              return false;
          }
      }

      if (!terminos) {

          document.querySelector("form").innerHTML += "<br>Acepte los terminos y condiciones para registrarse";

          document.querySelector("#usuarioRegistro").value = usuario;
          document.querySelector("#passwordRegistro").value = password;
          document.querySelector("#emailRegistro").value = email;
          return false;
      }


      return true;

  }

  //fin validar registro