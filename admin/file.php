<?php /* PSPInstaller - RepoPrep - http://pspinstaller.rsparrow.co.uk/ */ if(time()>1264631696){}   define('ROOT', '../'); require ROOT . 'include/common-admin.php'; define('CURRENT_PAGE', qOd25); $file_exists = false; $nbp4b = false; $FNY92 = $rTfc2 = isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0 ? floor($_GET['id']) : (isset($_POST['id']) && is_numeric($_POST['id']) && $_POST['id'] > 0 ? floor($_POST['id']) : -1); $pRl57 = isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER']) && strpos($_SERVER['HTTP_REFERER'], 'files.php') !== false ? $_SERVER['HTTP_REFERER'] : 'files.php';
$TmZb1 = NULL; if ($FNY92 != -1) { $ZOPdf = $db->Select(sprintf('SELECT * FROM %s WHERE ID = %s LIMIT 1;', ojb22, $db->Escape($FNY92))); if (is_array($ZOPdf) && count($ZOPdf) == 1) { $ZOPdf = $ZOPdf[0]; $file_exists = true; if (isset($_FILES['file_upload_swf']) && is_uploaded_file($_FILES['file_upload_swf']['tmp_name']) && $_FILES['file_upload_swf']['error'] == 0) { ini_set('html_errors', '0'); $target = ohec6( $ZOPdf['Verified'], $ZOPdf['Category'], basename( $_FILES['file_upload_swf']['name'] )); if (!file_exists(dirname($target))) { print 'ERROR:Unable to get folder; ' . $target; } else { $target = DpY6b($target); if (@move_uploaded_file($_FILES['file_upload_swf']['tmp_name'], $target)) { $db->Update(sprintf('UPDATE %s SET `Location` = \'%s\' WHERE `ID` = %d LIMIT 1;', ojb22, $db->Escape(basename($target)), $FNY92)); print 'SUCCESS:' . basename($target); } else { print 'ERROR:Unable to write file; ' . $target; } } $db->Close(); exit; } else if (isset($_GET['upload']) && $_GET['upload'] == 'complete') { addMessage('success','New file was uploaded and saved.'); } VPL48(sprintf('var fileID = %d;', $FNY92)); qor47('../static/js/swfupload.js?version=2.0'); qor47('tpl/swfupload.fileprogress.js?version=1.1'); qor47('tpl/swfupload.handlers.js?version=1.1'); qor47('tpl/swfupload.init.js?version=1.1'); if (isset($_POST['savechanges']) || isset($_POST['savechanges2']) || isset($_POST['name'])) { if ($_POST['act'] == 'deletepermanently') { if (!ObZ7b($ZOPdf, $db)) { addMessage('error', sprintf('Error deleting %s (ID: %s)!', htmlspecialchars($ZOPdf['Name']), $ZOPdf['ID'])); } else { header('Location: files.php?deletedfile=' . urlencode($ZOPdf['Name'])); exit; } } else { $filename = trim($_POST['name']); $description = trim($_POST['description']); $Zbc5c = $_POST['category']; $status = $_POST['status']; $UCVf8 = $status == UrH28 ? ' checked="checked" ' : ''; $zdNfa = $status == Lbe2a ? ' checked="checked" ' : ''; $lJBf9 = $status == GzZ29 ? ' checked="checked" ' : ''; $author_name = trim($_POST['author_name']); $author_email = trim($_POST['author_email']); $RfMd7 = fzr54($ZOPdf); $RfMd7['Name'] = $filename; $RfMd7['Description'] = $description; $RfMd7['Category'] = $Zbc5c; $RfMd7['Verified'] = $status; $RfMd7['Author_Name'] = $author_name; $RfMd7['Author_Email'] = $author_email; $TmZb1 = $RfMd7; if (!raD136($ZOPdf, $RfMd7, $db)) { addMessage('error', sprintf('Error updating %s (ID: %s)!', htmlspecialchars($TmZb1['Name']), $TmZb1['ID'])); } else { addMessage('success','Changes saved.'); $nbp4b = $status == GzZ29; TriggerUpdate(); } } } else { $TmZb1 = $ZOPdf; $filename = eTh98($TmZb1['Name']); $description = eTh98($TmZb1['Description']); $Zbc5c = $TmZb1['Category']; $status = $TmZb1['Verified']; $UCVf8 = $status == UrH28 ? ' checked="checked" ' : ''; $zdNfa = $status == Lbe2a ? ' checked="checked" ' : ''; $lJBf9 = $status == GzZ29 ? ' checked="checked" ' : ''; $author_name = eTh98($TmZb1['Author_Name']); $author_email = eTh98($TmZb1['Author_Email']); $nbp4b = $status == GzZ29; } $dET8e = locDate($TmZb1['Timestamp']); $FJj96 = locTime($TmZb1['Timestamp']);
$AlV93 = MPRc7($TmZb1); $FjL90 = basename($AlV93); $oBN8d = file_exists($AlV93) && is_file($AlV93); $FNO5d = ''; $Pme5e = array(ziPc, Ezed, THef, rZJe); foreach($Pme5e as $XgK13d) { $FNO5d.=sprintf('<option value="%s" %s>%s</option>', $XgK13d, ($XgK13d == $Zbc5c ? ' selected="selected" ' : ''), ZRe9d($XgK13d)); } $LDe131 = $db->bLP2d(sprintf('SELECT SUM(Downloads) Num FROM %s WHERE `FileID` = %d;', cDZ21, $FNY92)); $DOZ12f = $db->bLP2d(sprintf('SELECT SUM(Downloads) Num FROM %s WHERE `Date` = \'%s\' AND `FileID` = %d;', cDZ21, VVB2e(time()) , $FNY92)); $XsB14b = $db->bLP2d(sprintf('SELECT SUM(Downloads) Num FROM %s WHERE `Date` = \'%s\' And `FileID` = %d;', cDZ21, VVB2e(time()-86400), $FNY92) ); $REobc = strtotime('Last Sunday', time()); $fncda = strtotime('Next Sunday', time()); $gdT58 = strtotime('Last Sunday', $REobc); $ggb143 = $db->bLP2d(sprintf('SELECT SUM(Downloads) Num FROM %s WHERE `Date` >= \'%s\' AND `Date` <= \'%s\' AND `FileID` = %d;', cDZ21, VVB2e($REobc), VVB2e($fncda), $FNY92)); $nVUbd = $db->bLP2d(sprintf('SELECT SUM(Downloads) Num FROM %s WHERE `Date` >= \'%s\' AND `Date` <= \'%s\' AND `FileID` = %d;', cDZ21, VVB2e($gdT58), VVB2e($REobc), $FNY92)); } } if (isset($_GET['downloaderror']) && !empty($_GET['downloaderror'])) { addMessage('error', sprintf('Unable to download file:<br />%s', htmlspecialchars($_GET['downloaderror']))); } if (isset($oBN8d) && $oBN8d === false) { addMessage('warning', 'This file does not have any uploaded attachement!<br />Click the &quot;Upload new file&quot; button in the File box to upload one now.'); } $db->Close(); require ROOT . 'admin/tpl/overallheader.php'; require ROOT . 'admin/tpl/file.php'; require ROOT . 'admin/tpl/overallfooter.php';  ?>