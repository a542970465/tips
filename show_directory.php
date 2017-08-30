<?php
###################
# User:Lei        #
# Time:2017/08/30 #
###################


// Recursive shows all directory in the folder (with absolute path):to solve the Chinese messy code

function show_all_dir($dir)
{

	$dir = iconv('utf-8', 'gb2312', $dir);

	$result = array();
	$handle = opendir($dir);

	if ($handle) {

		while(($file = readdir($handle)) != false) {

			if ($file != '.' && $file != '..') {

				$cur_path = $dir . DIRECTORY_SEPARATOR . $file;

				if (is_dir($cur_path)) {

					// to convert into Chinese
					$cur_path = iconv('gb2312', 'utf-8', $cur_path);
					$result['dir'][$cur_path] = show_all_dir($cur_path);
				} else {
					$cur_path = iconv('gb2312', 'utf-8', $cur_path);
					$result['file'][] = $cur_path;
				}
			}
		}
		closedir($handle);
	}
	return $result;
}

$dir = 'E:\测试';
echo '<pre>';
var_dump(show_all_dir($dir));