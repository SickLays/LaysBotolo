<?php
sm($chatID, $update);
if ($msg == "/start") {
$menu[] = array(
array("text" => "Creatore",
"url"  => "t.me/SickLays"),
);
sm($chatID, "Grazie per aver scelto LaysBotolo!!!!, $menu, "inline");
}
if ($msg == "/reply") {
$menu[] = array("voce 1");
$menu[] = array("voce 2", "voce 3");
$menu[] = array("nascondimi");
sm(era reply", $menu, "reply");
}
if ($msg == "nascondimi") {
sm($chatID , "Testiera nascosta", true, "nascondi");
}
if ($msg == "/inline") {
$menu[] = array(
array("text" => "Ciao",
"callback_data" => "test"),
);
sm($chatID, "Tastiera Inline", $menu, "inline");
}