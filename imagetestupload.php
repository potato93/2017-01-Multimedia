<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);

require_once 'conn.php';
global $mysqli;
$uploadDir = '/home/multi/html/upload/';
//$uploadFile = date("U").substr($_FILES['userfile']['tmp_name'], 8).".".pathinfo($_FILES['userfile']['name'])['extension'];
$uploadFile = date("Uu").".png";
$uploadPath = $uploadDir . $uploadFile;
// 원본 파일명: basename($_FILES['userfile']['name']);
// date("U").substr($_FILES['userfile']['tmp_name'], 8).pathinfo($_FILES['userfile']['name'])['extension'];

/*echo '<pre>';
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadPath)) {
    echo "파일이 유효하고, 성공적으로 업로드 되었습니다.\n";
    $query = "update imagetest set image_data='".$uploadFile."' where image_id=0;";
    $mysqli->query($query);
    echo $query;
} else {
    print "파일 업로드 공격의 가능성이 있습니다!\n";
}

echo '자세한 디버깅 정보입니다:';
print_r($_FILES);

print "</pre>";*/
$data = explode(',', $_POST['userfile']);
$content = base64_decode($data[1]);
$file = fopen($uploadPath, "wb");
fwrite($file, $content);
fclose($file);

$query = "update imagetest set image_data='".$uploadFile."' where image_id=0;";
$mysqli->query($query);
echo $query;

$query = "select * from imagetest where image_id=0";
$result = $mysqli->query($query);
$data = mysqli_fetch_array($result);
echo "<img src='/upload/".$data['image_data']."'>";
?>
