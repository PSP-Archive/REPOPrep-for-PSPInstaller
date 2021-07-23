<?php

/****************************************************************************
**
** Project:      PSPInstaller - RepoPrep
** File:         /include/config.php
** Version:      2010-01-20; 1.0.5.8
** Author:       Michel van den Brink (Just Like Ed.net)
** Decription:   
**
****************************************************************************/

$_CONFIG = array();

function loadConfig($db) {
	global $_CONFIG;
	$_CONFIG = array();
	$configs = $db->Select(sprintf('SELECT Name, Value FROM %s WHERE AutoLoad = 1;', MYSQL_CONFIGTABLE));
	if (is_array($configs) && count($configs) != 0) {
		foreach($configs as $c) {
			$name = strtolower($c['Name']);
			$value = $c['Value'];
			if (substr($value, 0, 2) == 'a:' && strpos($value, '{') !== false) {
				$value = unserialize($value);
			}
			$_CONFIG[$name] = $value;
		}
	}
}

function config($name, $value = NULL) {
	global $db, $_CONFIG;
	$name = strtolower($name);
	if ($value !== NULL) {
		$_CONFIG[$name] = $value;
		if (isset($db) && $db->IsOpen()) {
			if (is_array($value)) {
				$value = serialize($value);
			}
			$db->Update(sprintf('UPDATE %s SET `Value` = \'%s\' WHERE `Name` = \'%s\' LIMIT 1;', MYSQL_CONFIGTABLE, $db->Escape($value), $name));
		} else {
			throw new Exception('Unable to update value ' . $name);
		}
	}
	return isset($_CONFIG[$name]) ? $_CONFIG[$name] : NULL;
}

function repoFilePath($filename = NULL) {
	$filename = $filename == NULL ? config('Reg_RepoName') : $filename;
	return sprintf('%sfiles/repo/%s.lua', ROOT, $filename);
}

function version() {
	return config('Version');
}

function apikey() {
	return config('Reg_APIKey');
}

function sitename() {
	return config('Reg_Name');
}

function siteurl() {
	return config('URL');
}

function systemstatus() {
	return config('Reg_Status');
}

function lastregsynch() {
	return config('Reg_LastSynch');
}

?>