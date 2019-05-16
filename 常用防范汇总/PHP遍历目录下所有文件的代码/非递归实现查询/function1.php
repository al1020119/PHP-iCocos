<?php 

/**
 * 遍历某个目录下的所有文件
 * @param string $dir
 */
function scanAll($dir)
{
  $list = array();
  $list[] = $dir;
 
  while (count($list) > 0)
  {
    //弹出数组最后一个元素
    $file = array_pop($list);
 
    //处理当前文件
    echo $file."\r\n";
 
    //如果是目录
    if (is_dir($file))
    {
      $children = scandir($file);
      foreach ($children as $child)
      {
        if ($child !== '.' && $child !== '..')
        {
          $list[] = $file.'/'.$child;
        }
      }
    }
  }
}

?>