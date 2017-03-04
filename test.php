<?php
//変数宣言
$keyword='';	//不正防止用キーワード
$fileName = "sample1.txt";
//データ受け取り
if(isset($_POST['keyword'])){
  $keyword=$_POST['keyword'];	//キーワード
}

//ユーザー一覧取得
$sendUnityData=GetTodoTask();

 
//読み込んだデータをjson形式で端末に送信する
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
 
 //jsonをunityで受け取れる形に変換する
 function FormatJson($jsonData){
   if(is_array($jsonData["task"])){
     $ArrayData["task"] = implode("|",$jsonData["task"]);
   }else $ArrayData["task"] = $jsonData["task"];
   if(is_array($jsonData["finished"])){
     $ArrayData["finished"] = implode("|",$jsonData["finished"]);
   }else $ArrayData["finished"] = $jsonData["finished"];
   return $ArrayData;
 }