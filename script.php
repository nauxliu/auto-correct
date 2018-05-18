<?php
/**
 * Created by PhpStorm.
 * User: kurisu
 * Date: 2018/05/18
 * Time: 16:11
 */

require 'AutoCorrect.php';
const BACKUP = '-b';

$fileArr = [];
$auto = new \Naux\AutoCorrect();

//参数检查
foreach ($argv as $key => $value) {
    if ($key == 0) {
        continue;
    }
    if ($value == BACKUP) {
        continue;
    }

    if (is_file($value)) {
        array_push($fileArr, $value);
        continue;
    }

    if (is_dir($value)) {
        //遍历目录，并与fileArr合并
        $folderFileList = getFolderFiles($value);
        $fileArr = array_merge($folderFileList, $fileArr);
        continue;
    }

    throw new Exception("unKnow str $value \n");
}

//是否需要备份
//TODO 在目标文件和目标文件夹的同一级目录内进行备份
if (in_array(BACKUP, $argv)) {
    //TODO 备份操作
    foreach ($argv as $key => $value) {
        if ($key == 0) {
            continue;
        }
        if ($value == BACKUP) {
            continue;
        }

        if (is_file($value) || is_dir($value)) {
            copy($value, $value . '.backup');
            continue;
        }
    }
}

//开始修正格式
foreach ($fileArr as $file) {
    $content = file_get_contents($file);
    $content = $auto->convert($content);
    file_put_contents($file, $content);
}


function getFolderFiles($dirPath)
{
    $fileList = scandir($dirPath);
    $fileListTmp = [];
    //去除 . 和 ..
    array_splice($fileList, 0, 2);
    foreach ($fileList as $key => $fileName) {
        if (is_dir($dirPath . $fileName)) {
            unset($fileList[$key]);
            $fileListTmp_ = $this->getDirAllFile($dirPath . $fileName . '/');
            $fileListTmp = array_merge($fileListTmp, $fileListTmp_);
        } else {
            $fileList[$key] = $dirPath . $fileName;
        }
    }
    $fileList = array_merge($fileList, $fileListTmp);
    return $fileList;
}