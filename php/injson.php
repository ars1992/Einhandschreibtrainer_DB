<?php 
$list = $_REQUEST["list"];
echo $list;

$filename = "../json/test.json";
$file = file_get_contents($filename);
$json_decoded = json_decode($file);


$json_decoded = "2";
$json_encoded = json_encode($json_decoded);
file_put_contents($filename, $json_encoded);

exit;

$user = $_REQUEST["user"];
$anschläge = $_REQUEST[""];
$fehlerInProzent = $_REQUEST[""];
$fehlerGesamt = $_REQUEST[""];



$auswertung = "[[\"a\",91,91],[\"b\",66,66],[\"c\",80,80],[\"d\",25,26],[\"e\",233,233],[\"f\",15,15],[\"g\",32,32],[\"h\",89,89],[\"i\",156,156],[\"j\",2,2],[\"k\",16,16],[\"l\",43,43],[\"m\",8,8],[\"n\",118,118],[\"o\",25,25],[\"p\",3,3],[\"q\",0,0],[\"r\",205,205],[\"s\",50,50],[\"t\",91,91],[\"u\",27,27],[\"v\",7,7],[\"w\",14,14],[\"x\",1,1],[\"z\",7,7],[\"y\",0,0],[\"A\",3,3],[\"B\",3,3],[\"C\",0,0],[\"D\",3,3],[\"E\",1,1],[\"F\",1,1],[\"G\",5,5],[\"H\",1,1],[\"I\",1,1],[\"J\",2,2],[\"K\",6,6],[\"L\",0,0],[\"M\",6,6],[\"N\",2,2],[\"O\",0,0],[\"P\",0,0],[\"Q\",0,0],[\"R\",3,3],[\"S\",58,58],[\"T\",1,1],[\"U\",0,0],[\"V\",58,59],[\"W\",1,1],[\"X\",0,0],[\"Z\",1,1],[\"Y\",0,0],[\"\u00e4\",3,3],[\"\u00fc\",3,3],[\"\u00f6\",2,2],[\"\u00df\",2,2],[\"\u00c4\",0,0],[\"\u00d6\",0,0],[\"\u00dc\",0,0],[\" \",0,149],[\"0\",56,56],[\"1\",56,56],[\"2\",0,0],[\"3\",0,0],[\"4\",0,0],[\"5\",0,0],[\"6\",0,0],[\"7\",0,0],[\"8\",0,0],[\"9\",0,0]]";



$datum = date("Y-m-d");
$jsonList = json_decode($list);
echo $jsonList;
echo "<br>";
echo "<br>";

echo $list;

echo "<br>";
echo "<br>";

echo $auswertung;

echo "<br>";
echo "<br>";

$i = json_decode($auswertung);
foreach($list as $x){
    echo $x[0] . " ";
}

?>