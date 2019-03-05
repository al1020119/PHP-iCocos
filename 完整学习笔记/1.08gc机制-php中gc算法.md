# 垃圾回收机制(garbage collection)

在高级语言中有个很重要的机制叫做垃圾回收(gc)，高级语言不需要手动释放变量，是由语言本身来判断什么时候释放某个变量，而我们需要了解某个变量什么时候被语言释放(回收)了。

 在PHP中没有任何变量指向一个对象时，这个对象就成了垃圾，PHP会将其在内存中销毁，这就是PHP的垃圾回收机制，防止内存溢出

### 一、引用计数
我们知道，PHP变量是存在一个叫zval的变量容器里面，zval有两个变量，一个是`is_ref`来标识这个变量是否属于引用，一个是`refcount`用来统计指向这个变量容器的变量的个数

如下例所示：
``` 
<?php
    $a = "String";
    xdebug_debug_zval('a');
    
#       输出结果
#       a: (refcount=1, is_ref=0)='String'

//  将$a赋给$b
    $b = $a;
    xdebug_debug_zval('a');

#       输出结果
#       a: (refcount=2, is_ref=0)='String'
//  此时我们可以看到refcount的值变为了2，也就是有两个变量指向了这个变量容器
```
当变量不在指向变量容器，或者调用了unset（unset的真实含义并不是删除某个变量，而是让他不再指向某个变量容器）`refcount`的值就会减少
``` 
<?php
    $a = "new string";
    $c = $b = $a;
    xdebug_debug_zval( 'a' );
    unset( $b, $c );
    xdebug_debug_zval( 'a' );
    
#       输出结果
#       a: (refcount=3, is_ref=0)='new string'
#       a: (refcount=1, is_ref=0)='new string
```
上面的例子只是简单的说明了字符串这种简单类型，PHP中array和Object这种复合类型的时候，就会稍微复杂一点
``` 
<?php
$a = array( 'meaning' => 'life', 'number' => 42 );
xdebug_debug_zval( 'a' );

#       输出结果
a: (refcount=1, is_ref=0)=array (
   'meaning' => (refcount=1, is_ref=0)='life',
   'number' => (refcount=1, is_ref=0)=42
)
```
这个时候会产生三个变量容器分别是a、meaning、number。我们在对程序做一些修改
``` 
<?php
$a = array( 'meaning' => 'life', 'number' => 42 );
$a['life'] = $a['meaning'];
xdebug_debug_zval( 'a' );

#   输出结果
a: (refcount=1, is_ref=0)=array (
   'meaning' => (refcount=2, is_ref=0)='life',
   'number' => (refcount=1, is_ref=0)=42,
   'life' => (refcount=2, is_ref=0)='life'
)
```
我们可以看到life和meaning是指向的同一个变量容器，所以他们的refcount都是2

如果我们将一个数组元素添加给自己本身:
``` 
<?php
$a = array( 'one' );
$a[] = &$a;
xdebug_debug_zval( 'a' );

#       输出结果
a: (refcount=2, is_ref=1)=array (
   0 => (refcount=1, is_ref=0)='one',
       1 => (refcount=2, is_ref=1)=...
)
```
我们看到了a本身和第二个元素1的refcount为2，这样形成了一个递归循环，a的第二个元素指向了他自己。如果对$a进行unset操作，$a的变量容器引用次数减一，变成了：
``` 
(refcount=1, is_ref=1)=array (
   0 => (refcount=1, is_ref=0)='one',
   1 => (refcount=1, is_ref=1)=...
)
```
尽管没有变量指向这个容器，由于他自己的第二个元素始终指向他本身，就没有办法回收这个变量容器，造成了内存泄露

### 二、回收周期(Collecting Cycles)
我们可以从上面的例子看到，PHP的引用计数内存的机制，无法处理循环的引用内存泄露问题，在PHP5.3（或者是5.4）版本，使用了一种叫同步周期回收的算法，来处理这个内存泄露的问题。  
这个算法的基础规则是：
>如果一个引用计数增加，它将继续被使用，当然就不再在垃圾中。如果引用计数减少到零，所在变量容器将被清除(free)。就是说，仅仅在引用计数减少到非零值时，才会产生垃圾周期(garbage cycle)。其次，在一个垃圾周期中，通过检查引用计数是否减1，并且检查哪些变量容器的引用次数是零，来发现哪部分是垃圾。  

