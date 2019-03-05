### 自动加载和命名空间
__autoload($className) 尝试加载未定义的类

我们可以理解为：
- 在new一个对象的时候，如果没有找到这个类的定义，会调用__autoload
- 会自动向autoload魔术方法传递类名$className

要找到目标的文件并加载则需要经历：
- 根据类名，确定文件名（在autoload里面实现）
- 确认类文件的路径
- 将所需要的类文件加载进来

下面代码实现了在找不到类定义时，会尝试到当前文件夹下寻找类名为文件名的文件加载进来
```
function __autoload($className) {
	$file = __DIR__.'/'.$className. '.php';
    	if (file_exists($file)) {
    		require $file;
    	}
}
```
但是我们只实现了加载当前目录下的文件，如果与autoload文件在不同层级的文件，则需要修改一下我们之前的代码,使之能加载其他层级的文件：
```
function __autoload($className) {
	$dirs = array(
		__DIR__,
		__DIR__ . '/Config/',
	);
	
	foreach($dirs as $dir) {
		$file = $dir.'/'.$className. '.php';
		if (file_exists($file)) {
			require $file;
		}
	}
}
```
>spl_autoload_register() 提供了一种更加灵活的方式来实现类的自动加载。因此，不再建议使用 __autoload() 函数，在以后的版本中它可能被弃用。

我们再次修改上面的autoload代码：
```
function autoload($class) {
	static $map = array();
	$dirs = array(
		__DIR__,
		__DIR__.'/Demo/',
	);

	if(!isset($map[$class])) {
		foreach ($dirs as $dir) {
			$file = $dir.'/'.str_replace('\\', '/', $class). '.php';
			if (file_exists($file)) {
				require $file;
				$map[$class] = true;
			}
		}
	}
}

//注册
spl_autoload_register('autoload');
```
`spl_autoload_register`会将函数注册到SPL__autoload函数队列中，当new一个类的时候，会从这个队列中找到想要的类