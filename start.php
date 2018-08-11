<?php

$token = "TOKEN DEL BOTOLO" //inserisci il token che ti da @BotFather
$capisupremi ['IDtuo','idSecondoCapoSupremo]; //id dei capi supremi dei bot
$config = array(
"db" => true, //True per usare il database, false per nom usarlo
"tipo_db" => mysql, //mysql per database che usano MySql, json per database che usano json

//CONFIGURAZIONI DEL DATABASE
"ip" => "ip" //inserisci l'ip del database, se è hostato sullo stesso server inserire localhost
"user" => "root" //inserisci l'user del database
"password" => "LaysBotolo" //inserisci la password del database
"database" => "Database" //inserisci il nome del database
"tabella" => "tabella" //inserisci la tabella principale del bot
//TELEGRAM
"debug_mode" => true, //Metti true per mostrare gli errori, false per non mostrarli
"action" => true, //true per mandare azioni come typing... e false per non mandare nulla
"parse_mode"=> "html" ,//Formattazione presefinita messaggio, HTML, Markdown o none
"disabilitapreview" => false, //False per permettere il web preview, true per disabilitarla
"tastiera" => "inline" ,//Tastiera preferita, inline per quella inline e reply per la replykeyboard
"funziona_modificati" => true, //Scegli se far eseguire i messaggi modificati
"funziona_inoltrati" => false, //Scegli se far eseguire i messaggi inoltrati
);
if ($config['db'] && $config['tipo_db'] == "mysql") {
 $db = new PDO("mysql:host=" . $config["ip"] . ";dbname=".$config['database'], $config['user'], $config['password']); 
 }
if ($config['debug_mode']) {
error_reporting(E_ALL);
} else {
error_reporting(0);
}
$save = array(
"save","token", "config", "db", "disable", "offset", "capisupremi"//lista di variabili da salvare fra un'esecuzione e l'altra
);
echo "Bot avviato cln successo!\n";
include("functions.php");
$c1 = file_get_contents("http://api.telegram.org/bot$token/getUpdates?offset=-1");
$up1 = json_decode($c1, true);
$offset = $up1["result"][0]["update_id"];
if (!$offset) {
 echo "\nC'è stato un errore con l'offset, per risolverlo invia un update al bot e riavvia lo script\n";
 exit;
}
while(1) {
$l = file_get_contents("last.json");
$content = file_get_contents("http://api.telegram.org/bot$token/getUpdates?offset=$offset");
if ($l == $content || $content == '{"ok":true,"result":[]}') {
} else {
$offset++;
file_put_contents("last.json", $content);
$update = json_decode($content, true);
$update = $update["result"][0];
include("vars.php");
if (in_array($chatID, $admin))  {$isadmin = true;}
if ($config['db']) {
include("database.php");
}
include("comandi.php");
$plugins = scandir("plugins");
$disable = array("pluginno.php");
foreach ($plugins as $plugin) {
if (!in_array($plugin, $disable)) {
include("plugins/$plugin");
}
}

$vars = array_keys(get_defined_vars());
foreach ($vars as $var) {
if (in_array($var, $save)) {
} else {
    unset($$var);
}
}
unset($vars);
}
}
?>