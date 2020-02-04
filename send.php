<?php
// формируем URL в переменной $queryUrl
$queryUrl = 'https://b24-ahhf05.bitrix24.ru/rest/1/6gnz0mj9b0rkz8pn/crm.lead.add.json';
// формируем параметры для создания лида в переменной $queryData
$queryData = http_build_query(array(
'fields' => array(
'TITLE' => 'Создание лида через скрипт PHP',
'COMPANY_TITLE' => $_POST["COMPANY_TITLE"],
'NAME' => $_POST["NAME"],
'LAST_NAME' => $_POST["LAST_NAME"],
'COMMENTS' => $_POST["COMMENTS"],
'PHONE' => array(
array(
"VALUE" => $_POST["PHONE"],
"VALUE_TYPE" => "WORK"
)
)
),
'params' => array("REGISTER_SONET_EVENT" => "Y")
));
$curl = curl_init();
curl_setopt_array($curl, array(
CURLOPT_SSL_VERIFYPEER => 0,
CURLOPT_POST => 1,
CURLOPT_HEADER => 0,
CURLOPT_RETURNTRANSFER => 1,
CURLOPT_URL => $queryUrl,
CURLOPT_POSTFIELDS => $queryData,
));
$result = curl_exec($curl);
curl_close($curl);
$result = json_decode($result, 1);
if (array_key_exists('error', $result)) echo "Ошибка при сохранении лида: ".$result['error_description']."<br/>";
