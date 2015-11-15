<?php

function translit ($text)

      {

        $rus = array("а","А","б","Б","в","В","г","Г","д","Д","е","Е","ё","Ё","ж", "Ж",  "з","З","и","И","й","Й","к","К","л","Л","м","М","н","Н","о","О","п","П","р","Р", "с","С","т","Т","у","У","ф","Ф","х","Х","ц","Ц","ч", "Ч", "ш", "Ш", "щ",  "Щ", "ъ","Ъ", "ы","Ы","ь","Ь","э","Э","ю", "Ю", "я","Я",'/',' ');

        $angl =array("a","A","b","B","v","V","g","G","d","D","e","E","e","E", "zh","ZH","z","Z","i","I","j","J","k","K","l","L","m","M","n","N","o","O", "p","P","r","R","s","S","t","T","u","U","f","F","h","H","c","C","ch","CH", "sh","SH","sch","SCH","", "", "y","Y","","","e","E","ju","JU","ja","JA",'','');

        $text = str_replace($rus,$angl,$text);

        return $text;

      }
$host = "127.0.0.1";
    $db_name = "campus";
    $login = "root";
    $password = "";
     
    $PDO = new PDO( 'mysql:host='.$host.';dbname='.$db_name, $login, $password );
    
    $PDO->query("SET NAMES 'utf8'");
    $PDO->query("SET CHARACTERS SET 'utf8'");
    $name = $_COOKIE['login'];
    
    if (!file_exists("./uploads/$name")) {
                    mkdir("./uploads/$name", 0700);
                }
$uploaddir = "./uploads/".$name."/";
$filename=basename(str_replace("\\","/",translit($_FILES['datafile']['name'])));
$file = $uploaddir . $filename; 
 
$ext = substr(translit($_FILES['datafile']['name']),strpos(translit($_FILES['datafile']['name']),'.'),strlen(translit($_FILES['datafile']['name']))-1); 
$filetypes = array('.jpg','.gif','.bmp','.png','.JPG','.BMP','.GIF','.PNG','.jpeg','.JPEG');
 
if(!in_array($ext,$filetypes)){
  echo "<p>Данный формат файлов не поддерживается</p>";}
else{ 
  if (move_uploaded_file($_FILES['datafile']['tmp_name'], $file)) { 
    $session = $_COOKIE['login'];
    $result = $PDO->prepare("UPDATE users SET picture= :img WHERE login= :login");
    $result->execute(array(':login' => $session, ':img'=> $file));
    
    echo $file;
  } else {
    echo "error";
  }
}
?>