<?Php 
//fonction pour concatener le salt au mdp
function addSalt($passwordToSalt){
    $salt="unPeuDeSel123!";
    echo"<h4>Le salt est : $salt</h4>";
    $saltedPassword=$salt.$passwordToSalt.$salt;
    return $saltedPassword;
}

//fonction pour chiffrer/encoder le mdp
function encodePwd($saltedPassword){
    $encodePassword=sha1($saltedPassword);
    return $encodePassword;
}


?>