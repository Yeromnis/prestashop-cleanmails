<?php
/**
 * pscleanmails
 *
 * removes the 'powered by PrestaShop' mention from the PrestaShop mails (TXT and HTML formats).
 *
 * @version 1.0
 * @author Yeromnis
 */

echo "Filtering the mails... ";

$count = 0;
$iterator = new RecursiveDirectoryIterator('mails');
foreach(new RecursiveIteratorIterator($iterator) as $file)
{
  switch (strtolower(pathinfo($file)['extension'])) {
    case 'html':
      $filecontent = file_get_contents($file, FILE_USE_INCLUDE_PATH);
      $filteredcontent = preg_replace('/<span(.*)powered(.*)span>/', '&nbsp;', $filecontent);
      file_put_contents($file, $filteredcontent);
      $count++;
      break;
    case 'txt':
      $filecontent = file_get_contents($file, FILE_USE_INCLUDE_PATH);
      $filteredcontent = preg_replace('/powered by\s*(.*)]/', '', $filecontent);
      file_put_contents($file, $filteredcontent);
      $count++;
      break;
  }
}

echo "$count file(s) found. Done.<br>";

?>
