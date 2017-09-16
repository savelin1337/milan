<?php
/***************************************************************
*******************������������� ����� �����********************
****************************************************************
****************************************************************
****���������� �� PHP************������� ���    ������� �.�.****
****************************************************************
****������� ������������*********�.�.�., ������ ������� �.A.****
****************************************************************
****************************************************************
**********************��� 2010**********************************/

//�������� �������
       /* ������� ������� ������ */
      class Element_Lexems
          {
                       /* ��� ������� */
                          public $Code = 0 ;

                       /* �������� ������� */
                          public $Value = 0 ;
         }

       /* ������� ������� �������� [�����������������] ���� */
       class  Element_Key_Words
       {

                           /* �������� ����� */
                           public  $Key_Word = '';

                        /* ��� ��������� ����� */
                        public  $Code_Key_Word = 0;

       }

//�������� ��������

       /* ���������� �������� ���� ����� ����� */
       define("MAX_KEY_WORDS",11);

       /* ���� �������� ���� ����� ����� */
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

       /* ���� ������ ����� ����� */
       define("_SEMICOLON_",12); /* ; */

       define("_RELATION_",13); // �������� ���� ���������
       /* �������� �������� ���� ��������� */
                 define("_EQUAL_",    0); /*   =     */
                 define("_NOTEQUAL_", 1); /*   <>     */
                 define("_GT_",       2); /*   >    */
                 define("_LT_",       3); /*   <    */
                 define("_GE_",       4); /*   >=   */
                 define("_LE_",       5); /*   <=   */

       define("_SUMM_",    14); /* �������� ���� ��������  */
       /* �������� �������� ���� �������� */
                define("_PLUS_",     0); /*   +   */
                define("_MINUS_",    1); /*   -   */

       define("_MUL_",     15); /* �������� ���� ���������  */
       /* �������� �������� ���� �������� */
               define("_STAR_",    0); /*   *   */
               define("_SLASH_",   1); /*   /   */

       define("_ASSIGNMENT_",        16);   /* ������������  */
       define("_LPAREN_",            17);   /*      (        */
       define("_RPAREN_",            18);   /*      )        */
       define("_IDENTIFIER_",        19);   /* ������������� */
       define("_CONSTANT_",            20);   /*   ���������   */


       /* ������� �������� [�����������������] ���� ����� �����     */
       /* �������� ����� � ������� ������ ���� �����������, �.�.    */
       /* ����� � ������� �������������� ������� "��������� ������" */

       $Table_Key_Words = Array();

       function ct_AddElement($Key_Word, $Code_Key_Word)
       {
            $ct_Element                 =   new Element_Key_Words;
            $ct_Element->Key_Word        =    $Key_Word;
            $ct_Element->Code_Key_Word    =    $Code_Key_Word;
           return $ct_Element;
       }
               //������ ����� ������

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


       /* ����������� ���������� ���������� ��������������� � ��������� */
       define("MAX_IDENTIFIERS",    15);

       /* ����������� ���������� ���������� �������� � ��������� */
       define("MAX_CONSTANTS",      15);

       /* ����������� ���������� ���������� ������ � ��������� */
       define("MAX_LEXEMS",         500);

       /* ������ ��������� �� ������� � ��������� �� ������ */
       $Error_Message = Array(
       /*     1      */   '����������� ������ � ���������.',
       /*     2      */   '���������� ������������� ���������� ���������������.',
       /*     3      */   '���������� ������������� ���������� ��������.',
       /*     4      */   '������������ ������� ������.',
       /*     5      */   '������������ ����� Stek_do.',
       /*     6      */   '�������� ��������� � ����� Stek_do.',
       /*     7      */   '������������ ��������� � ������� ��� ������ �� ������ Stek_do.',
       /*     8      */   '������������ ����� Stek_if.',
       /*     9      */   '�������� ��������� � ����� Stek_if.',
       /*    10      */   '������������ ��������� � ������� ��� ������ �� ������ Stek_if.',
       /*    11      */   '�������������� � ���������� WHILE-DO-ENDDO.',
       /*    12      */   '�������������� � ���������� IF-THEN-ELSE-ENDIF.',
       /*    13      */   '����������� <���������>. ��� BEGIN.',
       /*    14      */   '����������� <���������>. ��� END.',
       /*    15      */   '������������ ����� StekIdent.',
       /*    16      */   '����������� <��������>. �������� ������������.',
       /*    17      */   '�������� ��������� � ����� StekRes.',
       /*    18      */   '�������� ��������� � ����� StekIdent.',
       /*    19      */   '����������� <��������>. �������� �������� OUTPUT.',
       /*    20      */   '����������� <��������>. �������� �������� WHILE.',
       /*    21      */   '����������� <��������>. ����������� THEN � ��������� IF.',
       /*    22      */   '����������� <��������>. ����������� ENDIF � ��������� IF.',
       /*    23      */   '����������� <��������>. ����������� ELSE ��� ENDIF � ��������� IF.',
       /*    24      */   '����������� <�������>. �������� �������� ���������.',
       /*    25      */   '������������ ����� StekRel.',
       /*    26      */   '�������� ��������� � ����� StekRel.',
       /*    27      */   '������������ ����� StekRes.',
       /*    28      */   '�������� ��������� � ����� StekMul.',
       /*    29      */   '������������ ����� StekMul.',
       /*    30      */   '������� �� ����.',
       /*    31      */   '����������� <���������>. ��� ����������� ������.',
       /*    32      */   '������������ ����� StekSum.',
       /*    33      */   '�������� ��������� � ����� StekSum.');

       /* ������ ������ */
       $Tab_Lexems      = Array ();

       /* ������ ��������������� */
       $Tab_Identifiers = Array ();

       /* ������ �������� */
       $Tab_Constants   = Array ();

       /* ��� ��������� �� ����� ����� */
       $Input_Programm  =    '';

       /* ������� ���� ��������� �� ����� ����� */


       /* ������� ������ ��������� �� ����� ����� */
       $Input_Letter    =    '';

       /* ����� ���������� ������� � ��������� */
       $Number_Letter   =    0;

       /* ��� ������ */
       $Code_Error      =    -1 ;

       /* ����� ������ � ������� � ������� ������ */
       $Number_String   =     0;
       $Position        =     0;

       /* ����� ��������� ������� � ��������� */
       $Number_Lexem    =     0;

       /* �������������� ����������� ������������ ������� */
       $Current_Lexem = new Element_Lexems;

       /* ���������� ������ � ��������� */
       $Number_Lexems_Programm     =    0;

       /* ����� ���������� �������������� � ��������� */
       $Number_Identifiers        =    0;

       /* ����� ��������� ��������� � ��������� */
       $Number_Constants        =    0;


 /*************************************************************************/
 /* Stek_Integer(...)                                                     */
 /* ������� ��� ������ �� ������� ���� Integer.                           */
 /* ���������:                                                            */
 /*           Operation - ��� �������� ( 0 - ������������� �����;         */
 /*                                      1 - ���������� �������� �� ����� */
 /*                                          � Element;                   */
 /*                                      2 - ���������� ��������          */
 /*                                          � ���� Element;              */
 /*           $Current_Stek - ������ �� 50 ��������� ;                     */
 /*           $Top - ������� ����� ;                                       */
 /*           $Element - ������� ������� �������� � ���� ��� � �������     */
 /*                     ������������ ������� �����.                       */
 /* ������� ���������� �������� TRUE, ���� �������� ������ �� ������      */
 /* ��������� �������, FALSE - � ��������� ������.                        */
 /*************************************************************************/
 function Stek_Integer( $Operation  ,
                        &$Current_Stek,
                        &$Top,
                        &$Element)
{
  global $Code_Error;

  switch ($Operation):
   /* ������������� ����� */
  Case  0 :
        $Top=0;
        for ($i=1;$i<=50;$i++)
        {
         $Current_Stek[$i]=0;
        }
     break;

   /* ���������� �������� �� ����� */
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
   /* ���������� �������� � ���� */
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
   /* ��������� �� ������ */
   default:

          $Code_Error=4;
          return FALSE;

   endswitch;
   return TRUE;
} /* End Stek_Integer*/

 /*************************************************************************/
 /* Replicate(<���C>,<���N>)                                              */
 /* ���������: <���C>, <���N>.                                            */
 /* ���������: ������� ���������� ���������� ������, ����������           */
 /*            ����������� <���N> ��� ������ <���C>.                      */
 /*************************************************************************/
 Function Replicate($String_Letter, $Num)
 {
  $Word='';
  for($i=1; $i<=$Num; $i++)
   $Word = $Word . $String_Letter;
  return $Word;
 } /* End Replicate */

 /*************************************************************************/
 /* Space(<���N>)                                                         */
 /* ���������: <���N>.                                                    */
 /* ������� ���������� ������, ��������� �� <���N> ��������.              */
 /*************************************************************************/
 Function Space($Num)
 {
  return Replicate(' ',$Num);
 } /* End Space */

 /*************************************************************************/
 /* Print_Error                                                           */
 /* ��������� ������ �� ����� ��������� �� ������ ���                     */
 /* ������������ �����������                                              */
 /* ����������� ������                                                    */
 /* ��������������                                                        */
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
                   print ('<html><head><title>��������� ������ ������������ �����������</title></head><body><br><H2 align="center">��������� ������ ������������ �����������</H2><br><hr><br>
                   <table cellspacing="3" cellpadding="3"  align="center"><tr><td >������� ������: </td><td align="center"><font color="red"> ' . $Error_Message[$Code_Error] . '</font></td></tr>
                   <tr><td> ������: </td><td align="left"><font color="blue">' . $Number_String . '</font></td></tr>
                   <tr><td> �������:</td><td align="left"><font color="blue">' . $Position . '</font></td></tr></table>
                   <br><hr><br><div align="center">
                   <form  method="post" action="INTERFACE.php">
                   <input type="submit" value="    ��    " >
                   <input name="source" type="hidden" value="'.$ct_buf.'">    
                   </form></div></body></html> ');
                    break;

                Case 2 :
                   print ('<html><head><title>��������� ������ ��������������� �����������</title></head><body><br><H2 align="center">��������� ������ ��������������� �����������</H2><br><hr><br>
                   <table cellspacing="3" cellpadding="3"  align="center"><tr><td >������� ������: </td><td align="center"><font color="red"> ' . $Error_Message[$Code_Error] . '</font></td></tr>
                   <tr><td> �������: </td><td align="left"><font color="blue">' . $Number_Lexem . '</font></td></tr></table>
                   <br><hr><br><div align="center">
                   <form method="post" action="INTERFACE.php">
                   <input type="submit" value="    ��    ">
                   <input name="source" type="hidden" value="'.$ct_buf.'">    
                   </form></div></body></html> ');
                    break;
   }

} /* End Print_Error */

 /************************************************************************/
  /* Isdigit(<���C>)                                                      */
  /* ������� ���������� �������� TRUE, ���� <���C> ���������� � �����.    */
  /************************************************************************/
  Function Isdigit($Figure)
  {
    $ct_res=preg_match("/[0-9]/i", $Figure{0});
    return $ct_res;
  } /* End Isdigit */

  /************************************************************************/
  /*   Isalpha(<���C>)                                                    */
  /*   ������� ���������� �������� TRUE, ���� <���C> ���������� � �����.  */
  /************************************************************************/
  Function Isalpha($Letter)
  {

   $ct_res=preg_match("/[A-Za-z�-��-�]/i", $Letter{0});
   return $ct_res;
  } /* End Isalpha */


 /*************************************************************************/
 /* Lexical_Analyzer                                                      */
 /* ����������� ����������: ��������� ������ ������ ����������� -         */
 /* ����������� ������. ������������ �������� ��������� ������            */
 /* ��������� �� ������, ������������� � ������������� ������.           */
 /* ������:                                                               */
 /*         ������ ������;                                                */
 /*         ������ ���������������;                                       */
 /*         ������ ��������;                                              */
 /* ���������� ����������� ������ ��� �������� ����������.                */
 /* ������� ������: ����� � ���������� �� ������.                         */
 /* ���������: ������ ������, ������ ��������������� � ��������.          */
 /*************************************************************************/
 function Lexical_Analyzer()
 {
  /************************************************************************/
  /* Found_in_Table_Key_Words                                             */
  /* ������� ��������� ������ � ������� �������� ����                     */
  /* ����: Word - ��������� ����������� ����, Code - ��� ����������       */
  /*       ��������� �����                                                */
  /* �����: ������� ���������� �������� TRUE, ���� Word �������� �����, � */
  /*        FALSE - � ��������� ������. � ���������� Code ���������� ���  */
  /*        ��������� �����, ��� 0 � ��������� ������.                    */
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
   /* Found_in_Table_Identifiers(<���C>)                                  */
   /* ������� ��� �������� �������������� � ������� ���������������.      */
   /* ���������: <���C>, ���������� ��� ��������������.                   */
   /* ���������: ����� �������������� � ������� ���������������           */
   /*            ( 0 - ���� ������������� <���C> ����������� �            */
   /*            ������� ���������������).                                */
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

  /*�������  ������ ��������� �� ������ */
  function Print_Error_Message()
   {
       global $Code_Error;
                       if ($Code_Error>-1)
                       {
                        Print_Error(1);
                        return 0;
                       }
//���� ������ ���, �� ���������� ���������� ������������ �������
    End_Lexical_Analyzer();                           
   }
   //������� ������ �� ������������ �����������
   function End_Lexical_Analyzer()
   {
   global $Number_Lexems_Programm;
   global $Number_Lexem;
   global $Code_Error;
   $Number_Lexems_Programm=$Number_Lexem;

  /* ����������� ������ ��� ���������� ����� � �������� */
   Setup_Refference();

  /* �������� �� ������, ����������� � �������� ����������� ������ */
   if ($Code_Error>-1)
   {
    Print_Error(2);
    return 0;
   }

  /* ������ ������� ������� ������ */
  global $ct_milanMode;
  global $ct_buf;
  if($ct_milanMode==0)
  {
   Print_Tab_Lexems();

  /* ������ ������� �������� ��������������� � �������� */
   Print_Tab_Identifiers_Constants();

  /* �������� ����� � ���������� �� ����� ����� */
  /* ������� y10: ���������� ���������� ������ ������������ ����������� */
  global $Tab_Identifiers;
  global $Tab_Constants;
  global $ct_TabLEX_Value_str;
  global $ct_TabLEX_Code_str; 
  //���� ���� hidden ������������ ��� ���������� ������ ���������� � ���������� ������ ������������ ����������� $Tab_Constants, $Tab_Identifiers
  print (
  "<br><hr><br><div align=\"center\"><font color=\"blue\"> ���������� ���������� ������ ������������ �����������</font><br><br>
  <form  id=\"sourceform\" name=\"sourceform\" action='MILAN.PHP' method=\"post\" >
    <input name=\"source\" type=\"hidden\" value='".$ct_buf."'>                              <!--���� ������ �������� ��� ���������  --> 
    <input name=\"lex_code\" type=\"hidden\" value='".$ct_TabLEX_Code_str."'>                <!--���� ������ �������� CODE ������� ������  --> 
    <input name=\"lex_value\" type=\"hidden\" value='".$ct_TabLEX_Value_str."'>              <!--���� ������ �������� VALUE ������� ������  --> 
    <input name=\"tab_ident\" type=\"hidden\" value='" .join('%',$Tab_Identifiers). "'>       <!--���� ������ ������ ������� ��������������� -->
    <input name=\"tab_const\" type=\"hidden\" value='" .join('%',$Tab_Constants). "'>         <!--���� ������ ������ ������� �������� --> 
  <input name=\"next\" type=\"submit\" value=\"�����\" align=\"center\" size=\"40\">
  <input name=\"mode\" type=\"hidden\" value=\"1\">                                          <!--���� ������ ������� ����� ������ ������� -->    
  </form></div>  "
  );
  }
  return 0;
  }


  /************************************************************************/
  /* Letter;                                                              */
  /* ��������� ��� ��������� �������� ��������� ����� ���                 */
  /* ��������������. ��������� � ������ ������ ���� � ��������             */
  /* ������� (��������� ����� ��� ��������������).                        */
  /* ���������: ��� ����������.                                           */
  /* ���������: ��� ����������.                                           */
  /************************************************************************/
  Function Letter()
  {
  global $Input_Letter;
  global $Current_Lexem;
  global $Number_Identifiers;
  global $Position;
  global $Code_Error;
  global $Tab_Identifiers;
  /* ������ ��������� Letter */

       $Word         = '';
       $Code_Word    = 0;
       $Position_    = 0;

   /* ������� �4: ���������� �������� ��������� ����� ��� �������������� */
   $Word = $Word . $Input_Letter;

   /* ������� �1: ��������� ��������� ������ */
   Read($Input_Letter);
   $Position_++;

   /* �������� �������� ����� ��� ������������� */
   while ((Isalpha($Input_Letter)) || (Isdigit($Input_Letter))):

    /* ������� �4: ���������� �������� ��������� ����� ��� �������������� */
    $Word=$Word . $Input_Letter;

    /* ������� �1: ��������� ��������� ������ */
    Read($Input_Letter);
    $Position_++;

   endwhile;

   /* ������� �5: �������� �� �������������� */
   /* ����������� ����� � �������� ������    */
   if (Found_in_Table_Key_Words($Word, $Code_Word))
   {

    /* ������� �11: ������������ ������� */
    $Current_Lexem->Code        =    $Code_Word;
    $Current_Lexem->Value       =    0;

   }
    /* ������� �6: �������� �� �������������� */
    /* ����������� ����� � ���������������    */
    elseif (Found_in_Table_Identifiers($Word)>0)
    {

     /* ������� �11: ������������ ������� */
     $Current_Lexem->Code    =    19;
     $Current_Lexem->Value   =    Found_in_Table_Identifiers($Word);

    }
    elseif ($Number_Identifiers<MAX_IDENTIFIERS)
     {

      /* ������ ����������� ����� � ������� ��������������� */
      $Number_Identifiers++;
      $Tab_Identifiers[$Number_Identifiers]=$Word;

      /* ������� �11: ������������ ������� */
      $Current_Lexem->Code=19;
      $Current_Lexem->Value=$Number_Identifiers;

     }
     else
      /* ���������� ������������� ���������� ��������������� */
      $Code_Error=1;

   if ($Code_Error==-1)
    $Position+=$Position_;
 } /* End Letter */

  /***********************************************************************/
   /* Found_in_Table_Constants(<���C>)                                    */
   /* ������� ��� �������� ��������� � ������� ��������.                  */
   /* ���������: <���C>, ���������� ���������.                            */
   /* ���������: ����� ��������� � ������� ��������                       */
   /*            ( 0 - ���� ��������� <���C> ����������� � �������        */
   /*            ��������).                                               */
   /***********************************************************************/
   Function Found_in_Table_Constants($Constant)         
   {
   //���������� ����������
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
  /* ��������� ��� ��������� �������� ���������, �������� � �������       */
  /* �������� � ��������� � �������.                                      */
  /* ���������: ��� ����������.                                           */
  /* ���������: ��� ����������.                                           */
  /************************************************************************/
  Function Digit()
  {

  /* ������ ��������� Digit */
  //���������� ����������
   global $Current_Lexem;
   global $Code_Error;
   global $Tab_Constants;
   global $Input_Letter;
   global $Number_Constants;
   //��������� ����������
   $Constant_Value = 0;
   $Word = '';
   /* ������� �7: ���������� �������� ��������� */
   $Word = $Word . $Input_Letter;
   $Position_=0;
   /* ������� �1: ��������� ��������� ������ */
    Read($Input_Letter);
   $Position_++;

   /* �������� ��������� */
   while (Isdigit($Input_Letter)):
    /* ������� �7: ���������� �������� ��������� */
    $Word=$Word . $Input_Letter;

    /* ������� �1: ��������� ��������� ������ */
    Read($Input_Letter);
    $Position_++;

   endwhile;

   /* ������� �8: �������� �� �������������� */
   /* ���������� ��������� ������� ��������  */
   if (Found_in_Table_Constants($Word)>0)
   {
    /* ������� �11: ������������ ������� */
    $Current_Lexem->Code=20;
    $Current_Lexem->Value=Found_in_Table_Constants($Word);
   }
   elseif ($Number_Constants<MAX_CONSTANTS)
     {
      /* ������ ���������� ��������� � ������� �������� */
      $Number_Constants++;
      $Constant_Value=intval($Word);                            
      $Tab_Constants[$Number_Constants]=$Constant_Value;

      /* ������� �11: ������������ ������� */
      $Current_Lexem->Code=20;
      $Current_Lexem->Value=$Number_Constants;

     }
     else
      /* ���������� ������������� ���������� �������� */
      $Code_Error=2;

   global  $Position;
   if ($Code_Error==-1)
    $Position=$Position+$Position_;

    return 0;
  } /* End Digit */

  /************************************************************************/
  /* Setup_Refference                                                     */
  /* ��������� ����������� ������:                                        */
  /*                               DO-->ENDDO+1, ENDDO-->WHILE+1          */
  /*                               THEN-->ELSE+1                          */
  /*                               THEN-->ENDIF+1, ELSE-->ENDIF+1         */
  /* ���������: ������ ������.                                            */
  /* ���������: ������ ������ � �������������� ��������.                  */
  /************************************************************************/
  function Setup_Refference()
  {
     /* ������� y0: ���������� (������������� ������ � ����������),         */
    /* ����� ��������� ������� Number_Lexem=1, ��������� ������� � ������� */
    /* Number_Lexem                                                        */
    //���������� ����������
    global $Number_Lexem;
    global $Tab_Lexems;
    global $Code_Error;
    global $Number_Lexems_Programm;
    //��������� ����������
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

                            /* ������� y1: �������� $Number_Lexem ������� */
                            /* ���� $Stek_do ($Number_Lexem-->$Stek_do)     */
                            if (!Stek_Integer(2,$Stek_do,$Top_do,$Number_Lexem))
                             {
                              /* ������������ ����� DO*/
                              $Code_Error=4;
                              return 0;
                             }

                            /* ������� y7: $Number_Lexem++, */
                            /* ��������� ��������� ������� � �������  $Number_Lexem */  
                            $Number_Lexem++;

                            while ($Tab_Lexems[$Number_Lexem]->Code!=_DO_):

                             /* ������� y7: Number_Lexem=Number_Lexem+1, */
                             /* ��������� ��������� ������� � �������  $Number_Lexem */
                             $Number_Lexem++;

                             if ($Number_Lexem>$Number_Lexems_Programm)
                             {
                              /* �������������� � ���������� WHILE-DO-OD */
                              $Code_Error=10;
                              return 0;
                             }

                            endwhile;

                            /* ������� y1: �������� $Number_Lexem ������� */
                            /* ���� $Stek_do ($Number_Lexem-->$Stek_do)     */
                            if (!Stek_Integer(2,$Stek_do,$Top_do,$Number_Lexem))
                             {
                              /* ������������ ����� DO */
                              $Code_Error=4;
                              return 0;
                             }

                           break;
               Case  _ENDDO_ :

                            /* ������� y2: ����� ������� ����� $Stek_do �   */
                            /* ���������� $s ($s<--$Stek_do), ����� �������   */
                            /* ����� $Stek_do � ���������� $r ($r<--$Stek_do), */
                            /* �������� $r+1 ��������� �������              */
                            /* � ������� $Number_Lexem [ENDDO-->WHILE+1]    */
                            /* ($Tab_Lexems[$Number_Lexem]->Value=r+1),       */
                            /* �������� Number_Lexem+1 ��������� �������   */
                            /* � ������� s  [DO-->ENDDO+1]                 */
                            /* ($Tab_Lexems[$s]->Value=$Number_Lexem+1.        */
                            if (!Stek_Integer(1,$Stek_do,$Top_do,$s))
                             {
                              /* �������� ��������� � ����� DO */
                              $Code_Error=5;
                              return 0;
                             }
                            if (!Stek_Integer(1,$Stek_do,$Top_do,$r))
                             {
                              /* �������� ��������� � ����� DO */
                              $Code_Error=5;
                              return 0;
                             }

                            /* ENDDO-->WHILE+1*/
                            $Tab_Lexems[$Number_Lexem]->Value=$r+1;

                            /* DO-->ENDDO+1 */
                            $Tab_Lexems[$s]->Value=$Number_Lexem+1;

                           break;
               Case  _IF_ :
                            /* ������� y7: $Number_Lexem++, */
                            /* ��������� ��������� ������� � �������  $Number_Lexem */  
                            $Number_Lexem++;

                            while ($Tab_Lexems[$Number_Lexem]->Code!=_THEN_):
                             /* ������� y7: $Number_Lexem++, */
                             /* ��������� ��������� ������� � �������  $Number_Lexem */  
                             $Number_Lexem++;

                            if ($Number_Lexem>$Number_Lexems_Programm)
                             {
                              /* ��������������  ���������� IF-THEN-ELSE-ENDIF */
                              $Code_Error=11;
                              return 0;
                             }

                            endwhile;

                            /* ������� y3: �������� $Number_Lexem ������� */
                            /* ���� $Stek_if ($Number_Lexem-->$Stek_if)     */
                            if (!Stek_Integer(2,$Stek_if,$Top_if,$Number_Lexem))
                             {
                              /* ������������ ����� IF */
                              $Code_Error=7;
                              return 0;
                             }
                           break;

               Case   _ELSE_ :

                            /* ������� y4: ����� ������� ����� $Stek_if �   */
                            /* ���������� $r ($r<--$Stek_if), ���������       */
                            /* �������� $Number_Lexem+1 ������� c �������   */
                            /* r [THEN-->ELSE+1]                           */
                            /* ($Tab_Lexems[$r]->Value=$Number_Lexem+1),       */
                            /* ������� � $Stek_ if �������� Number_Lexem    */
                            /* ($Number_Lexem-->$Stek_if)                    */
                            if (!Stek_Integer(1,$Stek_if,$Top_if,$r))
                             {
                              /* �������� ��������� � ����� IF */
                              $Code_Error=8;
                              return 0;
                             }

                            /* THEN-->ELSE+1 */
                            $Tab_Lexems[$r]->Value=$Number_Lexem+1;

                            if (!Stek_Integer(2,$Stek_if,$Top_if,$Number_Lexem))
                             {
                              /* ������������ ����� IF */
                              $Code_Error=7;
                              return 0;
                             }
                           break;

              Case  _ENDIF_ :

                            /* ������� y5: ����� ������� ����� $Stek_if �   */
                            /* ���������� $r ($r<--$Stek_if), ���������       */
                            /* �������� $Number_Lexem+1 ������� c �������   */
                            /* $r [THEN-->ENDIF+1, ELSE-->ENDIF+1]          */
                            /* ($Tab_Lexems[$r]->Value=$Number_Lexem+1)        */
                            /* ������� � $Stek_ if �������� Number_Lexem    */
                            /* ($Number_Lexem-->$Stek_if)                    */
                            if (!Stek_Integer(1,$Stek_if,$Top_if,$r))
                             {
                              /* �������� ��������� � ����� IF */
                              $Code_Error=8;
                              return 0;
                             }

                            /* THEN-->ENDIF+1, ELSE -->ENDIF+1 */
                            $Tab_Lexems[$r]->Value=$Number_Lexem+1;
                           break;

     endswitch;

     /* ������� y7: $Number_Lexem++, */
     /* ��������� ��������� ������� � �������    */
     $Number_Lexem++;
    }
    while ($Number_Lexem<=$Number_Lexems_Programm);

    if ($Top_if!=0)
    {
     /* �������������� � ���������� IF-THEN-ELSE-ENDIF */
     $Code_Error=11;
    }

    if ($Top_do!=0)
    {
     /* �������������� � ���������� WHILE-DO-OD */
     $Code_Error=10;
    }
   } /* End Setup_Refference */

  /************************************************************************/
  /* Print_Tab_Lexems                                                     */
  /* ��������� ������ ������� ������� ������.                             */
  /* ���������: ��� ����������.                                           */
  /* ���������: ������������ �� ������ �������.                           */
  /************************************************************************/
   
 Function Print_Tab_Lexems()
 {
       $Number  =   '';
       $Number_ =   '';
       $Zastav  =   '';      /* ����� ������� ������� ������ */
       $TabLex  =   '';      /* ������� ������� ������ */
       global $Number_Lexems_Programm;
       global $Tab_Lexems;
       global $ct_TabLEX_Code_str;
       global $ct_TabLEX_Value_str;  
     echo '<br><H2> <div align="center">��������� ������ ������������ �����������</div></H2><br><hr><br>';
   /* ������ ��������� Print_Tab_Lexems */
   /* ������������ ����� ������� ������� ������ */
    $Zastav  = '<table border=1 width="450" align="center"><tr><td colspan=19><div align="center">� � � � � � � &nbsp; � � � � � �</div></td></tr>';
    $Zastav  .= '<tr><td> ����� </td>';
    $End=intval($Number_Lexems_Programm /10)+1;
     for ($i=0;$i<=9;$i++)
     {
      $Zastav .='<td align="center"> ' . $i . '</td>';
     }
    $Zastav  .= '</tr>';

    /* ������ ������� ������� ������ */
     /* ����� ����������� ������� */
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
  /* ��������� ������ ������� �������� ��������������� � ��������.        */
  /* ���������: ��� ����������.                                           */
  /* ���������: ������������ �� ������ ������.                            */
  /************************************************************************/
  Function Print_Tab_Identifiers_Constants()
  {
       $Number='';
       $Number_='';
       /* ������� �������� ��������������� � �������� */
       $Tab_Identifiers_Constants = '';
       global $Tab_Constants;
       global $Tab_Identifiers;
       global $Number_Identifiers;
       global $Number_Constants;      
    /* ������ ��������� Print_Tab_Identifiers_Constatns */

    /* ������������ ������� ������� ��������������� */
    $Tab_Identifiers_Constants  = '<br><br><table border=1 width="450" align="center"><tr><td colspan=2 align="center">������ ���������������&nbsp;</td></tr>';
    $Tab_Identifiers_Constants  .= '<tr><td align="center"> ����� </td><td align="center"> ������������� </td></tr>';

    for($i=1;$i<=$Number_Identifiers;$i++)
     {
       $Tab_Identifiers_Constants .=  '<tr><td  align="center">' . $i . '</td><td  align="center">' . $Tab_Identifiers[$i] . '</td></tr>';
       
     }  
     
     /* ������������ ������� ������� �������� */
     $Tab_Identifiers_Constants  .= '</table><br><br><table border=1 width="450" align="center"><tr><td colspan=2 align="center">������ ��������&nbsp;</td></tr>';
     $Tab_Identifiers_Constants  .= '<tr><td align="center"> ����� </td><td align="center"> ��������� </td></tr>';
    for($i=1;$i<=$Number_Constants;$i++)
     {
       $Tab_Identifiers_Constants .=  '<tr><td  align="center">' . $i . '</td><td  align="center">' . $Tab_Constants[$i] . '</td></tr>';
     }

        $Tab_Identifiers_Constants  .= '</table>';
    echo($Tab_Identifiers_Constants);
 } /* Print_Tab_Identifiers_Constants */

  /* �������� ���� ������������ ����������� */

  /* ������� �0: ���������� (������������� ������ � ����������) */
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
  /* ������� �1: ������ ���������� ������� ��������� �� ����� ����� */

  if (Read($Input_Letter)==0)
  {
   echo('������: ����������� ������ ��� �������.');
   exit;                                            // ���������� ������ ��������������
  }
  $Position=0;
  $Number_String=1;
  $ct_spec= '/['.Chr(9). Chr(10).Chr(13). Chr(32).']/i';

  do
  {
   /* ������������� ����. �������� � ������� */
   while (preg_match($ct_spec,$Input_Letter{0}) )
   {
    switch (ord($Input_Letter{0})):

    case 9  :  /* ������� y2: ���������� �������� ������� �������   */
               /* ($Position=$Position+1)                           */
               $Position++;
               break;
    case 13 :
                /* ������� y3: ������� �� ����� ������ � ���������,   */
                /* ���������� �������� ������� ������, � �����        */
                /* �������� ������� ( $Number_String=$Number_String+1,*/
                /* Position=0)                                        */
                $Number_String++;
                $Position=0;
               break;

    case 32 : /* ������� y2: ���������� �������� ������� ������� $Position++ */

               $Position++;
               break;
    endswitch;

    /* ������� �1: ������ ���������� ������� ��������� �� ����� ����� */
    Read($Input_Letter);
   }
   
      if(isAlpha($Input_Letter{0}))      // ���� �������� ������ �������� ������
        Letter();
    elseif(isDigit($Input_Letter{0}))  // ���� �������� ������ �������� ������
        Digit();
    else
  {
   switch ($Input_Letter{0}):

    Case ';'          :
                            /* ������� �11: ������������ ������� */
                            $Current_Lexem->Code=12;
                            $Current_Lexem->Value=0;

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case '='         :
                              /* ������� �11: ������������ ������� */
                            $Current_Lexem->Code=13;
                            $Current_Lexem->Value=0;

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                            break;

    Case '>'         :
                             /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                            if ($Input_Letter=='=')
                            {

                             /* ������� �11: ������������ ������� */
                             $Current_Lexem->Code=13;
                             $Current_Lexem->Value=4;

                             /* ������� �1: ������ ���������� ������� */
                             Read($Input_Letter);
                             $Position++;

                            }
                            else
                            {

                             /* ������� �11: ������������ ������� */
                             $Current_Lexem->Code=13;
                             $Current_Lexem->Value=2;

                            }
                            break;

    Case '<'         :
                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                            switch ($Input_Letter):
                            case '>'   :

                                      /* ������� �11: ������������ ������� */
                                      $Current_Lexem->Code=13;
                                      $Current_Lexem->Value=1;

                                      /* ������� �1: ������ ���������� ������� */
                                      Read($Input_Letter);
                                      $Position=$Position+1;

                                      break;

                            case  '=' :

                                      /* ������� �11: ������������ ������� */
                                      $Current_Lexem->Code=13;
                                      $Current_Lexem->Value=5;

                                      /* ������� �1: ������ ���������� ������� */
                                      Read($Input_Letter);
                                      $Position=$Position+1;

                                      break;
                            default:

                                      /* ������� �11: ������������ ������� */
                                      $Current_Lexem->Code=13;
                                      $Current_Lexem->Value=3;
                                      break; 
                           endswitch;
                           break;
    Case '+'          :

                            /* ������� �11: ������������ ������� */
                            $Current_Lexem->Code=14;
                            $Current_Lexem->Value=0;

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case '-'          :

                            /* ������� �11: ������������ ������� */
                            $Current_Lexem->Code=14;
                            $Current_Lexem->Value=1;

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case '*'          :

                            /* ������� �11: ������������ ������� */
                            $Current_Lexem->Code=15;
                            $Current_Lexem->Value=0;

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case '/'          :

                            /* ������� �11: ������������ ������� */
                            $Current_Lexem->Code=15;
                            $Current_Lexem->Value=1;

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                             $Position++;

                           break;

    Case ':'          :

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                            if ($Input_Letter=='=')
                             {

                              /* ������� �11: ������������ ������� */
                              $Current_Lexem->Code=16;
                              $Current_Lexem->Value=0;

                              /* ������� �1: ������ ���������� ������� */
                              Read($Input_Letter);
                               $Position++;

                             }
                            else
                             /* ������������ ������ � ��������� */
                             $Code_Error=0;
                           break;

    Case '('          :

                            /* ������� �11: ������������ ������� */
                            $Current_Lexem->Code=17;
                            $Current_Lexem->Value=0;

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                           break;

    Case ')'          :

                            /* ������� �11: ������������ ������� */
                            $Current_Lexem->Code=18;
                            $Current_Lexem->Value=0;

                            /* ������� �1: ������ ���������� ������� */
                            Read($Input_Letter);
                            $Position++;

                            break;

                           /* ������� ����� ��������� */
    Case  Chr(26)     :
                            End_Lexical_Analyzer();
                            return 0;

     default:             /* ������������ ������ � ��������� */
                           $Code_Error=0;

   endswitch;
  }
   /* ������������ ������� ������ */
   if ($Number_Lexem+1>MAX_LEXEMS)
    $Code_Error=3;

   /* �������� �� ������ */
   if ($Code_Error>-1)
   {
    Print_Error_Message();
    return 0;
   }
   /* ������� �9: ������ �������������� ������� � ������ ������ */
   $Number_Lexem++;
   $Tab_Lexems[$Number_Lexem]->Code=$Current_Lexem->Code;
   $Tab_Lexems[$Number_Lexem]->Value=$Current_Lexem->Value;
 }while (TRUE);
}


 /*************************************************************************/
 /* Syntactical_Analyzer                                                  */
 /* ��������� ��������������� �������, ����������� �� �������             */
 /* ��������� ��������.                                                   */
 /* ������� ������: ������ ������ (����� �������),                        */
 /*                 ������ ��������������� (����� �������),               */
 /*                 ������ �������� (����� �������).                      */
 /*                                                                       */
 /* �������� ������: ���������� ��������� �� ����� �����.                 */
 /*                                                                       */
 /* ��������� ����������� ����� �������������� �����������:               */
 /*               ProcedureL, ProcedureS, ProcedureB, ProcedureE,         */
 /*               ProcedureT, ProcedureP.                                 */
 /* ��������� Syntactical_Analyzer ���������� �����:                      */
 /*               $StekRes - ���� ����������� ����������;                  */
 /*               $StekIdent - ���� ���������������;                       */
 /*               $StekMul - ���� ��� �������� ���� ���������;             */
 /*               $StekSum - ���� ��� �������� ���� ��������;              */
 /*               $StekRel - ���� ��� �������� ���� ���������.             */
 /*************************************************************************/
 //���������� ���������� ����������
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
 /* ��������� ProcedureP - ��������� ����������� <���������>              */
 /* <���������>::=<�������������>|<���������>|READ|(<���������>)          */
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
                   /*  y1: ��������� � ���� StekRes ��������������  $Tab_Lexems[$Number_Lexem]->Value */ 
                   
                   $NomIdent=$Tab_Lexems[$Number_Lexem]->Value;
                   if (!Stek_Integer(2, $StekRes, $TopRes, $ArrIdent[$NomIdent]))
                   {
                    /* ������������ ����� $StekRes */
                    $Code_Error=26;
                    return 0;
                   }

                   /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
                   $Number_Lexem++;

                   return 0;
                   break;
     Case _CONSTANT_ :

                   $NomIdent=$Tab_Lexems[$Number_Lexem]->Value;
                   /*  y2: ��������� � ���� $StekRes ��������� $Tab_Lexems[$Number_Lexem].Value;*/
                   if (!Stek_Integer(2, $StekRes, $TopRes, $Tab_Constants[$NomIdent]))
                   {
                    /* ������������ ����� $StekRes */
                    $Code_Error=26;
                    return 0;
                   }

                   /* ������� y4: ������ ��������� ������� */
                   /* ($Number_Lexem++)        */
                   $Number_Lexem++;

                  return 0;
                   break;
      Case _READ_ :

                   /* y3: ��������� ����� ����� �� ����� � ���������� */
                   /* $Cifra � �������� ��� � $StekRes ($Cifra-->$StekRes),*/

                   /* ������ ������ ����� �� ����� */
                   global $ct_buf;
                   global $ct_readBUF;            //$ct_readBUF - ���������� �������� ������ ��� ������ ������ ���� "1%2%11"
                   global $ct_readCount;
                   global $Tab_Identifiers;
                   global $Tab_Constants;
                   global $ct_TabLEX_Value_str;
                   global $ct_TabLEX_Code_str; 
                   $len = count($ct_readBUF);     //���������� ��������� � ������� $ct_readBUF

                   if($ct_readCount>=$len)
                   {  
                   echo('<html>
                   <head>
                   <title>��������� ���� ������ �� ������������:</title>
                   </head>
                   <body>
                   <br><h2>����� ��� ����� ������</h2> ������ �: '.($len+1).'<hr><br>');

                   echo('������� ����� �����:<br><br> ');
                   echo ('<script type="text/javascript">
                            function ScanForInt()                                                            <!--javascript ��� ���������-->
                            {
                                var x=inputform.stdin.value;                                                 <!--�������� ������� �������� �������� �� ���� ����� � ������ "stdin"  � ���������� "x"-->
                                for(i=0;i<=x.length;i++)                                                     <!--���� ��� ������� �� ���� ������ "x"-->
                                {
                                var s=x.substr(i).charCodeAt();                                              <!--�������� ASCII ��� i-��� �������--> 
                                    if(s<48 || s>57)                                                         <!--�������� ����� (48..57) ������������ � ������� ASCII - ����� ������ �� 0..9 -->
                                    {
                                          alert("������� ����� �����");                                      <!--����� ��������� ������������ -->
                                          return false;                                                      <!--������� �� ������� -->
                                    }
                                }
                                return x.length>0;                                                           <!--���������� TRUE, ���� ����� ������ 0, ����� FALSE -->
                            }                                                    
                            </script>
                            <form name="inputform" action="milan.php" method="POST">
                            <input type="text" name="stdin" />                                               <!--� ���� � ������ "stdin" �������� �������� ������������� ����� -->
                              <input name="source" type="hidden" value="'.$ct_buf.'"/>                       <!--���������� ��� �������� ��������� ���� ��������� MILAN -->
                              <input name="lex_code" type="hidden" value="'.$ct_TabLEX_Code_str.'">                <!--���� ������ �������� CODE ������� ������  --> 
                              <input name="lex_value" type="hidden" value="'.$ct_TabLEX_Value_str.'">              <!--���� ������ �������� VALUE ������� ������  --> 
                              <input name="tab_ident" type="hidden" value="' .join('%',$Tab_Identifiers). '">       <!--���� ������ ������ ������� ��������������� -->
                              <input name="tab_const" type="hidden" value="' .join('%',$Tab_Constants). '">         <!--���� ������ ������ ������� �������� --> 
                              <input name="readbuf" type="hidden" value="'. join("%",$ct_readBUF) .'"/>      <!--������� join("%",$ct_readBUF) ����������� ������ ������ � ������ ���������� "%" -->
                              <input name="mode" type="hidden" value="2">                                    <!--���� ������ ������� ����� ������ �������-->
                                                                
                              <!--������ ��� �������� ������ � ������ "milan.php", � ������ ��������� �������� "TRUE" �� ������� ScanForInt() -->
                            <input type="button" name="send" value="���������" onclick="if(ScanForInt())inputform.submit()">  
                            </form>    </body></html>');
                   exit;             //!!  ������������ ���������� ������ �������������� � �������� ����� ������ 
                   }              
                   $Cifra=$ct_readBUF[$ct_readCount++];


                   if (!Stek_Integer(2, $StekRes, $TopRes, $Cifra))
                   {
                    /* ������������ ����� $StekRes */
                    $Code_Error=26;
                    return 0;
                   }

                   /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
                   $Number_Lexem++;

                  break;

     Case  _LPAREN_ :

                   /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
                   $Number_Lexem++;

                   /* ��������� ����������� <���������> */
                   ProcedureE();

                   /* �������� �� ������, ����������� � �������� ��������� ����������� <���������>*/
                   if ($Code_Error!=-1)
                    return 0;

                   if ($Tab_Lexems[$Number_Lexem]->Code==_RPAREN_)
                   {
                    /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
                    $Number_Lexem++;
                   }
                   else
                   {
                    /* ����������� <���������>. ��� ����������� ������. */
                    $Code_Error=30;
                   return 0;
                   }
  endswitch;
  return 0;
 } /* End ProcedureP */

 /*************************************************************************/
 /* ��������� ProcedureT - ��������� ����������� <����>                   */
 /* <����>::=<���������>|<���������><�������� ���� ���������><���������>  */
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

  /* ��������� ����������� ��������� */
  ProcedureP();

  /* �������� �� ������, ����������� � �������� */
  /* ��������� ����������� <���������>          */
  if ($Code_Error!=-1)
   return 0;

  while (TRUE)
  {
   if ($Tab_Lexems[$Number_Lexem]->Code == _MUL_)    
   {

    /* y5: ��������� � ���� $StekMul �������� �������� ���� ��������� */
    /* $Tab_Lexems[$Number_Lexem]->Value-->StekMul                      */
    if (!Stek_Integer(2, $StekMul, $TopMul, $Tab_Lexems[$Number_Lexem]->Value))
    {
     /* ������������ ����� $StekMul */
     $Code_Error=28;
     return 0;
    }

    /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
    $Number_Lexem++;

    /* ��������� ����������� <���������> */
    ProcedureP();

    /* �������� �� ������, ����������� � �������� */
    /* ��������� ����������� <���������>          */
    if ($Code_Error!=-1)
     return 0;

    /* y6: � ���������� $Bi ����� ������� �� ����� $StekRes ($Bi<--$StekRes), */
    /* � ���������� $Ai ����� ������� �� ����� $StekRes ($Ai<--$StekRes),     */
    /* � ���������� kmul ����� ������� �� ����� $StekMul ($kmul<--$StekMul), */
    /* ��������� �������� ���� ��������� $Ai otu($kmul) $Bi � ���������      */
    /* ������� � ���� $StekRes                                             */

    if (!Stek_Integer(1, $StekRes, $TopRes,$Bi))
    {
     /* �������� ��������� � ����� $StekRes */
     $Code_Error=16;
     return 0;
    }

    if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
    {
     /* �������� ��������� � ����� $StekRes */
     $Code_Error=16;
     return 0;
    }

    if (!Stek_Integer(1, $StekMul, $TopMul, $kmul))
    {
     /* �������� ��������� � ����� $StekMul */
     $Code_Error=27;
     return 0;
    }

    /* ���������� ��������� */
     $c=$Ai*$Bi;
     $mode= _SLASH_;
    if ($kmul==$mode)
    {

     if ($Bi!=0)
     {
      $c=intval($Ai / $Bi);             //�������� $c ����� ����� �� ������� $Ai � $Bi
     }
     else
     {
      /* ������� �� ���� */
      $Code_Error=29;
      return 0;
     }
    }
    /* ��������� ���������� � ���� $StekRes */
    if (!Stek_Integer(2, $StekRes, $TopRes, $c))
    {
     /* ������������ ����� $StekRes */
     $Code_Error=26;
     return 0;
    }

   }
   return 0;
  }
 }
 /* End ProcedureT */

 /*************************************************************************/
 /* ��������� ProcedureE - ��������� ����������� <���������>              */
 /* <���������>::=<����>|<�������� ���� ��������><����> |                 */
 /*               <����><�������� ���� ��������><����>  |                 */
 /*    <�������� ���� ��������><����><�������� ���� ��������><����>       */
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
   /* y7: ��������� � ���� $StekSum ���� �������� ���� �������� */
   if (!Stek_Integer(2, $StekSum, $TopSum, $Tab_Lexems[$Number_Lexem]->Value))
   {
    /* ������������ ����� $StekSum */
    $Code_Error=31;
    return 0;
   }

   /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
   $Number_Lexem++;

   /* ��������� ����������� <����> */
   ProcedureT();

   /* �������� �� ������, ����������� � �������� */
   /* ��������� ����������� <����>               */
   if ($Code_Error!=-1)
    return 0;

   /* y8: � ���������� ksum ����� �� ����� $StekSum ��������    */
   /* ������� ots ($ksum<--$StekSum), ���� ksum=1, �� �����      */
   /* � ���������� Ai ������� �� ����� $Stekres ($Ai<--$StekRes), */
   /* ������� ���� ����� ����� � ������� ��� � ���� $StekRes    */
   /* -$Ai-->$StekRes                                            */
   if (!Stek_Integer(1, $StekSum, $TopSum, $ksum))
   {
    /* �������� ��������� � ����� $StekSum */
    $Code_Error=32;
    return 0;
   }
   if ($ksum!=_PLUS_)
   {
    if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
    {
     /* �������� ��������� � ����� $StekRes */
     $Code_Error=16;
     return 0;
    }

    $Ai=-$Ai;

    if (!Stek_Integer(2, $StekRes, $TopRes, $Ai))
    {
     /* ������������ ����� $StekRes */
     $Code_Error=26;
     return 0;
    }
   }
  }

  /* ������ ���������� �������� �������� */

  /* ��������� ����������� <����> */
  ProcedureT();
  /* �������� �� ������, ����������� � �������� */
  /* ��������� ����������� <����>               */
  if ($Code_Error!=-1)
   return 0;

  while (TRUE):
   if ($Tab_Lexems[$Number_Lexem]->Code==_SUMM_)
   {
    /* y9: ��������� � ���� $StekSum ���� �������� ���� �������� */
    if (!Stek_Integer(2, $StekSum, $TopSum, $Tab_Lexems[$Number_Lexem]->Value))
    {
     /* ������������ ����� $StekSum */
     $Code_Error=31;
     return 0;
    }

   /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
   $Number_Lexem++;

   /* ��������� ����������� <����> */
   ProcedureT();

   /* �������� �� ������, ����������� � �������� */
   /* ��������� ����������� <����>               */
   if ($Code_Error!=-1)
    return 0;

    /* y10: � ���������� $Bi ����� ������� �� ����� $StekRes ($Bi<--$StekRes),*/
    /* � ���������� $Ai ����� ������� �� ����� $StekRes ($Ai<--$StekRes),     */
    /* � ���������� ksum ����� ������� �� ����� $StekSum ($ksum<--$StekSum), */
    /* ��������� �������� ���� �������� $Ai ots($ksum) $Bi � ���������       */
    /* ������� � ���� $StekRes                                             */

    if (!Stek_Integer(1, $StekRes, $TopRes, $Bi))
    {
     /* �������� ��������� � ����� $StekRes */
     $Code_Error=16;
     return 0;
    }

    if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
    {
     /* �������� ��������� � ����� $StekRes */
     $Code_Error=16;
     return 0;
    }

    if (!Stek_Integer(1, $StekSum, $TopSum, $ksum))
    {
     /* �������� ��������� � ����� $StekSum */
     $Code_Error=32;
     return 0;
    }

    $c=$Ai+$Bi;

    if ($ksum!=_PLUS_)
     $c=$Ai-$Bi;

    /* ��������� ���������� � ���� $StekRes */
    if (!Stek_Integer(2, $StekRes, $TopRes, $c))
    {
     /* ������������ ����� $StekRes */
     $Code_Error=26;
     return 0;
    }
   }
   return 0;
  endwhile;

 } /* End ProcedureE */

 /*************************************************************************/
 /* ��������� ProcedureB - ��������� ����������� <�������>                */
 /* <�������>::=<���������><���� ���������><���������>                    */
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

  /* ��������� ����������� <���������> */
  ProcedureE();

  /* �������� �� ������, ����������� � �������� */
  /* ��������� ����������� <���������>          */
  if ($Code_Error!=-1)
   return 0;

  if ($Tab_Lexems[$Number_Lexem]->Code==_RELATION_)
  {

   /* y11: ���������� � ���� $StekRel �������� �������� ���� ��������� */
   /* ($Tab_Lexems[$Number_Lexem]->Value-->$StekRel)                      */
   if (!Stek_Integer(2, $StekRel, $TopRel, $Tab_Lexems[$Number_Lexem]->Value))
   {
    /* ������������ ����� $StekRel */
    $Code_Error=24;
    return 0;
   }

   /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
   $Number_Lexem++;

   /* ��������� ����������� <���������> */
   ProcedureE();

   /* �������� �� ������, ����������� � �������� ��������� ����������� <���������> */
   if ($Code_Error!=-1)
     return 0;

   /* y12: � ���������� Bi ����� ������� �� ����� $StekRes ($Bi<--$StekRes),*/
   /* � ���������� $Ai ����� ������� �� ����� StekRes ($Ai<--$StekRes),     */
   /* � ���������� $krel ����� ������� �� ����� $StekRel (krel<--$StekRel), */
   /* ��������� �������� ��������� $Ai otn($krel) Bi � ��������� �������   */
   /* � ���� $StekRes ([0, 1]-->$StekRes)                                  */
   if (!Stek_Integer(1, $StekRes, $TopRes, $Bi))
   {
    /* �������� ��������� � ����� $StekRes */
    $Code_Error=16;
    return 0;
   }

   if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
   {
    /* �������� ��������� � ����� $StekRes */
    $Code_Error=16;
    return 0;
   }

   if (!Stek_Integer(1, $StekRel, $TopRel, $krel))
   {
    /* �������� �������� � ����� $StekRel */
    $Code_Error=25;
    return 0;
   }

   /* ���������� ��������� */

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

   /* ��������� ���������� � ���� $StekRes */
   if (!Stek_Integer(2, $StekRes, $TopRes, $c))
   {
    /* ������������ ����� $StekRes */
    $Code_Error=26;
    return 0;
   }

  }
  else
  {
   /* ����������� <�������>. �������� �������� ���������. */
   $Code_Error=23;
   return 0;
  }
    return 0;
 } /* End ProcedureB */

 /*************************************************************************/
 /* ��������� ProcedureS - ��������� �����������                          */
 /* <��������>::=<�������������>:=<���������> | OUTPUT(<���������>) |     */
 /*             WHILE <�������> DO <������������������ ����������> ENDDO| */
 /*             IF <�������> THEN <������������������ ����������> ENDIF | */
 /*                                <������������������ ����������> ENDIF  */
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

   /* ��������� ��������� ������������ */
   /* <�������������>:=<���������>     */
   case _IDENTIFIER_ :

                    /* y13:�������� �������� ������� � ������� $Number_Lexem */
                    /* � ���� $StekIdent ($Tab_Lexems[$Number_Lexem]->Value-->$StekIdent)*/                                       
                    if (!Stek_Integer(2, $StekIdent, $TopIdent,$Tab_Lexems[$Number_Lexem]->Value))
                    {
                     /* ������������ ����� $StekIdent */
                     $Code_Error=14;
                     Exit;
                    }

                    /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                    $Number_Lexem++;

                    if ($Tab_Lexems[$Number_Lexem]->Code==_ASSIGNMENT_)
                    {

                     /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                     $Number_Lexem++;

                     /* ��������� ����������� <���������> */
                     ProcedureE();

                     /* �������� �� ������, ����������� � ��������            */
                     /* ��������� ����������� <���������>                     */
                     if ($Code_Error!=-1)
                      return 0;

                    }
                    else
                    {
                     /* ����������� <��������>. �������� ������������.*/
                     $Code_Error=15;
                     return 0;
                    }

                    /* y14: � ���������� $Ai ����� ������� �� ����� $StekRes*/
                    /* ($Ai<--$StekRes), � ���������� $Bi ����� �� �����     */
                    /* $StekIdent �������� ������� ident ($Bi<--$StekIdent), */
                    /* �������������� � ������� $Bi, ��������� �������� $Ai */
                    /* $ArrIdent[$Bi]=$Ai                                   */
                    if (!Stek_Integer(1, $StekRes, $TopRes,$Ai))
                    {
                     /* �������� ��������� � ����� $StekRes */
                     $Code_Error=16;
                     return 0;
                    }
                    if (!Stek_Integer(1, $StekIdent, $TopIdent, $Bi))
                    {
                     /* �������� ��������� � ����� $StekIdent */
                     $Code_Error=17;
                     return 0;
                    }
                    $ArrIdent[$Bi]=$Ai;

                   break;

   case _OUTPUT_ :

                    /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
                    $Number_Lexem++;

                    if ($Tab_Lexems[$Number_Lexem]->Code==_LPAREN_)
                    {

                     /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                     $Number_Lexem++;

                     /* ��������� ����������� <���������> */
                     ProcedureE();

                     /* �������� �� ������, ����������� � ��������      */
                     /* ��������� ����������� <���������>               */
                     if ($Code_Error!=-1)
                      return 0;

                    }
                    else
                    {
                     /* ����������� <��������>.�������� �������� OUTPUT.*/
                     $Code_Error=18;
                     return 0;
                    }

                    if ($Tab_Lexems[$Number_Lexem]->Code==_RPAREN_)
                    {

                     /* ������� y4: ������ ��������� �������  ($Number_Lexem++)  */
                     $Number_Lexem++;

                     /* y15: � ���������� $Ai ����� ������� �� ����� StekRes */
                     /* ($Ai<--$StekRes), ���������� ���������� $Ai         */
                     if (!Stek_Integer(1, $StekRes,$TopRes, $Ai))
                     {
                      /* �������� ��������� � ����� $StekRes */
                      $Code_Error=16;
                      return 0;
                     }

                  echo('
                   <br>
                   <hr>
                   <br>
                   �����:  ' . $Ai . '
                   <br>
                     ');
                    }
                    else
                    {
                     /* ����������� <��������>. �������� �������� OUTPUT.*/
                     $Code_Error=18;
                     return 0;
                    }

                   break;

   case _WHILE_ :
                    /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
                    $Number_Lexem++;

                    while (TRUE)
                    {

                     /* ��������� ����������� <�������> */
                     ProcedureB();

                     /* �������� �� ������, ����������� � ��������   */
                     /* ��������� ����������� <�������>              */
                     if ($Code_Error!=-1)
                      return 0;

                     /* y16: � ���������� $Ai ����� ������� �� ����� StekRes */
                     /* ($Ai<--$StekRes), ���� $Ai=1, �� ��� ������, ����� - ���� */

                     if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
                     {
                      /* �������� ��������� � ����� $StekRes */
                      $Code_Error=16;
                      return 0;
                     }

                     if ($Tab_Lexems[$Number_Lexem]->Code==_DO_)
                     {
                      /* �������� ���������� �������: $Ai==1 (TRUE), */
                      /* $Ai==0 (FALSE)                              */
                      if ($Ai==1) /* ��������� TRUE */
                      {
                       /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                       $Number_Lexem++;

                       /* ��������� �����������           */
                       /* <������������������ ����������> */
                       ProcedureL();

                       /* �������� �� ������, ����������� � ��������   */
                       /* ��������� �����������                        */
                       /* <������������������ ����������>              */
                       if ($Code_Error!=-1)
                        return 0;

                       if ($Tab_Lexems[$Number_Lexem]->Code==_ENDDO_)
                       {
                        /* y17: ������� �� ������� �����       */
                        /* $Tab_Lexems[$Number_Lexem]->Value      */
                        $Number_Lexem=$Tab_Lexems[$Number_Lexem]->Value;
                        Continue;
                       }
                       else
                       {
                        /* ����������� <��������>. �������� �������� WHILE. */
                        $Code_Error=19;
                        return 0;
                       }
                      }
                      else    /* ��������� FALSE */
                      {
                       /* ������� �� ������� ����� $Tab_Lexems[$Number_Lexem]->Value  */
  
                       $Number_Lexem=$Tab_Lexems[$Number_Lexem]->Value;
                       return 0;
                      }
                     }
                     else
                     {
                      /* ����������� <��������>. �������� �������� WHILE. */
                      $Code_Error=19;
                      return 0;
                     }
                    }

                   break;

     case _IF_ :
                     /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                     $Number_Lexem++;

                     /* ��������� ����������� <�������> */
                     ProcedureB();

                     /* �������� �� ������, ����������� � �������� */
                     /* ��������� ����������� <�������>            */
                     if ($Code_Error!=-1)
                      return 0;

                     /* y18: � ���������� $Ai ����� ������� �� ����� $StekRes */
                     /* ($Ai<--$StekRes), ���� $Ai=1, �� ��� ������,           */
                     /* ����� - ����                                        */
                     if (!Stek_Integer(1, $StekRes, $TopRes, $Ai))
                     {
                      /* �������� ��������� � ����� $StekRes */
                      $Code_Error=16;
                      return 0;
                     }

                     if ($Tab_Lexems[$Number_Lexem]->Code!=_THEN_)
                     {
                      /* ����������� <��������>. */
                      /* ����������� THEN � ��������� IF. */
                      $Code_Error=20;
                      return 0;
                     }

                     /* �������� ���������� �������: $Ai==1 (TRUE), */
                     /* $Ai==0 (FALSE)                              */
                     if ($Ai==1) /* ��������� TRUE */
                     {

                      /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                      $Number_Lexem++;

                      /* ��������� �����������                      */
                      /* <������������������ ����������> ����� ELSE */
                      ProcedureL();

                      /* �������� �� ������, ����������� � �������� */
                      /* ��������� �����������                      */
                      /* <������������������ ����������>            */
                      if ($Code_Error!=-1)
                       return 0;

                      if ($Tab_Lexems[$Number_Lexem]->Code==_ELSE_)
                      {

                       /* y19: ������� �� ������� ����� $Tab_Lexems[$Number_Lexem]->Value-1  */
                       /*    */
                       $Number_Lexem=$Tab_Lexems[$Number_Lexem]->Value-1;

                       if ($Tab_Lexems[$Number_Lexem]->Code==_ENDIF_)
                       {
                        /* ������� y4: ������ ��������� ������� ($Number_Lexem++)*/
                        $Number_Lexem++;
                        return 0;
                       }
                       else
                       {
                        /* ����������� <��������>.          */
                        /* ����������� ENDIF � ��������� IF.*/
                        $Code_Error=21;
                        return 0;
                       }

                      }
                      elseif ($Tab_Lexems[$Number_Lexem]->Code==_ENDIF_)
                       {
                        /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                        $Number_Lexem++;
                        return 0;
                       }
                       else
                       {
                        /* ����������� <��������>.          */
                        /* ����������� ENDIF � ��������� IF.*/
                        $Code_Error=21;
                        return 0;
                       }

                     }
                     else /* ��������� FALSE */
                     {

                      /* y19: ������� �� ������� �����  $Tab_Lexems[$Number_Lexem]->Value-1  */
                      $Number_Lexem=$Tab_Lexems[$Number_Lexem]->Value-1;

                      if ($Tab_Lexems[$Number_Lexem]->Code==_ELSE_)
                      {

                       /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                       $Number_Lexem++;

                       /* ��������� �����������                      */
                       /* <������������������ ����������> ����� ELSE */
                       ProcedureL();

                       /* �������� �� ������, ����������� � ��������  */
                       /* ��������� �����������                       */
                       /* <������������������ ����������>             */
                       if ($Code_Error!=-1)
                        return 0;

                       if ($Tab_Lexems[$Number_Lexem]->Code==_ENDIF_)
                       {

                        /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                        $Number_Lexem++;
                        return 0;
                       }
                       else
                       {
                        /* ����������� <��������>. */
                        /* ����������� ENDIF � ��������� IF.*/
                        $Code_Error=21;
                        return 0;
                       }
                      }
                      elseif ($Tab_Lexems[$Number_Lexem]->Code==_ENDIF_)
                       {
                        /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
                        $Number_Lexem++;
                        return 0;
                       }
                       else
                       {
                        /* ����������� <��������>.                   */
                        /* ����������� ELSE ��� ENDIF � ��������� IF.*/
                        $Code_Error=22;
                        return 0;
                       }

                      }

                    break;

  endswitch;
  return 0;
} /* End ProcdureS */

  /*************************************************************************/
  /* ��������� ProcedureL - ��������� �����������                          */
  /* <������������������ ����������>::=<��������> |                        */
  /*                            <��������>;<������������������ ����������> */
  /*************************************************************************/
  function ProcedureL()
  {
    global $Code_Error;
    global $Tab_Lexems;
    global $Number_Lexem;
   while (TRUE):

    /* ��������� ����������� <��������> */
    ProcedureS();

    /* �������� �� ������, ����������� � �������� */
    /* ��������� ����������� <��������>           */
    if ($Code_Error!=-1)
      return 0;

    /* �������� ������� ";" */
    if ($Tab_Lexems[$Number_Lexem]->Code!=_SEMICOLON_)
      return 0;

    /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
    $Number_Lexem++;

   endwhile;
   return 0;
  } /* End ProcedureL */

  
 /* ������ ��������������� ������� ������������ � �������������� */

  /* ������� y0: ������������� ������ � ���������� */
  /* ������������� ���������� */
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

  /* ������������� ������ */
  Stek_Integer(0, $ArrIdent,  $TopRes, $Ai);
  Stek_Integer(0, $StekRes,   $TopRes, $Ai);
  Stek_Integer(0, $StekIdent, $TopIdent, $Ai);
  Stek_Integer(0, $StekMul,   $TopMul, $Ai);
  Stek_Integer(0, $StekSum,   $TopSum, $Ai);
  Stek_Integer(0, $StekRel,   $TopRel, $Ai);


  /* ������ ��������� ������� ������ */
  $Number_Lexem=1;

  if ($Tab_Lexems[$Number_Lexem]->Code!=_BEGIN_)
  {
   /* ����������� <���������>. ��� BEGIN. */
   $Code_Error=12;
   return 0;
  }

  /* ������� y4: ������ ��������� ������� ($Number_Lexem++) */
  $Number_Lexem++;

  /* ��������� ����������� <������������������ ����������> */
  ProcedureL();
  /* �������� �� ������, ����������� � ��������            */
  /* ��������� ����������� <������������������ ����������> */
  if ($Code_Error!=-1)
   return 0;

  if ($Tab_Lexems[$Number_Lexem]->Code!=_END_)
  {
   /* ����������� <���������>. ��� END. */
   $Code_Error=13;
   return 0;
  }

  /* y20: ���������� ���������� ������ ��������������� ����������� */
  global $ct_buf;
   echo('<br><hr><br><font color="blue">���������� ���������� ������ ��������������</font><br><br><form action="INTERFACE.php" method="POST">
                   <input type="submit" value="    ��    " >
                   <input name="source" type="hidden" value="'.$ct_buf.'">    
                   </form>');
  }
  
?>
