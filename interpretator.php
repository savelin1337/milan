<?php
/***************************************************************
*******************Интерпретатор языка МИЛАН********************
****************************************************************
****************************************************************
****Трансляция на PHP************студент ВВТ    Рыльков А.В.****
****************************************************************
****Научный руководитель*********к.т.н., доцент Рыбанов А.A.****
****************************************************************
****************************************************************
**********************ВПИ 2010**********************************/

//Описание классов
       /* элемент массива лексем */
      class Element_Lexems
          {
                       /* код лексемы */
                          public $Code = 0 ;

                       /* значение лексемы */
                          public $Value = 0 ;
         }

       /* Элемент таблицы ключевых [зарезервированных] слов */
       class  Element_Key_Words
       {

                           /* Ключевое слово */
                           public  $Key_Word = '';

                        /* Код ключевого слова */
                        public  $Code_Key_Word = 0;

       }

//Описание констант

       /* Количество ключевых слов языка МИЛАН */
       define("MAX_KEY_WORDS",11);

       /* Кода ключевых слов языка МИЛАН */
       define("_BEGIN_",    1);
       define("_DO_",        2);
       define("_ELSE_",        3);
       define("_END_",        4);
       define("_ENDDO_",    5);
       define("_ENDIF_",    6);
       define("_IF_",        7);
       define("_OUTPUT_",    8);
       define("_READ_",        9);
       define("_THEN_",        10);
       define("_WHILE_",    11);

       /* Кода лексем языка МИЛАН */
       define("_SEMICOLON_",12); /* ; */

       define("_RELATION_",13); // операция типа отношение
       /* значения операции типа отношение */
                 define("_EQUAL_",    0); /*   =     */
                 define("_NOTEQUAL_", 1); /*   <>     */
                 define("_GT_",       2); /*   >    */
                 define("_LT_",       3); /*   <    */
                 define("_GE_",       4); /*   >=   */
                 define("_LE_",       5); /*   <=   */

       define("_SUMM_",    14); /* операция типа сложение  */
       /* значения операции типа сложение */
                define("_PLUS_",     0); /*   +   */
                define("_MINUS_",    1); /*   -   */

       define("_MUL_",     15); /* операция типа умножение  */
       /* значения операции типа сложение */
               define("_STAR_",    0); /*   *   */
               define("_SLASH_",   1); /*   /   */

       define("_ASSIGNMENT_",        16);   /* присваивание  */
       define("_LPAREN_",            17);   /*      (        */
       define("_RPAREN_",            18);   /*      )        */
       define("_IDENTIFIER_",        19);   /* идентификатор */
       define("_CONSTANT_",            20);   /*   константа   */


       /* Таблица ключевых [зарезервированных] слов языка МИЛАН     */
       /* Ключевые слова в массиве должны быть упорядочены, т.к.    */
       /* поиск в массиве осуществляется методом "бинарного поиска" */

       $Table_Key_Words = Array();

       function ct_AddElement($Key_Word, $Code_Key_Word)
       {
            $ct_Element                 =   new Element_Key_Words;
            $ct_Element->Key_Word        =    $Key_Word;
            $ct_Element->Code_Key_Word    =    $Code_Key_Word;
           return $ct_Element;
       }
               //создаём новый массив

             $Table_Key_Words[1] = ct_AddElement('BEGIN',    _BEGIN_);
             $Table_Key_Words[2] = ct_AddElement('DO',        _DO_);
             $Table_Key_Words[3] = ct_AddElement('ELSE',    _ELSE_);
             $Table_Key_Words[4] = ct_AddElement('END',        _END_);
             $Table_Key_Words[5] = ct_AddElement('ENDDO',    _ENDDO_);
             $Table_Key_Words[6] = ct_AddElement('ENDIF',    _ENDIF_);
             $Table_Key_Words[7] = ct_AddElement('IF',        _IF_);
             $Table_Key_Words[8] = ct_AddElement('OUTPUT',    _OUTPUT_);
             $Table_Key_Words[9] = ct_AddElement('READ',    _READ_);
             $Table_Key_Words[10]= ct_AddElement('THEN',    _THEN_);
             $Table_Key_Words[11]= ct_AddElement('WHILE',    _WHILE_);


       /* максимально допустимое количество идентификаторов в программе */
       define("MAX_IDENTIFIERS",    15);

       /* максимально допустимое количество констант в программе */
       define("MAX_CONSTANTS",      15);

       /* максимально допустимое количество лексем в программе */
       define("MAX_LEXEMS",         500);

       /* массив сообщений об ошибках в программе на МИЛАНе */
       $Error_Message = Array(
       /*     1      */   'Неизвестный символ в программе.',
       /*     2      */   'Превышение максимального количества идентификаторов.',
       /*     3      */   'Превышение максимального количества констант.',
       /*     4      */   'Переполнение массива лексем.',
       /*     5      */   'Переполнение стека Stek_do.',
       /*     6      */   'Нехватка элементов в стеке Stek_do.',
       /*     7      */   'Неправильное обращение к функции для работы со стеком Stek_do.',
       /*     8      */   'Переполнение стека Stek_if.',
       /*     9      */   'Нехватка элементов в стеке Stek_if.',
       /*    10      */   'Неправильное обращение к функции для работы со стеком Stek_if.',
       /*    11      */   'Несоответствие в операторах WHILE-DO-ENDDO.',
       /*    12      */   'Несоответствие в операторах IF-THEN-ELSE-ENDIF.',
       /*    13      */   'Конструкция <программа>. Нет BEGIN.',
       /*    14      */   'Конструкция <программа>. Нет END.',
       /*    15      */   'Переполнение стека StekIdent.',
       /*    16      */   'Конструкция <оператор>. Неверное присваивание.',
       /*    17      */   'Нехватка элементов в стеке StekRes.',
       /*    18      */   'Нехватка элементов в стеке StekIdent.',
       /*    19      */   'Конструкция <оператор>. Неверный оператор OUTPUT.',
       /*    20      */   'Конструкция <оператор>. Неверный оператор WHILE.',
       /*    21      */   'Конструкция <оператор>. Отсутствует THEN в операторе IF.',
       /*    22      */   'Конструкция <оператор>. Отсутствует ENDIF в операторе IF.',
       /*    23      */   'Конструкция <оператор>. Отсутствует ELSE или ENDIF в операторе IF.',
       /*    24      */   'Конструкция <условие>. Неверная операция отношения.',
       /*    25      */   'Переполнение стека StekRel.',
       /*    26      */   'Нехватка элементов в стеке StekRel.',
       /*    27      */   'Переполнение стека StekRes.',
       /*    28      */   'Нехватка элементов в стеке StekMul.',
       /*    29      */   'Переполнение стека StekMul.',
       /*    30      */   'Деление на ноль.',
       /*    31      */   'Конструкция <множитель>. Нет закрывающей скобки.',
       /*    32      */   'Переполнение стека StekSum.',
       /*    33      */   'Нехватка элементов в стеке StekSum.');

       /* массив лексем */
       $Tab_Lexems      = Array ();

       /* массив идентификаторов */
       $Tab_Identifiers = Array ();

       /* массив констант */
       $Tab_Constants   = Array ();

       /* Имя программы на языке МИЛАН */
       $Input_Programm  =    '';

       /* Входной файл программы на языке МИЛАН */


       /* Входной символ программы на языке МИЛАН */
       $Input_Letter    =    '';

       /* Номер очередного символа в программе */
       $Number_Letter   =    0;

       /* Код ошибки */
       $Code_Error      =    -1 ;

       /* Номер строки и позиции в которой ошибка */
       $Number_String   =     0;
       $Position        =     0;

       /* Номер очередной лексемы в программе */
       $Number_Lexem    =     0;

       /* Сформированная Лексическим Анализатором лексема */
       $Current_Lexem = new Element_Lexems;

       /* Количество лексем в программе */
       $Number_Lexems_Programm     =    0;

       /* Номер очередного идентификатора в программе */
       $Number_Identifiers        =    0;

       /* Номер очередной константы в программе */
       $Number_Constants        =    0;


 /*************************************************************************/
 /* Stek_Integer(...)                                                     */
 /* Функция для работы со стеками типа Integer.                           */
 /* Аргументы:                                                            */
 /*           Operation - код операции ( 0 - инициализация стека;         */
 /*                                      1 - извлечение элемента из стека */
 /*                                          в Element;                   */
 /*                                      2 - добавление элемента          */
 /*                                          в стек Element;              */
 /*           $Current_Stek - массив из 50 элементов ;                     */
 /*           $Top - вершина стека ;                                       */
 /*           $Element - элемент который кладется в стек или в который     */
 /*                     возвращается вершина стека.                       */
 /* Функция возвращает значение TRUE, если операция работы со стеком      */
 /* выполнена успешно, FALSE - в противном случае.                        */
 /*************************************************************************/
 function Stek_Integer( $Operation  ,
                        &$Current_Stek,
                        &$Top,
                        &$Element)
{
  global $Code_Error;

  switch ($Operation):
   /* Инициализация стека */
  Case  0 :
        $Top=0;
        for ($i=1;$i<=50;$i++)
        {
         $Current_Stek[$i]=0;
        }
     break;

   /* Извлечение элемента со стека */
  Case  1 :
        if ($Top<=0)
        {
         return FALSE;
        }
        else
         {
          $Element=$Current_Stek[$Top];
          $Top--;
         }
     break;
   /* Добавление элемента в стек */
  Case  2 :
        if ($Top>=50)
        {
         return FALSE;
        }
        else
         {
          $Top++;
          $Current_Stek[$Top]=$Element;
         }
     break;
   /* Сообщение об ошибке */
   default:

          $Code_Error=4;
          return FALSE;

   endswitch;
   return TRUE;
} /* End Stek_Integer*/

 /*************************************************************************/
 /* Replicate(<ВырC>,<ВырN>)                                              */
 /* Аргументы: <ВырC>, <ВырN>.                                            */
 /* Результат: Функция возвращает символьную строку, полученную           */
 /*            повторением <ВырN> раз строки <ВырC>.                      */
 /*************************************************************************/
 Function Replicate($String_Letter, $Num)
 {
  $Word='';
  for($i=1; $i<=$Num; $i++)
   $Word = $Word . $String_Letter;
  return $Word;
 } /* End Replicate */

 /*************************************************************************/
 /* Space(<ВырN>)                                                         */
 /* Аргументы: <ВырN>.                                                    */
 /* Функция возвращает строку, состоящую из <ВырN> пробелов.              */
 /*************************************************************************/
 Function Space($Num)
 {
  return Replicate(' ',$Num);
 } /* End Space */

 /*************************************************************************/
 /* Print_Error                                                           */
 /* Процедура вывода на экран сообщения об ошибке для                     */
 /* Лексического Анализатора                                              */
 /* Расстановки ссылок                                                    */
 /* Интерпретатора                                                        */
 /*************************************************************************/
 function Print_Error($Variant)
 {
    global $Number_String;
    global $Position;
    global $Number_Lexem;
    global $Code_Error;
    global $Error_Message;
    global $Tab_Lexems;
    global $ct_buf; 
    switch ($Variant)
   {
                Case 1 :
                   print ('<html><head><title>РЕЗУЛЬТАТ РАБОТЫ ЛЕКСИЧЕСКОГО АНАЛИЗАТОРА</title></head><body><br><H2 align="center">РЕЗУЛЬТАТ РАБОТЫ ЛЕКСИЧЕСКОГО АНАЛИЗАТОРА</H2><br><hr><br>
                   <table cellspacing="3" cellpadding="3"  align="center"><tr><td >НАЙДЕНА ОШИБКА: </td><td align="center"><font color="red"> ' . $Error_Message[$Code_Error] . '</font></td></tr>
                   <tr><td> СТРОКА: </td><td align="left"><font color="blue">' . $Number_String . '</font></td></tr>
                   <tr><td> ПОЗИЦИЯ:</td><td align="left"><font color="blue">' . $Position . '</font></td></tr></table>
                   <br><hr><br><div align="center">
                   <form  method="post" action="INTERFACE.php">
                   <input type="submit" value="    ОК    " >
                   <input name="source" type="hidden" value="'.$ct_buf.'">    
                   </form></div></body></html> ');
                    break;

                Case 2 :
                   print ('<html><head><title>РЕЗУЛЬТАТ РАБОТЫ СИНТАКСИЧЕСКОГО АНАЛИЗАТОРА</title></head><body><br><H2 align="center">РЕЗУЛЬТАТ РАБОТЫ СИНТАКСИЧЕСКОГО АНАЛИЗАТОРА</H2><br><hr><br>
                   <table cellspacing="3" cellpadding="3"  align="center"><tr><td >НАЙДЕНА ОШИБКА: </td><td align="center"><font color="red"> ' . $Error_Message[$Code_Error] . '</font></td></tr>
                   <tr><td> ЛЕКСЕМА: </td><td align="left"><font color="blue">' . $Number_Lexem . '</font></td></tr></table>
                   <br><hr><br><div align="center">
                   <form method="post" action="INTERFACE.php">
                   <input type="submit" value="    ОК    ">
                   <input name="source" type="hidden" value="'.$ct_buf.'">    
                   </form></div></body></html> ');
                    break;
   }

} /* End Print_Error */

 /************************************************************************/
  /* Isdigit(<ВырC>)                                                      */
  /* Функция возвращает значение TRUE, если <вырC> начинается с цифры.    */
  /************************************************************************/
  Function Isdigit($Figure)
  {
    $ct_res=preg_match("/[0-9]/i", $Figure{0});
    return $ct_res;
  } /* End Isdigit */

  /************************************************************************/
  /*   Isalpha(<ВырC>)                                                    */
  /*   Функция возвращает значение TRUE, если <вырC> начинается с буквы.  */
  /************************************************************************/
  Function Isalpha($Letter)
  {

   $ct_res=preg_match("/[A-Za-zА-Яа-я]/i", $Letter{0});
   return $ct_res;
  } /* End Isalpha */


 /*************************************************************************/
 /* Lexical_Analyzer                                                      */
 /* Лексический анализатор: Выполняет первую стадию транслятора -         */
 /* лексический анализ. Осуществляет просмотр исходного текста            */
 /* программы на МИЛАНе, распознавание и классификацию лексем.           */
 /* Строит:                                                               */
 /*         массив лексем;                                                */
 /*         массив идентификаторов;                                       */
 /*         массив констант;                                              */
 /* Производит расстановку ссылок для передачи управления.                */
 /* Входные данные: текст с программой на МИЛАНе.                         */
 /* Результат: массив лексем, массив идентификаторов и констант.          */
 /*************************************************************************/
 function Lexical_Analyzer()
 {
  /************************************************************************/
  /* Found_in_Table_Key_Words                                             */
  /* Функция бинарного поиска в таблице ключевых слов                     */
  /* Вход: Word - выражение символьного типа, Code - код найденного       */
  /*       ключевого слова                                                */
  /* Выход: Функция возвращает значение TRUE, если Word ключевое слово, и */
  /*        FALSE - в противном случае. В переменной Code содержится код  */
  /*        ключевого слова, или 0 в противном случае.                    */
  /************************************************************************/
  Function Found_in_Table_Key_Words($Word, &$Code)
  {
   global $Table_Key_Words;
   $k=0;
   $m=1;
   $n=MAX_KEY_WORDS;
   while ($m<=$n):
    $k=intval($m+($n-$m) / 2);                                 
    if ($Word==$Table_Key_Words[$k]->Key_Word)
    {
     $Code=$Table_Key_Words[$k]->Code_Key_Word;
     return TRUE;
    }
    elseif ($Word>$Table_Key_Words[$k]->Key_Word)
    {
      $m=$k+1;
    }
     else
      $n=$k-1;
   endwhile;
   return FALSE;
  }

   /***********************************************************************/
   /* Found_in_Table_Identifiers(<ВырC>)                                  */
   /* Функция для проверки идентификатора в таблице идентификаторов.      */
   /* Аргументы: <вырC>, содержащее имя идентификатора.                   */
   /* Результат: номер идентификатора в таблице идентификаторов           */
   /*            ( 0 - если идентификатор <ВырC> отсутствует в            */
   /*            таблице идентификаторов).                                */
   /***********************************************************************/
   Function Found_in_Table_Identifiers($Identifier)
   {
    global $Tab_Identifiers;
    global $Number_Identifiers;
    for( $i=1;$i<=$Number_Identifiers;$i++)
    {
     if ($Tab_Identifiers[$i]==$Identifier)
             return $i;
    }
     return 0;
   } /* End Found_in_Table_Identifiers */

  /*Функция  Вывода сообщения об ошибке */
  function Print_Error_Message()
   {
       global $Code_Error;
                       if ($Code_Error>-1)
                       {
                        Print_Error(1);
                        return 0;
                       }
//Если ошибок нет, то нормальное завершение лексического анализа
    End_Lexical_Analyzer();                           
   }
   //Функция выхода из Лексического Анализатора
   function End_Lexical_Analyzer()
   {
   global $Number_Lexems_Programm;
   global $Number_Lexem;
   global $Code_Error;
   $Number_Lexems_Programm=$Number_Lexem;

  /* Расстановка ссылок для операторов цикла и развилки */
   Setup_Refference();

  /* Проверка на ошибки, появившиеся в процессе расстановки ссылок */
   if ($Code_Error>-1)
   {
    Print_Error(2);
    return 0;
   }

  /* Печать таблицы массива лексем */
  global $ct_milanMode;
  global $ct_buf;
  if($ct_milanMode==0)
  {
   Print_Tab_Lexems();

  /* Печать таблицы массивов идентификаторов и констант */
   Print_Tab_Identifiers_Constants();

  /* Закрытие файла с программой на языке МИЛАН */
  /* функция y10: нормальное завершение работы лексического анализатора */
  global $Tab_Identifiers;
  global $Tab_Constants;
  global $ct_TabLEX_Value_str;
  global $ct_TabLEX_Code_str; 
  //поля типа hidden используются для сохранения данных полученных в результате работы лексического анализатора $Tab_Constants, $Tab_Identifiers
  print (
  "<br><hr><br><div align=\"center\"><font color=\"blue\"> НОРМАЛЬНОЕ ЗАВЕРШЕНИЕ РАБОТЫ ЛЕКСИЧЕСКОГО АНАЛИЗАТОРА</font><br><br>
  <form  id=\"sourceform\" name=\"sourceform\" action='MILAN.PHP' method=\"post\" >
    <input name=\"source\" type=\"hidden\" value='".$ct_buf."'>                              <!--поле хранит исходный код программы  --> 
    <input name=\"lex_code\" type=\"hidden\" value='".$ct_TabLEX_Code_str."'>                <!--поле хранит значения CODE таблицы лексем  --> 
    <input name=\"lex_value\" type=\"hidden\" value='".$ct_TabLEX_Value_str."'>              <!--поле хранит значения VALUE таблицы лексем  --> 
    <input name=\"tab_ident\" type=\"hidden\" value='" .join('%',$Tab_Identifiers). "'>       <!--поле хранит данные таблицы идентификаторов -->
    <input name=\"tab_const\" type=\"hidden\" value='" .join('%',$Tab_Constants). "'>         <!--поле хранит данные таблицы констант --> 
  <input name=\"next\" type=\"submit\" value=\"Далее\" align=\"center\" size=\"40\">
  <input name=\"mode\" type=\"hidden\" value=\"1\">                                          <!--поле хранит текущий режим работы скрипта -->    
  </form></div>  "
  );
  }
  return 0;
  }


  /************************************************************************/
  /* Letter;                                                              */
  /* Процедура для выделения символов ключевого слова или                 */
  /* идентификатора. Занесение в массив лексем кода и значения             */
  /* лексемы (ключевого слова или идентификатора).                        */
  /* Аргументы: нет аргументов.                                           */
  /* Результат: нет результата.                                           */
  /************************************************************************/
  Function Letter()
  {
  global $Input_Letter;
  global $Current_Lexem;
  global $Number_Identifiers;
  global $Position;
  global $Code_Error;
  global $Tab_Identifiers;
  /* Начало процедуры Letter */

       $Word         = '';
       $Code_Word    = 0;
       $Position_    = 0;

   /* функция у4: накопление символов ключевого слова или идентификатора */
   $Word = $Word . $Input_Letter;

   /* функция у1: прочитать следующий символ */
   Read($Input_Letter);
   $Position_++;

   /* Выделить ключевое слово или идентификатор */
   while ((Isalpha($Input_Letter)) || (Isdigit($Input_Letter))):

    /* функция у4: накопление символов ключевого слова или идентификатора */
    $Word=$Word . $Input_Letter;

    /* функция у1: прочитать следующий символ */
    Read($Input_Letter);
    $Position_++;

   endwhile;

   /* функция у5: проверка на принадлежность */
   /* выделенного слова к ключевым словам    */
   if (Found_in_Table_Key_Words($Word, $Code_Word))
   {

    /* функция у11: формирование лексемы */
    $Current_Lexem->Code        =    $Code_Word;
    $Current_Lexem->Value       =    0;

   }
    /* функция у6: проверка на принадлежность */
    /* выделенного слова к идентификаторам    */
    elseif (Found_in_Table_Identifiers($Word)>0)
    {

     /* функция у11: формирование лексемы */
     $Current_Lexem->Code    =    19;
     $Current_Lexem->Value   =    Found_in_Table_Identifiers($Word);

    }
    elseif ($Number_Identifiers<MAX_IDENTIFIERS)
     {

      /* запись выделенного слова в таблицу идентификаторов */
      $Number_Identifiers++;
      $Tab_Identifiers[$Number_Identifiers]=$Word;

      /* функция у11: формирование лексемы */
      $Current_Lexem->Code=19;
      $Current_Lexem->Value=$Number_Identifiers;

     }
     else
      /* Превышение максимального количества идентификаторов */
      $Code_Error=1;

   if ($Code_Error==-1)
    $Position+=$Position_;
 } /* End Letter */

  /***********************************************************************/
   /* Found_in_Table_Constants(<ВырC>)                                    */
   /* Функция для проверки константы в таблице констант.                  */
   /* Аргументы: <вырC>, содержащее константу.                            */
   /* Результат: номер константы в таблице констант                       */
   /*            ( 0 - если константа <ВырC> отсутствует в таблице        */
   /*            констант).                                               */
   /***********************************************************************/
   Function Found_in_Table_Constants($Constant)         
   {
   //глобальные переменные
    global $Number_Constants;
    global $Constant_Value;
    global $Tab_Constants;

    for($i=1;$i<= $Number_Constants;$i++)
    {

     $Constant_Value=intval($Constant);                     
     if ($Tab_Constants[$i]==$Constant_Value)
      return $i;
    }
    return 0;
   } /* End Found_in_Table_Constants */

  /************************************************************************/
  /* Digit;                                                               */
  /* Процедура для выделения символов константы, проверки в таблице       */
  /* констант и занесения в таблицу.                                      */
  /* Аргументы: нет аргументов.                                           */
  /* Результат: нет результата.                                           */
  /************************************************************************/
  Function Digit()
  {

  /* Начало процедуры Digit */
  //глобальные переменные
   global $Current_Lexem;
   global $Code_Error;
   global $Tab_Constants;
   global $Input_Letter;
   global $Number_Constants;
   //локальные переменные
   $Constant_Value = 0;
   $Word = '';
   /* функция у7: накопление символов константы */
   $Word = $Word . $Input_Letter;
   $Position_=0;
   /* функция у1: прочитать следующий символ */
    Read($Input_Letter);
   $Position_++;

   /* Выделить константу */
   while (Isdigit($Input_Letter)):
    /* функция у7: накопление символов константы */
    $Word=$Word . $Input_Letter;

    /* функция у1: прочитать следующий символ */
    Read($Input_Letter);
    $Position_++;

   endwhile;

   /* функция у8: проверка на принадлежность */
   /* выделенной константы таблице констант  */
   if (Found_in_Table_Constants($Word)>0)
   {
    /* функция у11: формирование лексемы */
    $Current_Lexem->Code=20;
    $Current_Lexem->Value=Found_in_Table_Constants($Word);
   }
   elseif ($Number_Constants<MAX_CONSTANTS)
     {
      /* запись выделенной константы в таблицу констант */
      $Number_Constants++;
      $Constant_Value=intval($Word);                            
      $Tab_Constants[$Number_Constants]=$Constant_Value;

      /* функция у11: формирование лексемы */
      $Current_Lexem->Code=20;
      $Current_Lexem->Value=$Number_Constants;

     }
     else
      /* Превышение максимального количества констант */
      $Code_Error=2;

   global  $Position;
   if ($Code_Error==-1)
    $Position=$Position+$Position_;

    return 0;
  } /* End Digit */

  /************************************************************************/
  /* Setup_Refference                                                     */
  /* Процедура расстановки ссылок:                                        */
  /*                               DO-->ENDDO+1, ENDDO-->WHILE+1          */
  /*                               THEN-->ELSE+1                          */
  /*                               THEN-->ENDIF+1, ELSE-->ENDIF+1         */
  /* Аргументы: Массив лексем.                                            */
  /* Результат: Массив лексем с расставленными ссылками.                  */
  /************************************************************************/
  function Setup_Refference()
  {
     /* функция y0: подготовка (инициализация стеков и переменных),         */
    /* номер очередной лексемы Number_Lexem=1, прочитать лексему с номером */
    /* Number_Lexem                                                        */
    //Глобальные переменные
    global $Number_Lexem;
    global $Tab_Lexems;
    global $Code_Error;
    global $Number_Lexems_Programm;
    //Локальные переменные
    $r=0;
    $s=0;
    $Top_do  = 0;
    $Top_if  = 0;
    $Stek_if = Array();
    $Stek_do = Array();

    $Number_Lexem = 1;
    Stek_Integer(0,$Stek_do,$Top_do,$r);
    Stek_Integer(0,$Stek_if,$Top_if,$s);

    do
    {
     switch($Tab_Lexems[$Number_Lexem]->Code):


              Case   _WHILE_ :

                            /* функция y1: значение $Number_Lexem занести */
                            /* стек $Stek_do ($Number_Lexem-->$Stek_do)     */
                            if (!Stek_Integer(2,$Stek_do,$Top_do,$Number_Lexem))
                             {
                              /* Переполнение стека DO*/
                              $Code_Error=4;
                              return 0;
                             }

                            /* функция y7: $Number_Lexem++, */
                            /* прочитать очередную лексему с номером  $Number_Lexem */  
                            $Number_Lexem++;

                            while ($Tab_Lexems[$Number_Lexem]->Code!=_DO_):

                             /* функция y7: Number_Lexem=Number_Lexem+1, */
                             /* прочитать очередную лексему с номером  $Number_Lexem */
                             $Number_Lexem++;

                             if ($Number_Lexem>$Number_Lexems_Programm)
                             {
                              /* Несоответствие в операторах WHILE-DO-OD */
                              $Code_Error=10;
                              return 0;
                             }

                            endwhile;

                            /* функция y1: значение $Number_Lexem занести */
                            /* стек $Stek_do ($Number_Lexem-->$Stek_do)     */
                            if (!Stek_Integer(2,$Stek_do,$Top_do,$Number_Lexem))
                             {
                              /* Переполнение стека DO */
                              $Code_Error=4;
                              return 0;
                             }

                           break;
               Case  _ENDDO_ :

                            /* функция y2: снять вершину стека $Stek_do в   */
                            /* переменную $s ($s<--$Stek_do), снять вершину   */
                            /* стека $Stek_do в переменную $r ($r<--$Stek_do), */
                            /* значение $r+1 присвоить лексеме              */
                            /* с номером $Number_Lexem [ENDDO-->WHILE+1]    */
                            /* ($Tab_Lexems[$Number_Lexem]->Value=r+1),       */
                            /* значение Number_Lexem+1 присвоить лексеме   */
                            /* с номером s  [DO-->ENDDO+1]                 */
                            /* ($Tab_Lexems[$s]->Value=$Number_Lexem+1.        */
                            if (!Stek_Integer(1,$Stek_do,$Top_do,$s))
                             {
                              /* Нехватка элементов в стеке DO */
                              $Code_Error=5;
                              return 0;
                             }
                            if (!Stek_Integer(1,$Stek_do,$Top_do,$r))
                             {
                              /* Нехватка элементов в стеке DO */
                              $Code_Error=5;
                              return 0;
                             }

                            /* ENDDO-->WHILE+1*/
                            $Tab_Lexems[$Number_Lexem]->Value=$r+1;

                            /* DO-->ENDDO+1 */
                            $Tab_Lexems[$s]->Value=$Number_Lexem+1;

                           break;
               Case  _IF_ :
                            /* функция y7: $Number_Lexem++, */
                            /* прочитать очередную лексему с номером  $Number_Lexem */  
                            $Number_Lexem++;

                            while ($Tab_Lexems[$Number_Lexem]->Code!=_THEN_):
                             /* функция y7: $Number_Lexem++, */
                             /* прочитать очередную лексему с номером  $Number_Lexem */  
                             $Number_Lexem++;

                            if ($Number_Lexem>$Number_Lexems_Programm)
                             {
                              /* Несоответствие  операторах IF-THEN-ELSE-ENDIF */
                              $Code_Error=11;
                              return 0;
                             }

                            endwhile;

                            /* функция y3: значение $Number_Lexem занести */
                            /* стек $Stek_if ($Number_Lexem-->$Stek_if)     */
                            if (!Stek_Integer(2,$Stek_if,$Top_if,$Number_Lexem))
                             {
                              /* Переполнение стека IF */
                              $Code_Error=7;
                              return 0;
                             }
                           break;

               Case   _ELSE_ :

                            /* функция y4: снять вершину стека $Stek_if в   */
                            /* переменную $r ($r<--$Stek_if), присвоить       */
                            /* значение $Number_Lexem+1 лексеме c номером   */
                            /* r [THEN-->ELSE+1]                           */
                            /* ($Tab_Lexems[$r]->Value=$Number_Lexem+1),       */
                            /* занести в $Stek_ if значение Number_Lexem    */
                            /* ($Number_Lexem-->$Stek_if)                    */
                            if (!Stek_Integer(1,$Stek_if,$Top_if,$r))
                             {
                              /* Нехватка элементов в стеке IF */
                              $Code_Error=8;
                              return 0;
                             }

                            /* THEN-->ELSE+1 */
                            $Tab_Lexems[$r]->Value=$Number_Lexem+1;

                            if (!Stek_Integer(2,$Stek_if,$Top_if,$Number_Lexem))
                             {
                              /* Переполнение стека IF */
                              $Code_Error=7;
                              return 0;
                             }
                           break;

              Case  _ENDIF_ :

                            /* функция y5: снять вершину стека $Stek_if в   */
                            /* переменную $r ($r<--$Stek_if), присвоить       */
                            /* значение $Number_Lexem+1 лексеме c номером   */
                            /* $r [THEN-->ENDIF+1, ELSE-->ENDIF+1]          */
                            /* ($Tab_Lexems[$r]->Value=$Number_Lexem+1)        */
                            /* занести в $Stek_ if значение Number_Lexem    */
                            /* ($Number_Lexem-->$Stek_if)                    */
                            if (!Stek_Integer(1,$Stek_if,$Top_if,$r))
                             {
                              /* Нехватка элементов в стеке IF */
                              $Code_Error=8;
                              return 0;
                             }

                            /* THEN-->ENDIF+1, ELSE -->ENDIF+1 */
                            $Tab_Lexems[$r]->Value=$Number_Lexem+1;
                           break;

     endswitch;

     /* функция y7: $Number_Lexem++, */
     /* прочитать очередную лексему с номером    */
     $Number_Lexem++;
    }
    while ($Number_Lexem<=$Number_Lexems_Programm);

    if ($Top_if!=0)
    {
     /* Несоответствие в операторах IF-THEN-ELSE-ENDIF */
     $Code_Error=11;
    }

    if ($Top_do!=0)
    {
     /* Несоответствие в операторах WHILE-DO-OD */
     $Code_Error=10;
    }
   } /* End Setup_Refference */

  /************************************************************************/
  /* Print_Tab_Lexems                                                     */
  /* Процедура печати таблицы массива лексем.                             */
  /* Аргументы: нет аргументов.                                           */
  /* Результат: Высвечивание на экране таблицы.                           */
  /************************************************************************/
   
 Function Print_Tab_Lexems()
 {
       $Number  =   '';
       $Number_ =   '';
       $Zastav  =   '';      /* Шапка таблицы массива лексем */
       $TabLex  =   '';      /* Таблица массива лексем */
       global $Number_Lexems_Programm;
       global $Tab_Lexems;
       global $ct_TabLEX_Code_str;
       global $ct_TabLEX_Value_str;  
     echo '<br><H2> <div align="center">РЕЗУЛЬТАТ РАБОТЫ ЛЕКСИЧЕСКОГО АНАЛИЗАТОРА</div></H2><br><hr><br>';
   /* Начало процедуры Print_Tab_Lexems */
   /* Формирование шапки таблицы массива лексем */
    $Zastav  = '<table border=1 width="450" align="center"><tr><td colspan=19><div align="center">Т А Б Л И Ц А &nbsp; Л Е К С Е М</div></td></tr>';
    $Zastav  .= '<tr><td> Номер </td>';
    $End=intval($Number_Lexems_Programm /10)+1;
     for ($i=0;$i<=9;$i++)
     {
      $Zastav .='<td align="center"> ' . $i . '</td>';
     }
    $Zastav  .= '</tr>';

    /* печать таблицы массива лексем */
     /* Вывод содержимого таблицы */
     for ($i=1; $i<=$End;$i++)
      {
       $ct_Pos=($i-1)*10;
       $TabLex= '<tr><td align="center">'. strval($ct_Pos) . '</td>';
       
       for ($j=0;$j<=9;$j++)
       {
        if ((($i==1) && ($j==0)) || ($Tab_Lexems[$ct_Pos+$j]->Code)=='')
         $TabLex .='<td>&nbsp;</td>';
        else
         {
          $Number = $Tab_Lexems[$ct_Pos+$j]->Code;   
          $Number_= $Tab_Lexems[$ct_Pos+$j]->Value;
          $ct_TabLEX_Code_str.= $Number.'%';        
          $ct_TabLEX_Value_str.= $Number_.'%';
          $TabLex .='<td align="center">' . Space(2-strlen($Number)) . $Number . ',' . Space(2-strlen($Number_)) . $Number_ . '</td>';
         }
       }
        $Zastav  .= $TabLex .'</tr>';
      }

    $Zastav  .= '</table>';
    echo ($Zastav);
   } /* End Print_Tab_Lexems */

  /************************************************************************/
  /* Print_Tab_Identifiers_Constants                                      */
  /* Процедура печати таблицы массивов идентификаторов и констант.        */
  /* Аргументы: нет аргументов.                                           */
  /* Результат: Высвечивание на экране таблиц.                            */
  /************************************************************************/
  Function Print_Tab_Identifiers_Constants()
  {
       $Number='';
       $Number_='';
       /* Таблица массивов идентификаторов и констант */
       $Tab_Identifiers_Constants = '';
       global $Tab_Constants;
       global $Tab_Identifiers;
       global $Number_Identifiers;
       global $Number_Constants;      
    /* Начало процедуры Print_Tab_Identifiers_Constatns */

    /* Формирование таблицы массива идентификаторов */
    $Tab_Identifiers_Constants  = '<br><br><table border=1 width="450" align="center"><tr><td colspan=2 align="center">МАССИВ ИДЕНТИФИКАТОРОВ&nbsp;</td></tr>';
    $Tab_Identifiers_Constants  .= '<tr><td align="center"> Номер </td><td align="center"> ИДЕНТИФИКАТОР </td></tr>';

    for($i=1;$i<=$Number_Identifiers;$i++)
     {
       $Tab_Identifiers_Constants .=  '<tr><td  align="center">' . $i . '</td><td  align="center">' . $Tab_Identifiers[$i] . '</td></tr>';
       
     }  
     
     /* Формирование таблицы массива констант */
     $Tab_Identifiers_Constants  .= '</table><br><br><table border=1 width="450" align="center"><tr><td colspan=2 align="center">МАССИВ КОНСТАНТ&nbsp;</td></tr>';
     $Tab_Identifiers_Constants  .= '<tr><td align="center"> Номер </td><td align="center"> КОНСТАНТА </td></tr>';
    for($i=1;$i<=$Number_Constants;$i++)
     {
       $Tab_Identifiers_Constants .=  '<tr><td  align="center">' . $i . '</td><td  align="center">' . $Tab_Constants[$i] . '</td></tr>';
     }

        $Tab_Identifiers_Constants  .= '</table>';
    echo($Tab_Identifiers_Constants);
 } /* Print_Tab_Identifiers_Constants */

  /* Основной блок Лексического Анализатора */

  /* функция у0: подготовка (инициализация таблиц и переменных) */
  global $Code_Error;
  global $Tab_Lexems;
  global $Input_Letter;
  global $Number_Lexems_Programm;
  global $Number_Lexem;
  global $Number_Identifiers;
  global $Number_Constants;
  global $Number_String;
  global $Position;
  global $Current_Lexem;
  /* функция у1: чтение следующего символа программы на языке МИЛАН */

  if (Read($Input_Letter)==0)
  {
   echo('ОШИБКА: Отсутствуют данные для разбора.');
   exit;                                            // Завершение работы интерпретатора
  }
  $Position=0;
  $Number_String=1;
  $ct_spec= '/['.Chr(9). Chr(10).Chr(13). Chr(32).']/i';

  do
  {
   /* Игнорирование спец. символов и пробела */
   while (preg_match($ct_spec,$Input_Letter{0}) )
   {
    switch (ord($Input_Letter{0})):

    case 9  :  /* функция y2: увеличение счётчика текущей позиции   */
               /* ($Position=$Position+1)                           */
               $Position++;
               break;
    case 13 :
                /* функция y3: переход на новую строку в программе,   */
                /* увеличение счётчика текущей строки, и сброс        */
                /* счётчика позиции ( $Number_String=$Number_String+1,*/
                /* Position=0)                                        */
                $Number_String++;
                $Position=0;
               break;

    case 32 : /* функция y2: увеличение счётчика текущей позиции $Position++ */

               $Position++;
               break;
    endswitch;

    /* функция у1: чтение следующего символа программы на языке МИЛАН */
    Read($Input_Letter);
   }
   
      if(isAlpha($Input_Letter{0}))      // если введённый символ является буквой
        Letter();
    elseif(isDigit($Input_Letter{0}))  // если введённый символ является цифрой
        Digit();
    else
  {
   switch ($Input_Letter{0}):

    Case ';'          :
                            /* функция у11: формирование лексемы */
                            $Current_Lexem->Code=12;
                            $Current_Lexem->Value=0;

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case '='         :
                              /* функция у11: формирование лексемы */
                            $Current_Lexem->Code=13;
                            $Current_Lexem->Value=0;

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                            break;

    Case '>'         :
                             /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                            if ($Input_Letter=='=')
                            {

                             /* функция у11: формирование лексемы */
                             $Current_Lexem->Code=13;
                             $Current_Lexem->Value=4;

                             /* функция у1: чтение следующего символа */
                             Read($Input_Letter);
                             $Position++;

                            }
                            else
                            {

                             /* функция у11: формирование лексемы */
                             $Current_Lexem->Code=13;
                             $Current_Lexem->Value=2;

                            }
                            break;

    Case '<'         :
                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                            switch ($Input_Letter):
                            case '>'   :

                                      /* функция у11: формирование лексемы */
                                      $Current_Lexem->Code=13;
                                      $Current_Lexem->Value=1;

                                      /* функция у1: чтение следующего символа */
                                      Read($Input_Letter);
                                      $Position=$Position+1;

                                      break;

                            case  '=' :

                                      /* функция у11: формирование лексемы */
                                      $Current_Lexem->Code=13;
                                      $Current_Lexem->Value=5;

                                      /* функция у1: чтение следующего символа */
                                      Read($Input_Letter);
                                      $Position=$Position+1;

                                      break;
                            default:

                                      /* функция у11: формирование лексемы */
                                      $Current_Lexem->Code=13;
                                      $Current_Lexem->Value=3;
                                      break; 
                           endswitch;
                           break;
    Case '+'          :

                            /* функция у11: формирование лексемы */
                            $Current_Lexem->Code=14;
                            $Current_Lexem->Value=0;

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case '-'          :

                            /* функция у11: формирование лексемы */
                            $Current_Lexem->Code=14;
                            $Current_Lexem->Value=1;

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case '*'          :

                            /* функция у11: формирование лексемы */
                            $Current_Lexem->Code=15;
                            $Current_Lexem->Value=0;

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case '/'          :

                            /* функция у11: формирование лексемы */
                            $Current_Lexem->Code=15;
                            $Current_Lexem->Value=1;

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                             $Position++;

                           break;

    Case ':'          :

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                            if ($Input_Letter=='=')
                             {

                              /* функция у11: формирование лексемы */
                              $Current_Lexem->Code=16;
                              $Current_Lexem->Value=0;

                              /* функция у1: чтение следующего символа */
                              Read($Input_Letter);
                               $Position++;

                             }
                            else
                             /* Неопознанный символ в программе */
                             $Code_Error=0;
                           break;

    Case '('          :

                            /* функция у11: формирование лексемы */
                            $Current_Lexem->Code=17;
                            $Current_Lexem->Value=0;

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case ')'          :

                            /* функция у11: формирование лексемы */
                            $Current_Lexem->Code=18;
                            $Current_Lexem->Value=0;

                            /* функция у1: чтение следующего символа */
                            Read($Input_Letter);
                            $Position++;

                            break;

                           /* Признак конца программы */
    Case  Chr(26)     :
                            End_Lexical_Analyzer();
                            return 0;

     default:             /* Неопознанный символ в программе */
                           $Code_Error=0;

   endswitch;
  }
   /* Переполнение массива лексем */
   if ($Number_Lexem+1>MAX_LEXEMS)
    $Code_Error=3;

   /* Проверка на ошибку */
   if ($Code_Error>-1)
   {
    Print_Error_Message();
    return 0;
   }
   /* функция у9: запись сформированной лексемы в массив лексем */
   $Number_Lexem++;
   $Tab_Lexems[$Number_Lexem]->Code=$Current_Lexem->Code;
   $Tab_Lexems[$Number_Lexem]->Value=$Current_Lexem->Value;
 }while (TRUE);
}


 /*************************************************************************/
 /* Syntactical_Analyzer                                                  */
 /* Процедура синтаксического анализа, совмещенная со стадией             */
 /* генерации действий.                                                   */
 /* Входные данные: массив лексем (после сканера),                        */
 /*                 массив идентификаторов (после сканера),               */
 /*                 массив констант (после сканера).                      */
 /*                                                                       */
 /* Выходные данные: Выполнение программы на языке МИЛАН.                 */
 /*                                                                       */
 /* Обработка конструкций языка осуществляется процедурами:               */
 /*               ProcedureL, ProcedureS, ProcedureB, ProcedureE,         */
 /*               ProcedureT, ProcedureP.                                 */
 /* Процедура Syntactical_Analyzer использует стеки:                      */
 /*               $StekRes - стек результатов вычислений;                  */
 /*               $StekIdent - стек идентификаторов;                       */
 /*               $StekMul - стек для операций типа умножения;             */
 /*               $StekSum - стек для операций типа сложения;              */
 /*               $StekRel - стек для операций типа отношения.             */
 /*************************************************************************/
 //Объявление глобальных переменных
      $StekRes    =Array();  
      $StekIdent  =Array();  
      $StekMul    =Array();  
      $StekSum    =Array();  
      $StekRel    =Array();  
      $ArrIdent   =Array();
      $TopRes=0;
      $TopIdent=0;
      $TopMul=0;
      $TopSum=0;
      $TopRel=0;
      $Ai=0;
      $Bi=0;           
 Function Syntactical_Analyzer()
 {
 /*************************************************************************/
 /* Процедура ProcedureP - обработка конструкции <множитель>              */
 /* <множитель>::=<идентификатор>|<константа>|READ|(<выражение>)          */
 /*************************************************************************/
  Function ProcedureP()
 {
  global $Tab_Lexems;
  global $Tab_Constants;
  global $Number_Lexem;
  global $StekRes;
  global $TopRes;
  global $ArrIdent;
  global $Code_Error;
  $NomIdent     =0;
  $Cifra        =0;

  switch ($Tab_Lexems[$Number_Lexem]->Code):
     Case _IDENTIFIER_ :
                   /*  y1: занесение в стек StekRes идентификатора  $Tab_Lexems[$Number_Lexem]->Value */ 
                   
                   $NomIdent=$Tab_Lexems[$Number_Lexem]->Value;
                   if (!Stek_Integer(2, $StekRes, $TopRes, $ArrIdent[$NomIdent]))
                   {
                    /* Переполнение стека $StekRes */
                    $Code_Error=26;
                    return 0;
                   }

                   /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
                   $Number_Lexem++;

                   return 0;
                   break;
     Case _CONSTANT_ :

                   $NomIdent=$Tab_Lexems[$Number_Lexem]->Value;
                   /*  y2: занесение в стек $StekRes константы $Tab_Lexems[$Number_Lexem].Value;*/
                   if (!Stek_Integer(2, $StekRes, $TopRes, $Tab_Constants[$NomIdent]))
                   {
                    /* Переполнение стека $StekRes */
                    $Code_Error=26;
                    return 0;
                   }

                   /* функция y4: чтение следующей лексемы */
                   /* ($Number_Lexem++)        */
                   $Number_Lexem++;

                  return 0;
                   break;
      Case _READ_ :

                   /* y3: прочитать целое число из формы в переменную */
                   /* $Cifra и положить его в $StekRes ($Cifra-->$StekRes),*/

                   /* чтение целого числа из формы */
                   global $ct_buf;
                   global $ct_readBUF;            //$ct_readBUF - переменная является стеком для чтения данных вида "1%2%11"
                   global $ct_readCount;
                   global $Tab_Identifiers;
                   global $Tab_Constants;
                   global $ct_TabLEX_Value_str;
                   global $ct_TabLEX_Code_str; 
                   $len = count($ct_readBUF);     //количество элементов в массиве $ct_readBUF

                   if($ct_readCount>=$len)
                   {  
                   echo('<html>
                   <head>
                   <title>Ожидается ввод данных от пользователя:</title>
                   </head>
                   <body>
                   <br><h2>ФОРМА ДЛЯ ВВОДА ДАННЫХ</h2> Запрос №: '.($len+1).'<hr><br>');

                   echo('ВВЕДИТЕ ЦЕЛОЕ ЧИСЛО:<br><br> ');
                   echo ('<script type="text/javascript">
                            function ScanForInt()                                                            <!--javascript для обработки-->
                            {
                                var x=inputform.stdin.value;                                                 <!--получаем текущее введённое значение из поля ввода с именем "stdin"  в переменную "x"-->
                                for(i=0;i<=x.length;i++)                                                     <!--цикл для прохода по всей строке "x"-->
                                {
                                var s=x.substr(i).charCodeAt();                                              <!--получаем ASCII код i-ого символа--> 
                                    if(s<48 || s>57)                                                         <!--диапазон кодов (48..57) соответствет в таблице ASCII - целым числам от 0..9 -->
                                    {
                                          alert("Введите целое число");                                      <!--выдаём сообщение пользователю -->
                                          return false;                                                      <!--выходим из скрипта -->
                                    }
                                }
                                return x.length>0;                                                           <!--возвращаем TRUE, если длина больше 0, иначе FALSE -->
                            }                                                    
                            </script>
                            <form name="inputform" action="milan.php" method="POST">
                            <input type="text" name="stdin" />                                               <!--в поле с именем "stdin" хранится введённое пользователем число -->
                              <input name="source" type="hidden" value="'.$ct_buf.'"/>                       <!--переменная для хранения исходного кода программы MILAN -->
                              <input name="lex_code" type="hidden" value="'.$ct_TabLEX_Code_str.'">                <!--поле хранит значения CODE таблицы лексем  --> 
                              <input name="lex_value" type="hidden" value="'.$ct_TabLEX_Value_str.'">              <!--поле хранит значения VALUE таблицы лексем  --> 
                              <input name="tab_ident" type="hidden" value="' .join('%',$Tab_Identifiers). '">       <!--поле хранит данные таблицы идентификаторов -->
                              <input name="tab_const" type="hidden" value="' .join('%',$Tab_Constants). '">         <!--поле хранит данные таблицы констант --> 
                              <input name="readbuf" type="hidden" value="'. join("%",$ct_readBUF) .'"/>      <!--функция join("%",$ct_readBUF) преобразует массив данных в строку разделённую "%" -->
                              <input name="mode" type="hidden" value="2">                                    <!--поле хранит текущий режим работы скрипта-->
                                                                
                              <!--Кнопка для отправки данных в скрипт "milan.php", в случае получения значения "TRUE" от функции ScanForInt() -->
                            <input type="button" name="send" value="Отправить" onclick="if(ScanForInt())inputform.submit()">  
                            </form>    </body></html>');
                   exit;             //!!  производится завершение работы интерпретатора и ожидание ввода данных 
                   }              
                   $Cifra=$ct_readBUF[$ct_readCount++];


                   if (!Stek_Integer(2, $StekRes, $TopRes, $Cifra))
                   {
                    /* Переполнение стека $StekRes */
                    $Code_Error=26;
                    return 0;
                   }

                   /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
                   $Number_Lexem++;

                  break;

     Case  _LPAREN_ :

                   /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
                   $Number_Lexem++;

                   /* Обработка конструкции <выражение> */
                   ProcedureE();

                   /* Проверка на ошибки, появившиеся в процессе обработки конструкции <выражение>*/
                   if ($Code_Error!=-1)
                    return 0;

                   if ($Tab_Lexems[$Number_Lexem]->Code==_RPAREN_)
                   {
                    /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
                    $Number_Lexem++;
                   }
                   else
                   {
                    /* Конструкция <множитель>. Нет закрывающей скобки. */
                    $Code_Error=30;
                   return 0;
                   }
  endswitch;
  return 0;
 } /* End ProcedureP */

 /*************************************************************************/
 /* Процедура ProcedureT - обработка конструкции <терм>                   */
 /* <терм>::=<множитель>|<множитель><операция типа умножения><множитель>  */
 /*************************************************************************/
  Function ProcedureT()
{
  global $Code_Error;
  global $Tab_Lexems;
  global $Number_Lexem;
  global $StekMul;
  global $TopMul;
  global $StekRes;
  global $TopRes;
  global $Bi;
  global $Ai;
  $c    =   0;
  $kmul =   0;

  /* Обработка конструкции множитель */
  ProcedureP();

  /* Проверка на ошибки, появившиеся в процессе */
  /* обработки конструкции <множитель>          */
  if ($Code_Error!=-1)
   return 0;

  while (TRUE)
  {
   if ($Tab_Lexems[$Number_Lexem]->Code == _MUL_)    
   {

    /* y5: занесение в стек $StekMul значение операции типа умножения */
    /* $Tab_Lexems[$Number_Lexem]->Value-->StekMul                      */
    if (!Stek_Integer(2, $StekMul, $TopMul, $Tab_Lexems[$Number_Lexem]->Value))
    {
     /* Переполнение стека $StekMul */
     $Code_Error=28;
     return 0;
    }

    /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
    $Number_Lexem++;

    /* Обработка конструкции <множитель> */
    ProcedureP();

    /* Проверка на ошибки, появившиеся в процессе */
    /* обработки конструкции <множитель>          */
    if ($Code_Error!=-1)
     return 0;

    /* y6: в переменную $Bi снять элемент со стека $StekRes ($Bi<--$StekRes), */
    /* в переменную $Ai снять элемент со стека $StekRes ($Ai<--$StekRes),     */
    /* в переменную kmul снять элемент со стека $StekMul ($kmul<--$StekMul), */
    /* выполнить операцию типа умножение $Ai otu($kmul) $Bi и результат      */
    /* занести в стек $StekRes                                             */

    if (!Stek_Integer(1, $StekRes, $TopRes,$Bi))
    {
     /* Нехватка элементов в стеке $StekRes */
     $Code_Error=16;
     return 0;
    }

    if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
    {
     /* Нехватка элементов в стеке $StekRes */
     $Code_Error=16;
     return 0;
    }

    if (!Stek_Integer(1, $StekMul, $TopMul, $kmul))
    {
     /* Нехватка элементов в стеке $StekMul */
     $Code_Error=27;
     return 0;
    }

    /* Выполнение умножения */
     $c=$Ai*$Bi;
     $mode= _SLASH_;
    if ($kmul==$mode)
    {

     if ($Bi!=0)
     {
      $c=intval($Ai / $Bi);             //присвоим $c целую часть от деления $Ai и $Bi
     }
     else
     {
      /* Деление на ноль */
      $Code_Error=29;
      return 0;
     }
    }
    /* занесение результата в стек $StekRes */
    if (!Stek_Integer(2, $StekRes, $TopRes, $c))
    {
     /* Переполнение стека $StekRes */
     $Code_Error=26;
     return 0;
    }

   }
   return 0;
  }
 }
 /* End ProcedureT */

 /*************************************************************************/
 /* Процедура ProcedureE - обработка конструкции <выражение>              */
 /* <выражение>::=<терм>|<операция типа сложения><терм> |                 */
 /*               <терм><операция типа сложения><терм>  |                 */
 /*    <операция типа сложения><терм><операция типа сложения><терм>       */
 /*************************************************************************/
  Function ProcedureE()
 {
  global $TopSum;
  global $TopRes;
  global $StekSum;
  global $StekRes;
  global $Tab_Lexems;
  global $Number_Lexem;
  global $Code_Error;
  global $Ai;
  global $Bi;

  $c    =0;
  $ksum =0;

  if ($Tab_Lexems[$Number_Lexem]->Value==_SUMM_)
  {
   /* y7: занесение в стек $StekSum кода операции типа сложения */
   if (!Stek_Integer(2, $StekSum, $TopSum, $Tab_Lexems[$Number_Lexem]->Value))
   {
    /* Переполнение стека $StekSum */
    $Code_Error=31;
    return 0;
   }

   /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
   $Number_Lexem++;

   /* Обработка конструкции <терм> */
   ProcedureT();

   /* Проверка на ошибки, появившиеся в процессе */
   /* обработки конструкции <терм>               */
   if ($Code_Error!=-1)
    return 0;

   /* y8: в переменную ksum снять со стека $StekSum значение    */
   /* лексемы ots ($ksum<--$StekSum), если ksum=1, то снять      */
   /* в переменную Ai элемент со стека $Stekres ($Ai<--$StekRes), */
   /* сменить знак этого числа и занести его в стек $StekRes    */
   /* -$Ai-->$StekRes                                            */
   if (!Stek_Integer(1, $StekSum, $TopSum, $ksum))
   {
    /* Нехватка элементов в стеке $StekSum */
    $Code_Error=32;
    return 0;
   }
   if ($ksum!=_PLUS_)
   {
    if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
    {
     /* Нехватка элементов в стеке $StekRes */
     $Code_Error=16;
     return 0;
    }

    $Ai=-$Ai;

    if (!Stek_Integer(2, $StekRes, $TopRes, $Ai))
    {
     /* Переполнение стека $StekRes */
     $Code_Error=26;
     return 0;
    }
   }
  }

  /* случай отсутствия операции сложения */

  /* Обработка конструкции <терм> */
  ProcedureT();
  /* Проверка на ошибки, появившиеся в процессе */
  /* обработки конструкции <терм>               */
  if ($Code_Error!=-1)
   return 0;

  while (TRUE):
   if ($Tab_Lexems[$Number_Lexem]->Code==_SUMM_)
   {
    /* y9: занесение в стек $StekSum кода операции типа сложения */
    if (!Stek_Integer(2, $StekSum, $TopSum, $Tab_Lexems[$Number_Lexem]->Value))
    {
     /* Переполнение стека $StekSum */
     $Code_Error=31;
     return 0;
    }

   /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
   $Number_Lexem++;

   /* Обработка конструкции <терм> */
   ProcedureT();

   /* Проверка на ошибки, появившиеся в процессе */
   /* обработки конструкции <терм>               */
   if ($Code_Error!=-1)
    return 0;

    /* y10: в переменную $Bi снять элемент со стека $StekRes ($Bi<--$StekRes),*/
    /* в переменную $Ai снять элемент со стека $StekRes ($Ai<--$StekRes),     */
    /* в переменную ksum снять элемент со стека $StekSum ($ksum<--$StekSum), */
    /* выполнить операцию типа сложение $Ai ots($ksum) $Bi и результат       */
    /* занести в стек $StekRes                                             */

    if (!Stek_Integer(1, $StekRes, $TopRes, $Bi))
    {
     /* Нехватка элементов в стеке $StekRes */
     $Code_Error=16;
     return 0;
    }

    if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
    {
     /* Нехватка элементов в стеке $StekRes */
     $Code_Error=16;
     return 0;
    }

    if (!Stek_Integer(1, $StekSum, $TopSum, $ksum))
    {
     /* Нехватка элементов в стеке $StekSum */
     $Code_Error=32;
     return 0;
    }

    $c=$Ai+$Bi;

    if ($ksum!=_PLUS_)
     $c=$Ai-$Bi;

    /* занесение результата в стек $StekRes */
    if (!Stek_Integer(2, $StekRes, $TopRes, $c))
    {
     /* Переполнение стека $StekRes */
     $Code_Error=26;
     return 0;
    }
   }
   return 0;
  endwhile;

 } /* End ProcedureE */

 /*************************************************************************/
 /* Процедура ProcedureB - обработка конструкции <условие>                */
 /* <условие>::=<выражение><знак отношения><выражение>                    */
 /*************************************************************************/
  Function ProcedureB()
 {
  global $TopSum;
  global $TopRes;
  global $StekSum;
  global $StekRes;
  global $StekRel;
  global $TopRel;
  global $Tab_Lexems;
  global $Number_Lexem;
  global $Code_Error;
  global $Ai;
  global $Bi;
  $c    =0;
  $krel =0;

  /* Обработка конструкции <выражение> */
  ProcedureE();

  /* Проверка на ошибки, появившиеся в процессе */
  /* обработки конструкции <выражение>          */
  if ($Code_Error!=-1)
   return 0;

  if ($Tab_Lexems[$Number_Lexem]->Code==_RELATION_)
  {

   /* y11: добавление в стек $StekRel значения операции типа отношение */
   /* ($Tab_Lexems[$Number_Lexem]->Value-->$StekRel)                      */
   if (!Stek_Integer(2, $StekRel, $TopRel, $Tab_Lexems[$Number_Lexem]->Value))
   {
    /* Переполнение стека $StekRel */
    $Code_Error=24;
    return 0;
   }

   /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
   $Number_Lexem++;

   /* Обработка конструкции <выражение> */
   ProcedureE();

   /* Проверка на ошибки, появившиеся в процессе обработки конструкции <выражение> */
   if ($Code_Error!=-1)
     return 0;

   /* y12: в переменную Bi снять элемент со стека $StekRes ($Bi<--$StekRes),*/
   /* в переменную $Ai снять элемент со стека StekRes ($Ai<--$StekRes),     */
   /* в переменную $krel снять элемент со стека $StekRel (krel<--$StekRel), */
   /* выполнить операцию сравнения $Ai otn($krel) Bi и результат занести   */
   /* в стек $StekRes ([0, 1]-->$StekRes)                                  */
   if (!Stek_Integer(1, $StekRes, $TopRes, $Bi))
   {
    /* Нехватка элементов в стеке $StekRes */
    $Code_Error=16;
    return 0;
   }

   if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
   {
    /* Нехватка элементов в стеке $StekRes */
    $Code_Error=16;
    return 0;
   }

   if (!Stek_Integer(1, $StekRel, $TopRel, $krel))
   {
    /* Нехватка элеметов в стеке $StekRel */
    $Code_Error=25;
    return 0;
   }

   /* выполнение сравнения */

   switch ($krel):

     case  _EQUAL_:     if ($Ai==$Bi) $c=1;break;

     case  _NOTEQUAL_:     if ($Ai!=$Bi) $c=1;break;

     case  _GT_:         if ($Ai>$Bi)  $c=1;break;

     case  _LT_:        if ($Ai<$Bi)  $c=1;break;

     case  _GE_:         if ($Ai>=$Bi) $c=1;break;

     case  _LE_:         if ($Ai<=$Bi) $c=1;break;
     default:
                                       $c=0;
   endswitch;

   /* занесение результата в стек $StekRes */
   if (!Stek_Integer(2, $StekRes, $TopRes, $c))
   {
    /* Переполнение стека $StekRes */
    $Code_Error=26;
    return 0;
   }

  }
  else
  {
   /* Конструкция <условие>. Неверная операция отношения. */
   $Code_Error=23;
   return 0;
  }
    return 0;
 } /* End ProcedureB */

 /*************************************************************************/
 /* Процедура ProcedureS - обработка конструкции                          */
 /* <оператор>::=<идентификатор>:=<выражение> | OUTPUT(<выражение>) |     */
 /*             WHILE <условие> DO <последовательность операторов> ENDDO| */
 /*             IF <условие> THEN <последовательность операторов> ENDIF | */
 /*                                <последовательность операторов> ENDIF  */
 /*************************************************************************/
  function ProcedureS()
 {

  global $TopRes;
  global $StekRes;
  global $Tab_Lexems;
  global $Number_Lexem;
  global $Code_Error;
  global $StekIdent;
  global $TopIdent;
  global $ArrIdent;
  global $Ai;
  global $Bi;

  switch ($Tab_Lexems[$Number_Lexem]->Code):

   /* Обработка оператора присваивания */
   /* <идентификатор>:=<выражение>     */
   case _IDENTIFIER_ :

                    /* y13:добавить значение лексемы с номером $Number_Lexem */
                    /* в стек $StekIdent ($Tab_Lexems[$Number_Lexem]->Value-->$StekIdent)*/                                       
                    if (!Stek_Integer(2, $StekIdent, $TopIdent,$Tab_Lexems[$Number_Lexem]->Value))
                    {
                     /* Переполнение стека $StekIdent */
                     $Code_Error=14;
                     Exit;
                    }

                    /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                    $Number_Lexem++;

                    if ($Tab_Lexems[$Number_Lexem]->Code==_ASSIGNMENT_)
                    {

                     /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                     $Number_Lexem++;

                     /* Обработка конструкции <выражение> */
                     ProcedureE();

                     /* Проверка на ошибки, появившиеся в процессе            */
                     /* обработки конструкции <выражение>                     */
                     if ($Code_Error!=-1)
                      return 0;

                    }
                    else
                    {
                     /* Конструкция <оператор>. Неверное присваивание.*/
                     $Code_Error=15;
                     return 0;
                    }

                    /* y14: в переменную $Ai снять элемент со стека $StekRes*/
                    /* ($Ai<--$StekRes), в переменную $Bi снять со стека     */
                    /* $StekIdent значение лексемы ident ($Bi<--$StekIdent), */
                    /* идентификатору с номером $Bi, присвоить значение $Ai */
                    /* $ArrIdent[$Bi]=$Ai                                   */
                    if (!Stek_Integer(1, $StekRes, $TopRes,$Ai))
                    {
                     /* Нехватка элементов в стеке $StekRes */
                     $Code_Error=16;
                     return 0;
                    }
                    if (!Stek_Integer(1, $StekIdent, $TopIdent, $Bi))
                    {
                     /* Нехватка элементов в стеке $StekIdent */
                     $Code_Error=17;
                     return 0;
                    }
                    $ArrIdent[$Bi]=$Ai;

                   break;

   case _OUTPUT_ :

                    /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
                    $Number_Lexem++;

                    if ($Tab_Lexems[$Number_Lexem]->Code==_LPAREN_)
                    {

                     /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                     $Number_Lexem++;

                     /* Обработка конструкции <выражение> */
                     ProcedureE();

                     /* Проверка на ошибки, появившиеся в процессе      */
                     /* обработки конструкции <выражение>               */
                     if ($Code_Error!=-1)
                      return 0;

                    }
                    else
                    {
                     /* Конструкция <оператор>.Неверный оператор OUTPUT.*/
                     $Code_Error=18;
                     return 0;
                    }

                    if ($Tab_Lexems[$Number_Lexem]->Code==_RPAREN_)
                    {

                     /* функция y4: чтение следующей лексемы  ($Number_Lexem++)  */
                     $Number_Lexem++;

                     /* y15: в переменную $Ai снять элемент со стека StekRes */
                     /* ($Ai<--$StekRes), напечатать переменную $Ai         */
                     if (!Stek_Integer(1, $StekRes,$TopRes, $Ai))
                     {
                      /* Нехватка элементов в стеке $StekRes */
                      $Code_Error=16;
                      return 0;
                     }

                  echo('
                   <br>
                   <hr>
                   <br>
                   ВЫВОД:  ' . $Ai . '
                   <br>
                     ');
                    }
                    else
                    {
                     /* Конструкция <оператор>. Неверный оператор OUTPUT.*/
                     $Code_Error=18;
                     return 0;
                    }

                   break;

   case _WHILE_ :
                    /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
                    $Number_Lexem++;

                    while (TRUE)
                    {

                     /* Обработка конструкции <условие> */
                     ProcedureB();

                     /* Проверка на ошибки, появившиеся в процессе   */
                     /* обработки конструкции <условие>              */
                     if ($Code_Error!=-1)
                      return 0;

                     /* y16: в переменную $Ai снять элемент со стека StekRes */
                     /* ($Ai<--$StekRes), если $Ai=1, то это истина, иначе - ложь */

                     if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
                     {
                      /* Нехватка элементов в стеке $StekRes */
                      $Code_Error=16;
                      return 0;
                     }

                     if ($Tab_Lexems[$Number_Lexem]->Code==_DO_)
                     {
                      /* проверка истинности условия: $Ai==1 (TRUE), */
                      /* $Ai==0 (FALSE)                              */
                      if ($Ai==1) /* обработка TRUE */
                      {
                       /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                       $Number_Lexem++;

                       /* Обработка конструкции           */
                       /* <последовательность операторов> */
                       ProcedureL();

                       /* Проверка на ошибки, появившиеся в процессе   */
                       /* обработки конструкции                        */
                       /* <последовательность операторов>              */
                       if ($Code_Error!=-1)
                        return 0;

                       if ($Tab_Lexems[$Number_Lexem]->Code==_ENDDO_)
                       {
                        /* y17: перейти на лексему номер       */
                        /* $Tab_Lexems[$Number_Lexem]->Value      */
                        $Number_Lexem=$Tab_Lexems[$Number_Lexem]->Value;
                        Continue;
                       }
                       else
                       {
                        /* Конструкция <оператор>. Неверный оператор WHILE. */
                        $Code_Error=19;
                        return 0;
                       }
                      }
                      else    /* обработка FALSE */
                      {
                       /* перейти на лексему номер $Tab_Lexems[$Number_Lexem]->Value  */
  
                       $Number_Lexem=$Tab_Lexems[$Number_Lexem]->Value;
                       return 0;
                      }
                     }
                     else
                     {
                      /* Конструкция <оператор>. Неверный оператор WHILE. */
                      $Code_Error=19;
                      return 0;
                     }
                    }

                   break;

     case _IF_ :
                     /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                     $Number_Lexem++;

                     /* Обработка конструкции <условие> */
                     ProcedureB();

                     /* Проверка на ошибки, появившиеся в процессе */
                     /* обработки конструкции <условие>            */
                     if ($Code_Error!=-1)
                      return 0;

                     /* y18: в переменную $Ai снять элемент со стека $StekRes */
                     /* ($Ai<--$StekRes), если $Ai=1, то это истина,           */
                     /* иначе - ложь                                        */
                     if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
                     {
                      /* Нехватка элементов в стеке $StekRes */
                      $Code_Error=16;
                      return 0;
                     }

                     if ($Tab_Lexems[$Number_Lexem]->Code!=_THEN_)
                     {
                      /* Конструкция <оператор>. */
                      /* Отсутствует THEN в операторе IF. */
                      $Code_Error=20;
                      return 0;
                     }

                     /* проверка истинности условия: $Ai==1 (TRUE), */
                     /* $Ai==0 (FALSE)                              */
                     if ($Ai==1) /* Обработка TRUE */
                     {

                      /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                      $Number_Lexem++;

                      /* Обработка конструкции                      */
                      /* <последовательность операторов> после ELSE */
                      ProcedureL();

                      /* Проверка на ошибки, появившиеся в процессе */
                      /* обработки конструкции                      */
                      /* <последовательность операторов>            */
                      if ($Code_Error!=-1)
                       return 0;

                      if ($Tab_Lexems[$Number_Lexem]->Code==_ELSE_)
                      {

                       /* y19: перейти на лексему номер $Tab_Lexems[$Number_Lexem]->Value-1  */
                       /*    */
                       $Number_Lexem=$Tab_Lexems[$Number_Lexem]->Value-1;

                       if ($Tab_Lexems[$Number_Lexem]->Code==_ENDIF_)
                       {
                        /* функция y4: чтение следующей лексемы ($Number_Lexem++)*/
                        $Number_Lexem++;
                        return 0;
                       }
                       else
                       {
                        /* Конструкция <оператор>.          */
                        /* Отсутствует ENDIF в операторе IF.*/
                        $Code_Error=21;
                        return 0;
                       }

                      }
                      elseif ($Tab_Lexems[$Number_Lexem]->Code==_ENDIF_)
                       {
                        /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                        $Number_Lexem++;
                        return 0;
                       }
                       else
                       {
                        /* Конструкция <оператор>.          */
                        /* Отсутствует ENDIF в операторе IF.*/
                        $Code_Error=21;
                        return 0;
                       }

                     }
                     else /* Обработка FALSE */
                     {

                      /* y19: перейти на лексему номер  $Tab_Lexems[$Number_Lexem]->Value-1  */
                      $Number_Lexem=$Tab_Lexems[$Number_Lexem]->Value-1;

                      if ($Tab_Lexems[$Number_Lexem]->Code==_ELSE_)
                      {

                       /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                       $Number_Lexem++;

                       /* Обработка конструкции                      */
                       /* <последовательность операторов> после ELSE */
                       ProcedureL();

                       /* Проверка на ошибки, появившиеся в процессе  */
                       /* обработки конструкции                       */
                       /* <последовательность операторов>             */
                       if ($Code_Error!=-1)
                        return 0;

                       if ($Tab_Lexems[$Number_Lexem]->Code==_ENDIF_)
                       {

                        /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                        $Number_Lexem++;
                        return 0;
                       }
                       else
                       {
                        /* Конструкция <оператор>. */
                        /* Отсутствует ENDIF в операторе IF.*/
                        $Code_Error=21;
                        return 0;
                       }
                      }
                      elseif ($Tab_Lexems[$Number_Lexem]->Code==_ENDIF_)
                       {
                        /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
                        $Number_Lexem++;
                        return 0;
                       }
                       else
                       {
                        /* Конструкция <оператор>.                   */
                        /* Отсутствует ELSE или ENDIF в операторе IF.*/
                        $Code_Error=22;
                        return 0;
                       }

                      }

                    break;

  endswitch;
  return 0;
} /* End ProcdureS */

  /*************************************************************************/
  /* Процедура ProcedureL - обработка конструкции                          */
  /* <последовательность операторов>::=<оператор> |                        */
  /*                            <оператор>;<последовательность операторов> */
  /*************************************************************************/
  function ProcedureL()
  {
    global $Code_Error;
    global $Tab_Lexems;
    global $Number_Lexem;
   while (TRUE):

    /* Обработка конструкции <оператор> */
    ProcedureS();

    /* Проверка на ошибки, появившиеся в процессе */
    /* обработки конструкции <оператор>           */
    if ($Code_Error!=-1)
      return 0;

    /* Проверка символа ";" */
    if ($Tab_Lexems[$Number_Lexem]->Code!=_SEMICOLON_)
      return 0;

    /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
    $Number_Lexem++;

   endwhile;
   return 0;
  } /* End ProcedureL */

  
 /* Начало Синтаксического анализа совмещённого с интерпретацией */

  /* функция y0: инициализация стеков и переменных */
  /* Инициализация переменных */
  global $Tab_Lexems;
  global $Number_Lexem;
  global $Code_Error;
  global $ArrIdent;
  global $TopIdent;
  global $TopRel;
  global $TopRes;
  global $StekRes;
  global $TopSum;
  global $StekSum;
  global $StekMul;
  global $StekRel;
  global $StekIdent;
  global $Ai;
  global $Bi;
  $Ai=0;
  $Bi=0;

  /* Инициализация стеков */
  Stek_Integer(0, $ArrIdent,  $TopRes, $Ai);
  Stek_Integer(0, $StekRes,   $TopRes, $Ai);
  Stek_Integer(0, $StekIdent, $TopIdent, $Ai);
  Stek_Integer(0, $StekMul,   $TopMul, $Ai);
  Stek_Integer(0, $StekSum,   $TopSum, $Ai);
  Stek_Integer(0, $StekRel,   $TopRel, $Ai);


  /* Начало просмотра массива лексем */
  $Number_Lexem=1;

  if ($Tab_Lexems[$Number_Lexem]->Code!=_BEGIN_)
  {
   /* Конструкция <программа>. Нет BEGIN. */
   $Code_Error=12;
   return 0;
  }

  /* функция y4: чтение следующей лексемы ($Number_Lexem++) */
  $Number_Lexem++;

  /* Обработка конструкции <последовательность операторов> */
  ProcedureL();
  /* Проверка на ошибки, появившиеся в процессе            */
  /* обработки конструкции <последовательность операторов> */
  if ($Code_Error!=-1)
   return 0;

  if ($Tab_Lexems[$Number_Lexem]->Code!=_END_)
  {
   /* Конструкция <программа>. Нет END. */
   $Code_Error=13;
   return 0;
  }

  /* y20: нормальное завершение работы синтаксического анализатора */
  global $ct_buf;
   echo('<br><hr><br><font color="blue">НОРМАЛЬНОЕ ЗАВЕРШЕНИЕ РАБОТЫ ИНТЕРПРЕТАТОРА</font><br><br><form action="INTERFACE.php" method="POST">
                   <input type="submit" value="    ОК    " >
                   <input name="source" type="hidden" value="'.$ct_buf.'">    
                   </form>');
  }
  
?>
