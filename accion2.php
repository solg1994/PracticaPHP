<?php
//variables que vienen del html
$opcion_valor=$_POST['selCombo'];
//funcion que de acuerdo a lo que llega actua
function callAPI($method, $url, $data = false)
{
    $curl = curl_init();
    switch ($method)
    {
        case "POST":
            curl_setopt($curl, CURLOPT_POST, 1);
            convierte('data');
            if ($data)
                curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            break;
        case "PUT":
            curl_setopt($curl, CURLOPT_PUT, 1);
            break;
        default:
            if ($data)
                $url = sprintf("%s?%s", $url, http_build_query($data));
    }
    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);

    return $result;
}
//preparo la url para que el servidor hago un get al otro servidor
$url= (string)("http://api.fixer.io/latest?symbols=");
$url2=(string)$opcion_valor;
//print_r ("Hola elegiste una opcion del combox");
//print_r ($url2);
$urlcompleta = $url . $url2;
//print_r ($urlcompleta);
$result = json_decode(callAPI("GET",$urlcompleta));
//Imprimo el valor que ingreso
foreach($result as $elemento){
    foreach ($elemento as $key => $value){
      //con " <br/>" obtengo un salto de linea
        echo "El equivalente a EUR es: "." <br/>";
        echo $key . ": " . $value;
    }
}

?>
