<?php
$ct_path2file  = $_FILES["pathfile"]["tmp_name"];
$ct_buf        = $_POST["source"]; 
if($ct_buf !='')
{
$data=$ct_buf;    
}
else
{ 
if ($ct_path2file!='')
{
$ct_namefile=$_FILES["pathfile"]["name"];
$data = '';
$f= fopen($ct_path2file,"r");
$i=0;
while (!feof($f))
{
$data .=fgets($f);
}
fclose($f);
}
}
print "<html><head><title>Пример работы интерпретатора МИЛАН</title></head><body>";
require("pole.php");
print "
<form  id=\"sourceform\" name=\"sourceform\" action='milan.php' method=\"post\">
     <table border=0 align=\"center\">
     <tr><td>Исходный код:</td></tr>
     <tr> <td>
     <textarea name=\"source\" width rows=\"20\" cols=\"65\">";       
print $data;
print "
</textarea></td>
<br>
 </tr>
   <tr>
     <td align=\"right\">
        <br>
    <input name=\"send\" type=\"submit\" value=\"Обработать\">
        </td>
       </tr>
       <tr>
       <br>
     </table>
</form>
</table></body></html>";
?>

