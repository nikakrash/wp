<?
date_default_timezone_set('Asia/Yekaterinnurg');
$fieldsArr = array("name" => "Имя", "phone" => "Телефон", "source" => "Источник (форма)", "problem" => "Сообщение/неисправность", "type" => "Форма");

foreach ($_POST as $key => $val) {
    $fld = !empty($fieldsArr[$key]) ? $fieldsArr[$key] : $key;
    if (is_array($val)) {
        foreach ($val as $item) {
            $messageFlds .= "<b>{$fld}: </b>" . nl2br($item) . "<br><br>";
        }
    } else {
        $messageFlds .= "<b>{$fld}: </b>" . nl2br($val) . "<br><br>";
    }
}

foreach($fields as $key=>$value) {
    $fields_string .= $key.'='.$value.'&';
}
$fields_string = rtrim($fields_string,'&');
$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_POST,count($fields));
curl_setopt($ch,CURLOPT_POSTFIELDS,$fields_string);
$result = curl_exec($ch);



$subject = "Заявка на сайте webblack";
$message = "{$messageFlds}";
$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'From: info@waterproofing.ru' . "\r\n";
$headers .= 'Content-type: text/html; charset=utf-8' . "\r\n";

if (mail('frontend@webblack.ru', $subject, $message, $headers)) {
    mail('frontend@webblack.ru', $subject, $message, $headers);
    echo json_encode(array("send" => "ok"));

} else {
    echo json_encode(array("send" => "no"));
}

?>