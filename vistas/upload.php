<?php
function validar($file){
    if ($file["user-file"]["type"] !== "image/jpeg") {
        return false;
    }
    if ($file["user-file"]["size"] > 600000){
        return false;
    }
    return true;
}
if (validar($_FILES)){
    $path = 'img/';
    $file = $path.basename($_FILES['user-file']['name']);
    if (move_uploaded_file($_FILES['user-file']['tmp_name'], $file)){
        header('location: concepto.php');
    }
}else{
    echo "Error";
}
?>