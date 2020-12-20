<?php
session_start();
ini_set('error_reporting', E_ALL);
 error_reporting(E_ALL);
  ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scramble</title>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<form method="post" enctype="multipart/form-data">
<input class="form-control"  name="file" type="file">
<input type="submit" name="submit" value="1st" class="btn-block btn-sm btn-success">
<input type="submit" name="test" value="2nd" class="btn-block btn-sm btn-success">
</form>
</body>
</html>
<?php

if(isset($_POST['submit'])){
	if($_FILES['file']['name']!=''){
    $imagename=$_FILES['file']['name'];
    $tempname=$_FILES['file']['tmp_name'];
    $img = file_get_contents($tempname);
    $string= base64_encode($img);
    // echo $string;
    $myArr = array("name"=> "1.jpg",
    "file"=>$string);
    $myJSON = json_encode($myArr);
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://zqaojd9kpe.execute-api.us-west-2.amazonaws.com/default/save-public-image-return-unique-name");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: image/jpeg; charset=utf-8',
        'x-api-key: cH3iwFj2CZ6NnoetuEA0o8t0WJdSxqfSabpprdOa'));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS,  $myJSON);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, TRUE);
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);
    $response = curl_exec($ch);
    curl_close($ch);
    echo $response.'1st<br>';
    $_SESSION['response'] = $response;
    }
}
 // second
 if(isset($_POST['test'])){
   // echo $_SESSION['response'];
 $ch1 = curl_init();
 curl_setopt($ch1, CURLOPT_URL, "https://62q4u3tifc.execute-api.us-west-2.amazonaws.com/default/Img-results-return-byName");
 curl_setopt($ch1, CURLOPT_HTTPHEADER, array('Content-Type: image/jpeg; charset=utf-8',
     'x-api-key: pGI5WszM0Y1t1FmY35MqW4T4KxTFWa0D1dUL1rhj'));
 curl_setopt($ch1, CURLOPT_RETURNTRANSFER, TRUE);
 curl_setopt($ch1, CURLOPT_HEADER, FALSE);
 curl_setopt($ch1, CURLOPT_POST, TRUE);
 curl_setopt($ch1, CURLOPT_POSTFIELDS, $_SESSION['response']);
 curl_setopt($ch1, CURLOPT_SSL_VERIFYPEER, TRUE);
 curl_setopt($ch1, CURLOPT_TIMEOUT, 30);
 $response1 = curl_exec($ch1);
 curl_close($ch1);
 $result=json_decode($response1);
//  print_r($result->targetname);
$ar= explode(':',$result->targetname);
//  print_r($ar[5]);
 $ari=explode(',',$ar[5]);
// print_r($ari);
foreach($ari as $value){
    //Print the element out.
    echo $value, '<br>';
}


}

?>
