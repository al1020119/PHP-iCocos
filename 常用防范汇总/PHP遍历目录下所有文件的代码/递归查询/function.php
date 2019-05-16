<?php 

/**
 * 遍历某个目录下的所有文件(递归实现)
 * @param string $dir
 */
function scanAll2($dir)
{
  echo $dir."\r\n";
 
  if (is_dir($dir))
  {
    $children = scandir($dir);
    foreach ($children as $child)
    {
      if ($child !== '.' && $child !== '..')
      {
        scanAll2($dir.'/'.$child);
      }
    }
  }
}

?>