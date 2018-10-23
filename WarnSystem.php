<?php

echo '<b>Scritto da t.me/Matxk</b>';

																		t.me/DevelopingLab;

$admins = [ID, ID]; //Inserire gli ID delle persone che potranno usare /warn
#NON TOCCARE
if(in_array($userID, $admins)) {
	$isadmin = true;
}else{
	$isadmin = false;
}

if($chatID < 0) {
	#Inizio comandi
	
if($msg == '/maxwarns' and $isadmin) {
	$menu[] = [['text' => '1', 'callback_data' => '/setwarn 1'],['text' => '2', 'callback_data' => '/setwarn 2'],['text' => '3', 'callback_data' => '/setwarn 3'],['text' => '4', 'callback_data' => '/setwarn 4'],['text' => '5', 'callback_data' => '/setwarn 5'],['text' => '6', 'callback_data' => '/setwarn 6'],];
	
	sm($chatID, 'Ok! Ora i warn massimi che un utente puó raggiungere prima di essere bannato!', $menu);
}

if(strpos($cbdata, '/setwarn ')===0 and $isadmin) {
	$e = explode(" ", $cbdata, 2);
	$mwarn = $e[1];
	
	mkdir("warns");
	mkdir("warns/$chatID");
	file_put_contents("warns/$chatID/maxwarns.txt", $mwarn);
	
	sm($chatID, "Warn massimi impostati a $mwarn!");
}

$getmwarns = file_get_contents("warns/$chatID/maxwarns.txt");

if(isset($update['message']['reply_to_message']) and !in_array($ruserID, $admins) and $msg == '/warn') {
	mkdir("warns");
	mkdir("warns/$chatID");
 $getwarns = file_get_contents("warns/$chatID/$ruserID.txt");
	file_put_contents("warns/$chatID/$ruserID.txt", $getwarns + 1);
	$getnwarns = $getwarns + 1;
	if("$getnwarns" >= $getmwarns) {
		ban($chatID, $ruserID);
		unlink("warns/$chatID/$ruserID.txt");
		sm($chatID, "$rnome ha raggiunto il numero massimo di warn... l' ho bannato");
	}else{
		sm($chatID, "$rnome ha ora $getnwarns warn su $getmwarns");
	}
}elseif(isset($update['message']['reply_to_message']) and in_array($ruserID, $admins) and $msg == '/warn') {
	sm($chatID, "Non posso warnare $rnome!");
}

if(isset($update['message']['reply_to_message']) and !in_array($ruserID, $admins) and $msg == '/delone') {
	mkdir("warns");
	mkdir("warns/$chatID");
 $getwarns = file_get_contents("warns/$chatID/$ruserID.txt");
	file_put_contents("warns/$chatID/$ruserID.txt", $getwarns - 1);
	$getnwarns = $getwarns - 1;
	if($getwarns > 0) {
		sm($chatID, "$rnome ha ora $getnwarns su $getmwarns");
	}else{
		file_put_contents("warns/$chatIS/$ruserID.txt", 0);
	 sm($chatID, "$rnome non ha alcun warn!");
	}
}elseif(isset($update['message']['reply_to_message']) and in_array($ruserID, $admins) and $msg == '/delone') {
	sm($chatID, "Non posso rimuovere nessun warn da $rnome!");
}

if(isset($update['message']['reply_to_message']) and !in_array($ruserID, $admins) and $msg == '/delall') {
	mkdir("warns");
	mkdir("warns/$chatID");
 $getwarns = file_get_contents("warns/$chatID/$ruserID.txt");
	file_put_contents("warns/$chatID/$ruserID.txt", 0);
	sm($chatID, "$rnome non ha più nessun warn!");
}elseif(isset($update['message']['reply_to_message']) and in_array($ruserID, $admins) and $msg == '/delall') {
	sm($chatID, "Non posso annullare i warn di $rnome!");
}

if(isset($update['message']['reply_to_message']) and !in_array($ruserID, $admins) and $msg == '/getwarns') {
	mkdir("warns");
	mkdir("warns/$chatID");
 $getwarns = file_get_contents("warns/$chatID/$ruserID.txt");
	sm($chatID, "$rnome ha $getwarns warn");
}elseif(isset($update['message']['reply_to_message']) and in_array($ruserID, $admins) and $msg == '/getwarns') {
	sm($chatID, "Non posso vedere quanti warn ha $rnome!");
}

 #Fine comandi
}