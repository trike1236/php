<?php
//�ϐ��錾
$keyword='';	//�s���h�~�p�L�[���[�h
$fileName = "sample1.txt";
//�f�[�^�󂯎��
if(isset($_POST['keyword'])){
  $keyword=$_POST['keyword'];	//�L�[���[�h
}

//���[�U�[�ꗗ�擾
$sendUnityData=GetTodoTask();

 
//�ǂݍ��񂾃f�[�^��json�`���Œ[���ɑ��M����
header('Content-type: application/json');
print json_encode($sendUnityData,JSON_UNESCAPED_UNICODE);
//echo $sendUnityData;
//print_r($sendUnityData);

function GetTodoTask(){
    global $fileName;
    $todo_line = file_get_contents($fileName);
    $todo_line = json_decode($todo_line,true);
    //print_r($todo_line);
    $todo_line = FormatJson($todo_line);
    return $todo_line;
}
 
 //json��unity�Ŏ󂯎���`�ɕϊ�����
 function FormatJson($jsonData){
   if(is_array($jsonData["task"])){
     $ArrayData["task"] = implode("|",$jsonData["task"]);
   }else $ArrayData["task"] = $jsonData["task"];
   if(is_array($jsonData["finished"])){
     $ArrayData["finished"] = implode("|",$jsonData["finished"]);
   }else $ArrayData["finished"] = $jsonData["finished"];
   return $ArrayData;
 }