# PHP基础知识

### 一、运算符的优先级
- [官方手册](http://php.net/manual/zh/language.operators.precedence.php)
- 递增/递减>！>算数运算符>大小比较>（不）相等比较>引用>位运算符（^ > | > &）> 三目 > 赋值 > and > or
``` 
看一个例子
$a = false || true;
$b = flase or true;
```
结果$a = true,因为||的优先级大于=所以先执行(false || true)

$b=false，因为or的优先级最小，先执行$b=false

``` 
$a = 0;
$b = 0;
if($a=3 > 0 || $b =3 > 0) {
    $a++;
    $b++;
    echo $a.'\n';
    echo $b.'\n';
}
```
结果$a=1,$b=1;因为 > 优先级高于 || 高于 =，所以先执行3>0所以$a=true,直接执行if的代码块

### 二、流程控制
- PHP除了for和foreach之外，还有一种循环的方式list() each() while()
```  
$array = [
    'a' => 'apple',
    'b' => 'banana',
    'c' => 'carrot',
];
// each提取出当前元素的key、value并向前移动数组指针
while(list($key, $value) = each($array)){
    var_dump($key,$value);
    echo "<br>";
}
```
foreach与while-list-each的区别是，foreach遍历前会reset数组指针，而while-list-each则不会。
### 三、作用域以及静态变量

- 局部变量是无法使用全局变量的
``` 
// 全局变量
$outer = 'str';
function myfunc(){
    echo $outer; ->会报错
}

//如果要在局部使用全局变量需要用global关键字:
function myfunc(){
    global $outer; // $GLOBALS['outer'];也可以
    echo $outer; //str
}
```
- 静态变量
>1.静态变量仅初始化一次，并且初始化的时候需要赋值  
2.每次执行函数都会保留该值  
3.static是局部的变量，仅在函数内部有效  
4.在递归的时候可以用来记录函数的调用次数，从而作为终止递归的条件

``` 
$count = 5;
function echo_count(){
    static  $count;
    return $count++;
}
echo $count; //5
echo "<br>";
++$count;
echo echo_count(); // null 没有给局部变量$count初始化
echo "<br>";
echo echo_count(); // 1     null + 1 =1 
```

### 四、函数的返回值
- 函数的引用返回：

从函数返回一个引用，必须在函数声明和指派返回值给一个变量都使用&
``` 
function &myFunc(){
    static $b = 10;
    return $b;
}
$a = myFunc();  -> $a=10;
$a = &myFunc(); -> $a和$b互为引用
$a = 100; -> $a修改同时也修改了$b
echo myFunc(); // 输出100
```
- 外部文件的导入

require/include语句包含并运行指定的文件，如果给出路径名就会从路径名中查找，否则从include_path(环境变量)中查找，如果include_path也没有，则从调用脚本所在目录和当前工作目录下查找。当一个文件被包含的时候，其中所包含的代码继承了include所在行的变量范围。

加载过程中如果没有找到文件，require会发出一个致命错误(E_COMPILE_ERROR)脚本终止；include(E_WARNING)产生一个警告，程序会继续运行

总结：
``` 
$var1 = 5;
$var2 = 10;

function foo(&$my_var){
    global $var1;
    $var1 += 2;
    $var2 = 4;
    $my_var += 3;
    return $var2;
}

$my_var = 5;

echo foo($my_var). "\r\n"; //4 局部变量$var2
echo $my_var. "\r\n"; // 8  引用传递改变值
echo $var1; // 7    // 全局变量 $var1在局部函数里面+2
echo $var2; // 10   // 全局变量$var2 并未修改过
$bar = 'foo';
$my_var = 10;
echo $bar($my_var). "\n"; // 4 还是输出局部变量$var2
```
