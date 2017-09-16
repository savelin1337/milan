<?php
//Включение файла интерпретатора
require("interpretator.php");

 $ct_buf        = $_POST["source"];               //Получаем переданный исходный код от пользователя
 $ct_pos        = 0;
 $ct_readCount  = 0;                              //Позиция текущего символа
 $ct_readBUF    = Array();

  //определение режима работы интерпретатора
  switch($_POST["mode"]):
    case '1':
          $ct_milanMode = 1;                     //Режим работы - синтаксический анализатор
    break;
    case '2':
           $tmp= $_POST["readbuf"];              //получим данные из скрытого поля с именем "readbuf"
            if($tmp!='')                         //если строка не пустая
            {
               $ct_readBUF = explode('%',$tmp);    //разбиваем строку на элементы разделённые символом '%' и заносим в массив
            }
            $ct_readBUF[]=$_POST["stdin"];       //добавим новое прочитанное число из поля "stdin"  в массив $ct_readBUF
            
           $ct_milanMode = 2;                    //Режим работы - запуск выполнения синтаксического анализатора 
                                                 //совмещенного с интерпретатором с восстановлением считанных пользовательских данных 
    break;
    default:
          $ct_milanMode = 0;                     //Режим работы - лексический анализатор
    endswitch;

 //Функция чтения одного символа из исходного кода программы MILAN
 function Read(&$Input_letter)
 {
   global $ct_buf;
   global $ct_pos;
   if($ct_pos+1<=strlen($ct_buf))                //проверим, не достигнут ли конец разбираемой программы
   {
        $Input_letter = $ct_buf{$ct_pos++};     //прочитаем следующий символ из буфера
        return 1;
   }else
   {
       $Input_letter  = Chr(26);                //Возвратим символ, означающий конец программы на языке МИЛАН
       return 0;
   }
 }
 
 if($ct_milanMode==0)
 {
  $ct_TabLEX_Code_str   = '';     //строковая переменная, используется для хранения кодов из Таблицы лексем 
  $ct_TabLEX_Value_str  = '';    //строковая переменная, используется для хранения значений из Таблицы лексем  
  
  /* Стадия лексического анализа */ 
    Lexical_Analyzer();
    
 }else
 {   //если лексически анализ уже был выполнен, то восстановим данные полученные из скрытых полей на форме
 
 //восстановим Таблицу лексем, используя данные скрытых полей формы: "lex_code" и "lex_value"
    $ct_TabLEX_Code_str   = $_POST["lex_code"];  //получим строковые данные, сохранённые в скрытом поле "lex_code"
    $ct_TabLEX_Value_str  = $_POST["lex_value"]; //получим строковые данные, сохранённые в скрытом поле "lex_value"  
    $ct_tmpcode =  explode('%',$ct_TabLEX_Code_str);  //преобразуем строку $ct_TabLEX_Code_str в массив $ct_tmpcode
    $ct_tmpvalue = explode('%',$ct_TabLEX_Value_str); //преобразуем строку $ct_TabLEX_Value_str в массив $ct_tmpvalue
    
    for ($i=0;$i<count($ct_tmpcode)-1;$i++ ) 
     {
        $tmp = new Element_Lexems; 
        $tmp->Code =$ct_tmpcode[$i];
        $tmp->Value =$ct_tmpvalue[$i];
        $Tab_Lexems[$i+1] = $tmp;
     }
     //востановление таблицы идентификаторов
    $Tab_Identifiers = explode('%','%'.$_POST["tab_ident"]);       
    unset($Tab_Identifiers[0]); //удалить нулевой элемент массива
    //востановление таблицы констант
    $Tab_Constants   = explode('%','%'.$_POST["tab_const"]); 
    unset($Tab_Constants[0]);  //удалить нулевой элемент массива 
 }
 /* Проверка на ошибки, появившиеся в процессе лексического анализа */
 if (($Code_Error==-1)&&($ct_milanMode>0)) 
 {
  /* Стадия синтаксического анализа, совмещенная с интерпретацией */
  Syntactical_Analyzer();

  /* Проверка на ошибки, появившиеся в процессе интерпретации */
  if ($Code_Error>-1)
  {
   Print_Error(2);
  }
 }


?>
