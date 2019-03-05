# PHP引用

### 一. COW（copy on write）写时复制
首先来看一段代码：
```
$j = 1;
var_dump(memory_get_usage());
 
$tipi = array_fill(0, 100000, 'php-internal');
var_dump(memory_get_usage());
 
$tipi_copy = $tipi;
var_dump(memory_get_usage());
 
foreach($tipi_copy as $i){
    $j += count($i); 
}
var_dump(memory_get_usage());
 
//-----执行结果-----
$ php t.php 
int(630904)
int(10479840)
int(10479944)
int(10480040)
```
从上面我们可以看到，当数组$tipi赋值给了$tipi_copy时，内存并没有立即增加一半，也就是说当一个变量被赋值后，只要我们不改变变量的值，就与使用引用一样。只有当变量被修改时，才会重新开辟一片空间。

但是对于对象来说，本身就是一种引用传递，并不会遵循cow

现有如下程序
```
$data = ['a', 'b', 'c'];
foreach($data as $key => $val){
    $val = &$data[$key];
}
var_dump($data)
程序运行完毕后$data的值是多少，为什么
```
结果是['b','c','c']

- 第一次循环时 $key=0 $val=a
此时$val = &$data[0]，即$val是$data[0]的引用，此时$data[0]和$val都是a
-第二次循环时，$key=1 $val=b，因为$val是$data[0]的引用，所以$data[0]也为b,
$val = &$data[1]，即$val变成了$data[1]的引用，此时
$data[0]=b $data[1]=b $val=b
-第三次循环时, $key=2， $val=c，同上，$val是$data[1]的引用，所以$data[1]=c
此时：$data[1]=b,$data[2]=c, $data[3]=c $val=c

