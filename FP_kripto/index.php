<?php

include "convert.php";
 
?>
 
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
 
<head>
    <title>14.11.7868</title>
	

    <style type="text/css">
    a:link {color: #000000; text-decoration: none}
    a:visited {color: #000000; text-decoration: none}
    a:hover {color: #FF0000; text-decoration: underline}
    </style>
    <script type="text/javascript">
    function SelectAll(id){
        document.getElementById(id).focus();
        document.getElementById(id).select();
    }
    function Info(){
        alert("FINAL PROJECT KRIPTOGRAFI"+'\n\n'+
		"Faisal Achmad Dwi Cahyono	"+'\t\t'+"	14.11.7868"+'\n'+
		"Fransadea					"+'\t\t'+"	14.11.7848"+'\n'+
		"Didik Mardianto			"+'\t\t'+"  14.11.7854"+'\n'+
		"Risqi Ramadhan	 			"+'\t\t'+"	14.11.7813"+'\n'+
		"Yonanda Dwi Pratama		"+'\t\t'+"	14.11.7849"+'\n'+
		"Angga Destri Ulyadi		"+'\t\t'+"	14.11.7847"+'\n'+
		"Arif Apriyatno				"+'\t\t'+"	14.11.7867");
    }
    function InfoCaesar(){
        alert("Key hanya berupa kombinasi angka,"+'\n'+"dan plan text tidak boleh mengandung angka!");
    }
    function InfoVigenere(){
        alert("Key hanya berupa kombinasi kata, tidak boleh mengandung angka,"+'\n'+"dan plan text tidak boleh mengandung angka!");
    }
    </script>
</head>
 
<body>
	<body background = "mungkin.jpg" />
    <center>
    <h2><font color = "white">FINAL PROJECT KRIPTOGRAFI </font> </h2>
    <h4><font color = "white"><a onclick="Info()">Team 3</a></font></h4>
    </center>
    <table width="800" align="center">
    <tr><td width="50%" align="top">
    <fieldset>
	
    <legend><b><font color = "white">Shift Caesar</font></b></legend>
    <form action="" method="post">
    <input type="text" name="key_caesar" id="key_caesar" value="Key" onclick="SelectAll('key_caesar')" />
    <input type="submit" value="?" onclick="InfoCaesar()" /><br/>
    <textarea rows="10" name="plantext_caesar" id="plantext_caesar" cols="50" onclick="SelectAll('plantext_caesar')" >plain text...</textarea><br/>
    <input type="submit" name="encrypt_caesar" value="Encrypt" />
	<input type="submit" name="decrypt_caesar" value="Decrypt" />
	<input type="reset" value="Reset" />
    </form>
    </fieldset>
    </td><td valign="top" colspan="3">
    <fieldset>
    <legend><b><font color = "white">Result</font></b></legend>
    <?php
    //----------------------------------------------------------------//
    // caesar                                                         //
    //----------------------------------------------------------------//
        if((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['encrypt_caesar'])){
            $key=$_POST['key_caesar'];
            $plantext=$_POST['plantext_caesar'];
            $split_key=str_split($key);
            $i=0;
            $split_chr=str_split($plantext);
            while ($key>52){
                $key=$key-52;
            }
            foreach($split_chr as $chr){
                if (char_to_dec($chr)!=null){
                    $split_nmbr[$i]=char_to_dec($chr);
                } else {
                    $split_nmbr[$i]=$chr;
                }
                $i++;
            }
            echo '<textarea rows="10" id="result" cols="50" onclick="SelectAll(\'result\')" >';
            foreach($split_nmbr as $nmbr){
                if (($nmbr+$key)>52){
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char(($nmbr+$key)-52);
                    } else {
                        echo $nmbr;
                    }
                } else {
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char($nmbr+$key);
                    } else {
                        echo $nmbr;
                    }
                }
            }
            echo '</textarea><br/>';
        } else if ((isset($_POST['key_caesar'])) && (isset($_POST['plantext_caesar'])) && isset($_POST['decrypt_caesar'])){
            $key=$_POST['key_caesar'];
            $plantext=$_POST['plantext_caesar'];
            $i=0;
            $split_chr=str_split($plantext);
            while ($key>52){
                $key=$key-52;
            }
            foreach($split_chr as $chr){
                if (char_to_dec($chr)!=null){
                    $split_nmbr[$i]=char_to_dec($chr);
                } else {
                    $split_nmbr[$i]=$chr;
                }
                $i++;
            }
            echo '<textarea rows="10" id="result" cols="50" onclick="SelectAll(\'result\')" >';
            foreach($split_nmbr as $nmbr){
                if (($nmbr-$key)<1){
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char(($nmbr-$key)+52);
                    } else {
                        echo $nmbr;
                    }
                } else {
                    if (dec_to_char($nmbr)!=null){
                        echo dec_to_char($nmbr-$key);
                    } else {
                        echo $nmbr;
                    }
                }
            }
            echo '</textarea><br/>';
             
    //----------------------------------------------------------------//
    // vigenere                                                       //
    //----------------------------------------------------------------//
        } else if ((isset($_POST['key_vigenere'])) && (isset($_POST['plantext_vigenere'])) && (isset($_POST['encrypt_vigenere']))){
            $key=$_POST['key_vigenere'];
            $plantext=$_POST['plantext_vigenere'];
            $len_key=strlen($key);
            $len_plantext=strlen($plantext);
            $split_key=str_split($key);
            $split_plantext=str_split($plantext);
             
            echo '<textarea rows="10" id="result" cols="50" onclick="SelectAll(\'result\')" >';
            $i=0;
            for($j=0;$j<$len_plantext;$j++){
                if ($i==$len_key){
                    $i=0;
                }
                $split_key2[$j]=$split_key[$i];
                $i++;
            }
            for($k=0;$k<$len_plantext;$k++){
                $a=char_to_dec($split_key2[$k]);
                $b=char_to_dec($split_plantext[$k]);
                if (($a && $b)!=null){
                    echo (tabel_vigenere_encrypt($a, $b));
                } else {
                    echo $split_plantext[$k];
                }
            }
            echo '</textarea><br/>';
        } else if ((isset($_POST['key_vigenere'])) && (isset($_POST['plantext_vigenere'])) && (isset($_POST['decrypt_vigenere']))){
            $key=$_POST['key_vigenere'];
            $plantext=$_POST['plantext_vigenere'];
            $len_key=strlen($key);
            $len_plantext=strlen($plantext);
            $split_key=str_split($key);
            $split_plantext=str_split($plantext);
             
            echo '<textarea rows="10" id="result" cols="50" onclick="SelectAll(\'result\')" >';
            $i=0;
            for($j=0;$j<$len_plantext;$j++){
                if ($i==$len_key){
                    $i=0;
                }
                $split_key2[$j]=$split_key[$i];
                $i++;
            }
             
            for($k=0;$k<$len_plantext;$k++){
                $a=char_to_dec($split_key2[$k]);
                $b=char_to_dec($split_plantext[$k]);
                if (($a && $b)!=null){
                    echo (tabel_vigenere_decrypt($b, $a));
                } else {
                    echo $split_plantext[$k];
                }
            }
             
            echo '</textarea><br/>';
 
        } else {
            echo "result here...";
        }
    ?>
    </fieldset>
    </td></tr>
    <tr><td valign="top">
    <fieldset>
    <legend><b><font color = "white">Vigenere</font></b></legend>
    <form action="" method="post">
    <input type="text" name="key_vigenere" id="key_vigenere" value="Key" onclick="SelectAll('key_vigenere')" />
    <input type="submit" value="?" onclick="InfoVigenere()" /><br/>
    <textarea rows="10" name="plantext_vigenere" id="plantext_vigenere" cols="50" onclick="SelectAll('plantext_vigenere')" >plain text...</textarea><br/>
    <input type="submit" name="encrypt_vigenere" value="Encrypt" />
	<input type="submit" name="decrypt_vigenere" value="Decrypt" />
	<input type="reset" value="Reset" />
    </form>
    </fieldset>
    </td></tr>
    <!-- masih dalam pengerjaan :p
    <tr><td valign="top">
    <fieldset>
    <legend><b>Playfair</b></legend>
    <form action="" method="post">
    <input type="text" name="key_playfair" id="key_playfair" value="the key..." onclick="SelectAll('key_playfair')" /><br/>
    <textarea rows="4" name="plantext_playfair" id="plantext_playfair" cols="33" onclick="SelectAll('plantext_playfair')" >plan text...</textarea><br/>
    <input type="submit" name="encrypt_playfair" value="Encrypt" /><input type="submit" name="Decrypt_playfair" value="Decrypt" /><input type="reset" value="Reset" />
    </form>
    </fieldset>
    </td></tr>
    -->
    </table>
</body>
</html>