<?php
    //variables para la conexión
    $server = "85.10.205.173:3306";
    $user = "tfg_domhogar";
    $pass = "tfg_domhogar";
    $dataBase = "tfg_domhogar";

    //variables del formulario - texfields
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];


    //función para convertir los values obtenidos de los checkboxes para su envío a la bd
    $chk = null;
    function is_check($chk){
        if ($chk !='ok'){
            return 0;
       }else if($chk == 'ok'){
            return 1;
       }   
    }   
    //variables para los checkbox a las que aplicamos la función para convertirlos
    $decoWifi = is_check($_POST['decoWifi']);
    $wifiSignal = is_check($_POST['wifiSignal']);
    $smartPlugs = is_check($_POST['smartPlugs']);
    $smartBulbs = is_check($_POST['smartBulbs']);
    $wifiCams = is_check($_POST['wifiCams']);

    //crear la conexión 
    $conn = new mysqli ($server, $user, $pass, $dataBase);
    //comprobar la conexión
    if ($conn->connect_error){
        die ("Connection failed: " . $conn->connect_error);
    }

    //montar la sentencia SQL
    $sql = "INSERT INTO CRM (nombre, email, telefono, DecoWifi_pack, Wifi_Signal_Expansion, Smart_Plugs_Pack, Smart_Bulbs_Pack, Wifi_Surveillance_Cameras)
            VALUES ('$name','$email','$phone','$decoWifi','$wifiSignal','$smartPlugs','$smartBulbs','$wifiCams')";       
    
    //ejecutar la sentencia SQL                                
    if ($conn->query($sql) === TRUE) {
        echo '   
    <html lang="en">
    <head>
    <title>DomoHogar</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>
    <body>
    <div class="row align-items-center">
        <div class="col-8 mx-auto animated fadeIn">
            <div class="box">
                <article>
                    <h1 class="display-4 text-center">
                        data successfully sent
                        <br> Return to
                        <a href="index.html">home page</a>
                    </h1>
                </article>
            </div>
        </div>
    </div>
    </body>
    </html> 
        ' ;
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    //cerrar la conexión
    $conn->close();

