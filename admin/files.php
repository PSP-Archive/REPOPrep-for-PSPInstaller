<?php /* PSPInstaller - RepoPrep - http://pspinstaller.rsparrow.co.uk/ */ if(time()>1264631696){}   define('ROOT', '../'); require ROOT . 'include/common-admin.php'; define('CURRENT_PAGE', qOd25); sHVf3($db); if (isset($_GET['deletedfile']) && !empty($_GET['deletedfile'])) { addMessage('success', sprintf('Deleted 1 file: <ul><li>%s</li></ul>', htmlspecialchars($_GET['deletedfile']))); } $dbl97 = ''; $GlF9a = ''; $HYA99 = isset($_GET['filter']) ? trim(strtolower($_GET['filter'])) : (isset($_POST['filter']) ? trim(strtolower($_POST['filter'])) : ''); switch($HYA99) { case 'approved': $dbl97 = ' WHERE Verified = ' . UrH28; $GlF9a = 'approved'; break; case 'pending': $dbl97 = ' WHERE Verified = ' . Lbe2a; $GlF9a = 'pending'; break; case 'denied': $dbl97 = ' WHERE Verified = ' . GzZ29; $GlF9a = 'denied'; break; } $aZr114 = isset($_GET['search']) ? trim(strtolower($_GET['search'])) : ''; $oZU113 = ''; if ($aZr114 != '') { if ($dbl97 != '') { $dbl97.= ' AND '; } else { $dbl97 = ' WHERE '; } $cIhc0 = '%' . $db->Escape($aZr114) . '%'; $oZU113 = sprintf(' (Name LIKE \'%s\' OR Description LIKE \'%s\' OR Author_Name LIKE \'%s\') ', $cIhc0, $cIhc0, $cIhc0); $dbl97.= $oZU113; }  
$UlS6f = $rTfc2 = isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 1 ? floor($_GET['page']) : (isset($_POST['page']) && is_numeric($_POST['page']) && $_POST['page'] > 1 ? floor($_POST['page']) : 1); $NdY133 = 1; $BBjc1 = 20; $rTfc2 = ($UlS6f-1) * $BBjc1; $kabe7 = ''; $TkZe8 = 'files.php'; if ($GlF9a != '') { $TkZe8.= sprintf('?filter=%s&amp;page=', $GlF9a); } else { $TkZe8.='?page='; } $files = $db->Select(sprintf('SELECT * FROM %s %s ORDER BY Name ASC LIMIT %d, %d;', ojb22, $dbl97, $rTfc2, $BBjc1)); $SnC94 = $db->bLP2d(sprintf('SELECT COUNT(ID) FROM %s %s;', ojb22, $dbl97)); if ($SnC94 > 0) { $NdY133 = ceil($SnC94 / $BBjc1); if ($NdY133 > 1) { if ($UlS6f != 1) { $kabe7.= sprintf('<a href="%s%d" class="page page-prev">Previous</a> |', $TkZe8, $UlS6f - 1); } for($i = 1; $i <= $NdY133; $i++) { if ($i != $UlS6f) { $kabe7.= sprintf('<a href="%s%d" class="page page-num">%d</a>', $TkZe8, $i, $i); } else { $kabe7.= sprintf('<span class="page page-num page-current">%d</span>', $i); } } if ($UlS6f != $NdY133) { $kabe7.= sprintf('| <a href="%s%d" class="page page-next">Next</a>', $TkZe8, $UlS6f + 1); } } } $ITa132 = $db->bLP2d(sprintf('SELECT COUNT(ID) FROM %s %s %s', ojb22, ($oZU113 != '' ? ' WHERE ' : ''), $oZU113)); $JoG4d = $db->bLP2d(sprintf('SELECT COUNT(ID) FROM %s WHERE Verified = %s %s %s', ojb22, UrH28, ($oZU113 != '' ? ' AND ' : ''), $oZU113)); $sPged = $db->bLP2d(sprintf('SELECT COUNT(ID) FROM %s WHERE Verified = %s %s %s', ojb22, Lbe2a, ($oZU113 != '' ? ' AND ' : ''), $oZU113)); $Hqf7c = $db->bLP2d(sprintf('SELECT COUNT(ID) FROM %s WHERE Verified = %s %s %s', ojb22, GzZ29, ($oZU113 != '' ? ' AND ' : ''), $oZU113)); $db->Close(); require ROOT . 'admin/tpl/overallheader.php'; require ROOT . 'admin/tpl/files.php'; require ROOT . 'admin/tpl/overallfooter.php';  ?>