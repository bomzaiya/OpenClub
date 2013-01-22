<?php
 set_time_limit(0);
 $logdata = date('Y-m-d H:i:s'); 
 $report = $logdata . " start\n";
 if (isset($_POST['PHONE_MODEL'])) {
   $report .= "MODEL: ";
   $report .= $_POST['PHONE_MODEL']. "\n";
 }
 $filename = date('Y-m-d');
 if (isset($_POST['CUSTOM_DATA'])) {
   $customData = explode("\n", $_POST['CUSTOM_DATA']);
   for ($i = 0; $i < count($customData); $i++) {
     $customDataLine = $customData[$i];
     if (strstr($customDataLine, "IMEI")) {
       $customParts = explode("=", $customDataLine);
       $filename.= "-".trim($customParts[1]);
     } elseif (strstr($customDataLine, "MAC")) {
       $customParts = explode("=", $customDataLine);
       $filename .= "-".str_replace(":", "_", trim($customParts[1]));
     }
   }
   $report .= $_POST['CUSTOM_DATA'] . "\n";
 }
 if ($filename) {
   if (isset($_POST['ANDROID_VERSION'])) {
     $report .= "Android Version: ";
     $report .= $_POST['ANDROID_VERSION']. "\n";
   }
   if (isset($_POST['STACK_TRACE'])) {
     $report .= "Stack Trace: ";
     $report .= $_POST['STACK_TRACE']. "\n";
   }
   if (isset($_POST['LOGCAT'])) {
     $report .= "Logcat: ";
     $report .= $_POST['LOGCAT']. "\n";
   }
   $report .= "----------------------\n"; 
   $f = fopen('/home/www/virtual/linegig.com/bom/htdocs/bug/reports/' . $filename. '.txt', 'a+');
   fwrite($f, $report);
   fclose($f);
 }
?>
