<?php /* PSPInstaller - RepoPrep - http://pspinstaller.rsparrow.co.uk/ */ if(time()>1264631696){}   $hKF19=0; $LKM53 = array('1941A5','AFD8F8','F6BD0F','8BBA00','A66EDD','F984A1','CCCC00','999999','0099CC','FF0000','006F00','0099FF','FF66CC','669966','7C7CB4','FF9933','9900FF','99FFCC','CCCCFF','669900'); function EgAa3() { global $hKF19, $LKM53; return($LKM53[++$hKF19 % count($LKM53)]); } function LLK83($CpE120, $Adk45=false) { if ($Adk45==true) { if (strpos($CpE120,"?")<>0) $CpE120 .= "&F\103\103\x75\162\x72\124ime=" . Date("\x48_\x69_\x73"); else $CpE120 .= "?\x46\103\103\165\162\162T\151\155\145=" . Date("\x48_\x69_\163"); } return urlencode($CpE120); } function tnP73($TaSc8, $ICO75) { @list($kTg74, $PRp12c) = explode(" ", $ICO75); $ZAK4f = explode("-", $kTg74); $ssn72 = "";  
if (count($ZAK4f) == 3) { list($Rkn14a, $BXRca, $Pbq78) = $ZAK4f;  
switch ($TaSc8) { case "m": return $BXRca; case "d": return $Pbq78; case "\171": return $Rkn14a; }  
return (trim($BXRca . "/" . $Pbq78 . "/" . $Rkn14a)); } return $ssn72; } function Jpt109($nHg63, $OmD121, $bUZ122, $IFV61, $MDX64, $hcp60, $PABb6=false, $Zno79=false, $ZAm108=false, $IGC115="") { $jUe62 = $IFV61 . "Di\x76"; $ILLd3 = Voq59($Zno79); $AoNdb = Voq59($ZAm108); $ALidc=($IGC115?"t\x72\x75\145":"\146\141\154\x73\x65"); $MZd10a = array(); if ($PABb6) $MZd10a[] = '$(document).ready(function() {'; $MZd10a[] = sprintf('var chart_%s = new FusionCharts("%s", "%s", "%s", "%s", "%s", "%s");', $IFV61, $nHg63, $IFV61, $MDX64, $hcp60, $ILLd3, $AoNdb); $MZd10a[] = sprintf('chart_%s.setTransparent("%s");', $IFV61, $ALidc); $MZd10a[] = $bUZ122=="" ? sprintf("\x63\150\141\162t_%s.\163\x65\164\x44a\164\x61\125\122L(\"%s\")", $IFV61, $OmD121) : sprintf("ch\x61rt_%s.se\164\x44a\164aX\x4d\114(\"\")", $IFV61, $bUZ122); $MZd10a[] = sprintf('chart_%s.render("%s");', $IFV61, $jUe62); if ($PABb6) $MZd10a[] = '});'; return array(sprintf('<div id="%s" align="center">The graph requires that you have Javascript enabled and Adobe Flash Player installed.</div>', $jUe62), implode("\n", $MZd10a)); } function Voq59($PFP56) { return ($PFP56 ? 1 : 0); } ; ?>
