<?php /* PSPInstaller - RepoPrep - http://pspinstaller.rsparrow.co.uk/ */ if(time()>1264631696){}   class MasterAPI { private $dOt32; private $PbM3b; private $BrH3c; private $rJZ3a; private $VOR3d; private $bYp34; private $ORi38; private $sqo37; private $MmE33; public function MasterAPI() { $this->__construct(); } public function __construct() { $this->dOt32 = apikey(); $this->PbM3b = siteurl(); $this->BrH3c = sprintf('%s://%s%s', (is_ssl() ? 'https' : 'http'), $_SERVER['HTTP_HOST'], substr(dirname($_SERVER['REQUEST_URI']),0,-5)); $this->VOR3d = version(); $this->rJZ3a = NULL; $this->bYp34 = ''; $this->ORi38 = false; $this->sqo37 = false; $this->MmE33 = isset($_GET['debuginfo']); } public function RequireSynch() { $lastRegSynch = lastregsynch(); $systemStatusFlag = systemstatus(); return (($systemStatusFlag == SYS_PENDING && $lastRegSynch < time()-3600) || ($systemStatusFlag != SYS_PENDING && $systemStatusFlag != SYS_NOTREGISTERED && $lastRegSynch < time()-86400)); } public function Authenticate() { $HAR10d = $this->Rlb39(ZKG2); if ($HAR10d && is_array($HAR10d)) { if ($HAR10d[Ein1] == sIH6) { $this->dOt32 = $HAR10d[sIH6]; $this->ORi38 = true; } else if ($HAR10d[Ein1] == gFd5) { $this->sqo37 = true; return $this->ZVU36('API key was denied.'); } $this->rJZ3a = $HAR10d[XnP7]; config('Reg_LastSynch', time()); return true; } return $this->ZVU36('Unknown authentication error.'); } public function CheckStatus() { $HAR10d = $this->Rlb39(RIi8); if ($HAR10d && is_array($HAR10d)) { if (isset($HAR10d[nepb]) && version_compare($this->VOR3d, $HAR10d[nepb], '<')) { config('Version_Latest', $HAR10d[nepb]); } $status = SYS_NOTREGISTERED; switch ($HAR10d[RIi8]) { case Lbe2a: $status = SYS_PENDING; break; case UrH28: $status = AbA2b; if (isset($HAR10d['c_name'],$HAR10d['c_description'],$HAR10d['c_contact'],$HAR10d['c_url'])) { if ($HAR10d['c_name'] != config('Reg_Name') || $HAR10d['c_description'] != config('Reg_Description') || $HAR10d['c_contact'] != config('Reg_Contact') || $HAR10d['c_url'] != config('URL') ) { config('Reg_Name', $HAR10d['c_name']);
config('Reg_Description', $HAR10d['c_description']); config('Reg_Contact', $HAR10d['c_contact']); config('URL', $HAR10d['c_url']); } } break; case GzZ29: $status = NMd2c; break; default: $status = SYS_NOTREGISTERED; break; } config('Reg_Status', $status); return array('Status'=>$status); } return $this->ZVU36('Unknown status error.'); } public function UpdateRegistration($name, $description, $contact, $url) { $MeU50 = array('x_original_name'=>config('Reg_OriginalName'),'x_name'=>$name,'x_description'=>$description,'x_contact'=>$contact,'x_url'=>$url); $HAR10d = $this->Rlb39(nBo3, $MeU50); if ($HAR10d && is_array($HAR10d)) { if ($HAR10d[nBo3] == qVh0) { if ($this->ORi38) { config('Reg_APIKey', $this->dOt32); } return true; } } return $this->ZVU36('Unknown update error.'); } public function Zbl1b() { return $this->bYp34; } public function IsKeyDenied() { return $this->sqo37; } function Rlb39($fkk66, $data = array(), $lSYe2 = NULL) { $cCZe9 = array('http' => array( 'method' => 'POST', 'content' => http_build_query(array_merge(array(Fma4=>$fkk66,Ein1=>$this->dOt32,pfY9=>$this->PbM3b,ZOFa=>$this->BrH3c,XnP7=>$this->rJZ3a,nepb=>$this->VOR3d), $data)) )); if ($this->MmE33) { parse_str($cCZe9['http']['content'], $iYA11f); print 'Request: <pre style="border: 1px solid black; padding: 10px;margin: 2px 10px;">' . print_r($iYA11f, true) . '</pre>'; } if ($lSYe2 !== null) { $cCZe9['http']['header'] = $lSYe2; } $JLg6c = stream_context_create($cCZe9); $Kpp9c = @fopen(TMV20, 'rb', false, $JLg6c); if (!$Kpp9c) { return $this->ZVU36('Unable to connect to API.'); } $HAR10d = @stream_get_contents($Kpp9c); if ($HAR10d === false) { return $this->ZVU36('Unable to get API response.'); } if ($HAR10d) { if (strlen($HAR10d) > 25 && substr($HAR10d, 0, 22) == 'PSPInstallerMasterAPI:') { $zcZef = unserialize(substr($HAR10d, 22)); if (is_array($zcZef) && isset($zcZef[Fma4]) && $zcZef[Fma4] == $fkk66) { return $zcZef; } } } if ($this->MmE33) { print 'Response (corrupt): <pre style="border: 1px solid black; padding: 10px;">' . htmlspecialchars($HAR10d) . '</pre>'; } return $this->ZVU36('Unknown API request error.'); } function ZVU36($Kascb = '') { if (!empty($Kascb)) { $this->bYp34.= $Kascb . "\r\n"; } return API_INVALID; } } function masterApiError($iMI7d = '') { global $master; if (isset($master)) { $iMI7d.='<!--' . $master->Zbl1b() . ' -->'; } addMessage('error','Fatal error: Unable to establish a connection with the Master List.<div class="descr">Ensure that your application has access to the Internet. If you continue to experience this error, please contact the PSPInstaller team.' . (empty($iMI7d) ? '' : ' <code>' . $iMI7d) . '</code></div>'); } ; ?>
