# PHP数据类型
三大数据类型：
- 标量：浮点，整型，字符串，布尔
- 复合：数组和对象
- 特殊：null，resource

浮点型：
- 不能用于比较类型
```
$a = 0.1;
$b = 0.7;
var_dump($a + $b == 0.8);
// 运算结果
false
```
因为我们的计算是由CPU转换成二级制进行计算，浮点数会有一些精度的丢失，0.1 + 0.7 的结果是0.799999.....

布尔型：
- false的七种情况
>0(整型) 0.0（浮点型） ''（空字符串） '0'（字符串0）
false(布尔值false) array()（空数组） NULL（null类型）

NULL的情况：未定义的变量、直接赋值为NULL、unset销毁的变量

常量：
- const与define：const是语言结构，define是函数（const更快）；define不能定义类的常量，const可以

- 预定义常量：
```
__FILE__(文件的路径) __LINE__(所在的行数) 
__DIR__(文件夹的路径) __FUNCTION__(所在函数的名称)
__CLASS__(所在类的名称) __TRAIT__(所在trait的名称)
__METHOD__(类名+方法名) __NAMESPACE__(命名空间)
```



