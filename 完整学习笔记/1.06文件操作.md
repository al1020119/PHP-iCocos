# PHP文件处理

### 一、文件读写的两种模式
1. fopen()打开文件的形式

此方式打开一个文件需要指定打开模式：r/r+(只读/读写) 将文件指针指向文件开头、w/w+(只写/读写) 文件指针指向文件开头，如果文件不存在会创建文件，每次都会覆盖文件内容、  a/a+(写入/读写) 文件指针指向文件末尾，如果文件不存在则会创建文件、 x/x+(写入/读写)，将文件指针指向文件开头，如果文件已经存在则会fopen调用失败返回false并产生一条warning

此模式的写入函数:fwrite()、 fputs()

此模式的读取函数：fread()、fgets()、fgetc()

fclose()关闭文件指针

2.不需要fopen打开的

file_get_contents()、 file_put_contents()

### 二、对文件目录的操作

需要熟悉目录操作的各个函数，再次不做赘述

写一个遍历目录的程序:
```  
//该代码在 /code/dir.php

$dirPath = "./test_dir";

function loopDir($dirPath) {
    $handle = opendir($dirPath);
    // 此处用全等于，如果目录名称为0返回也是false所以要类型也相等
    while(false !== ($file = readdir($handle))) {
        if($file != '.' && $file != '..') {
            echo $file."<br>";
            if(is_dir($dirPath.'/'.$file)) {
                loopDir($dirPath.'/'.$file);
            }
        }
    }
}
loopDir($dirPath);
```
