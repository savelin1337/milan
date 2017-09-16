<?php
//��������� ����� ��������������
require("interpretator.php");

 $ct_buf        = $_POST["source"];               //�������� ���������� �������� ��� �� ������������
 $ct_pos        = 0;
 $ct_readCount  = 0;                              //������� �������� �������
 $ct_readBUF    = Array();

  //����������� ������ ������ ��������������
  switch($_POST["mode"]):
    case '1':
          $ct_milanMode = 1;                     //����� ������ - �������������� ����������
    break;
    case '2':
           $tmp= $_POST["readbuf"];              //������� ������ �� �������� ���� � ������ "readbuf"
            if($tmp!='')                         //���� ������ �� ������
            {
               $ct_readBUF = explode('%',$tmp);    //��������� ������ �� �������� ���������� �������� '%' � ������� � ������
            }
            $ct_readBUF[]=$_POST["stdin"];       //������� ����� ����������� ����� �� ���� "stdin"  � ������ $ct_readBUF
            
           $ct_milanMode = 2;                    //����� ������ - ������ ���������� ��������������� ����������� 
                                                 //������������ � ��������������� � ��������������� ��������� ���������������� ������ 
    break;
    default:
          $ct_milanMode = 0;                     //����� ������ - ����������� ����������
    endswitch;

 //������� ������ ������ ������� �� ��������� ���� ��������� MILAN
 function Read(&$Input_letter)
 {
   global $ct_buf;
   global $ct_pos;
   if($ct_pos+1<=strlen($ct_buf))                //��������, �� ��������� �� ����� ����������� ���������
   {
        $Input_letter = $ct_buf{$ct_pos++};     //��������� ��������� ������ �� ������
        return 1;
   }else
   {
       $Input_letter  = Chr(26);                //��������� ������, ���������� ����� ��������� �� ����� �����
       return 0;
   }
 }
 
 if($ct_milanMode==0)
 {
  $ct_TabLEX_Code_str   = '';     //��������� ����������, ������������ ��� �������� ����� �� ������� ������ 
  $ct_TabLEX_Value_str  = '';    //��������� ����������, ������������ ��� �������� �������� �� ������� ������  
  
  /* ������ ������������ ������� */ 
    Lexical_Analyzer();
    
 }else
 {   //���� ���������� ������ ��� ��� ��������, �� ����������� ������ ���������� �� ������� ����� �� �����
 
 //����������� ������� ������, ��������� ������ ������� ����� �����: "lex_code" � "lex_value"
    $ct_TabLEX_Code_str   = $_POST["lex_code"];  //������� ��������� ������, ���������� � ������� ���� "lex_code"
    $ct_TabLEX_Value_str  = $_POST["lex_value"]; //������� ��������� ������, ���������� � ������� ���� "lex_value"  
    $ct_tmpcode =  explode('%',$ct_TabLEX_Code_str);  //����������� ������ $ct_TabLEX_Code_str � ������ $ct_tmpcode
    $ct_tmpvalue = explode('%',$ct_TabLEX_Value_str); //����������� ������ $ct_TabLEX_Value_str � ������ $ct_tmpvalue
    
    for ($i=0;$i<count($ct_tmpcode)-1;$i++ ) 
     {
        $tmp = new Element_Lexems; 
        $tmp->Code =$ct_tmpcode[$i];
        $tmp->Value =$ct_tmpvalue[$i];
        $Tab_Lexems[$i+1] = $tmp;
     }
     //������������� ������� ���������������
    $Tab_Identifiers = explode('%','%'.$_POST["tab_ident"]);       
    unset($Tab_Identifiers[0]); //������� ������� ������� �������
    //������������� ������� ��������
    $Tab_Constants   = explode('%','%'.$_POST["tab_const"]); 
    unset($Tab_Constants[0]);  //������� ������� ������� ������� 
 }
 /* �������� �� ������, ����������� � �������� ������������ ������� */
 if (($Code_Error==-1)&&($ct_milanMode>0)) 
 {
  /* ������ ��������������� �������, ����������� � �������������� */
  Syntactical_Analyzer();

  /* �������� �� ������, ����������� � �������� ������������� */
  if ($Code_Error>-1)
  {
   Print_Error(2);
  }
 }


?>
