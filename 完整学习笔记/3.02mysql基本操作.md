## MySQL基本操作

### 一、常用命令
- veresion();    //显示当前服务版本
- now();     //显示当前时间
- user();    //显示当前用户
- concat('a', 'b');     //字符链接
- concat_ws('-', 'a', 'b'); //使用指定分隔符连接
- lower('MYSQL') upper('mysql') //大小写转换
- left('mysql', 2)  //左截取 right('mysql', 2) //右截取
- length('mysql')   //获取字符串长度
- replace('-my-sql', '-', '+')  //替换字符
- substring('mysql', 1 ,2)  //截取字符
- date_format('2017-9-11', '%Y-%m-%d'); //日期格式化
- avg();    //平均值
- count();  //总数
- max(); min()   //最大值，最小值
- sum();    //求和

### 二、常用数据库操作
1.创建数据库
```
create {database|schema} [if not exists] db_name [default] character set [=] charset_name
例：CREATE DATABASE test;
```
2.修改数据库
``` 
alter {database|schema} db_name [default] character set [=] charset_name
例：ALTER DATABASE test CHARACTER SET utf8;
```
4.删除数据库
``` 
drop {database|schema} [if exists] db_name
例：DROP DATABASE test;
```

### 三、常用数据表操作
1.创建表
``` 
create table [if not exists] tbl_name(
    age tinyint(2) unsigned not null auto_increment primary key
);
例：CREATE TABLE user(
    id INT(10) UNSIGNED AUTO_INCREMENT PRIMARY KEY,//主键自增
    name VARCHAR(20) NOT NULL UNIQUE KEY,//唯一
    price DECIMAL(8,2) UNSIGNED DEFAULT 0.00,//默认
    cid INT(10) UNSIGNED,
    KEY cid(cid),
    FOREIGN KEY (cid) REFERENCES cate (id) ON DELETE CASCADE//外键 （删除时执行CASCADE）
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
```
2.查看表结构
``` 
show colums from tbl_name;
例：SHOW COLUMUNS FROM user
```
3. 修改表结构
``` 
alter table tbl_name op[add|drop|modify] [column] (col_name column_definition,..);
例：
ALTER TABLE user ADD num INT(10) UNSIGNED, time INT(10) UNSIGNED;  // 添加字段
ALTER TABLE user DROP num,DROP time;    // 删除字段
```
4.插入
``` 
（1）insert [into] tbl_name [(col_name,..)] {values|value} ({expr|default},...),(...),...;
例：INSERT user (id,name,price) VALUES (DEFAULT,tom',20);
```
5.更新
``` 
update tbl_name set col_name1={expr1|default} [,col_name2={expr2|default}].. [where where_condition]
例：UPDATE user SET num = num + id;
```
6.删除
``` 
delete from tbl_name [where where_condition]
例：DELETE FROM user WHERE id=3;
```

### 四、约束性
(1)主键约束：primary key
1. 每个表只存在一个
2. 保证记录的唯一性
3. 自动为not null
4. 添加了主键约束
(2)唯一约束： unique key
1. 每个表可以存在多个
2. 保证记录的唯一性
3. 可以存一个null
4. 添加了唯一约束
(3)默认约束：default
1. 给列添加了默认值
``` 
例如：
ALTER TABLE user ALTER num SET DEFAULT 0;
ALTER TABLE user ALTER num DROP DEFAULT;
```
(4)非空约束
(5)外键约束
1. 保证了数据的一致性，实现了1对1,1对多的关系
2. cascade：从父表中删除或更新且自动删除或更新子表中的匹配行
3. set nul： 从父表删除或更新并设置子表中的外键列为null。如果使用该选项，必须保证子表没有指定not null
4. restrict：拒绝对父表的删除或更新操作
``` 
添加外键约束：
 alter table tbl_name add [constraint [symbol]] foreign key [index_name] (index_col_name,...) reference_definition
 例：ALTER TABLE user ADD FOREIGN KEY (cid) REFERENCES cate (id)
 删除外键约束：
 alter table tbl_name drop foreign key symbol
  例：ALTER TABLE user DROP FOREIGN KEY cid;
```
###五、子查询
嵌套在内部，始终出现在括号内;
可以包含多个关键字或条件，如distinct，group by，order by，limit，函数等;
外层可以是：select，insert，update，set
1.比较运算符:=,>,<,<=,>=,<>
``` 
select * from t1 where col_name1 >= ANY (select col_name2 from t2);
(1)any:符合任意一个
(2)all:符合所有
```
2.（not）in/exists
```
select * from t1 where col_name1 NOT IN ALL (select col_name2 from t2);
```

### 六、连接查询
1.内连接（inner join），左连接（left join）， 右连接（right join）,全连接（full join）， 交叉连接（across join）
``` 
现有两张表A、B
表A
id   name  
1    张
2    李
3    王

表B
id   address   A_id
1    北京      1
2    上海      3
3    南京      10

**************left join**********
SELECT A.name, B.address
FROM A
LEFT JOIN B ON A.id = B.A_id 
结果是：
name     address
张     北京
李     NULL
王     上海

可以看到A表（左边的表）的所有行都显示出来了，B表中没有匹配到的行是NULL值

************right join***********
SELECT A.name, B.address
FROM A
RIGHT JOIN B ON A.id = B.A_id
结果是：
name     address
张     北京
王     上海
NULL     南京
与left join相反，B表（右边的表）中的行全显示出来，A表中匹配不到的行显示NULL

**********inner join************
select A.name,B.address from A 
inner join B
on A.id = B.A_id
结果是：
name     address
张     北京
王     上海

内连接等价于：
SELECT A.name, B.address
FROM A, B
WHERE A.id = B.A_id

内连接只返回A、B两表都有的行，相当于A、B的交集

*********full join**********
全外连接返回参与连接的两个数据集合中的全部数据，无论它们是否具有与之
相匹配的行。在功能上，它等价于对这两个数据集合分别进行左外连接和右外
连接，然后再使用消去重复行的并操作将上述两个结果集合并为一个结果集

select * from A 
full join B
结果是：
id     name     id     address A_id
1     张     1     北京     1
2     李     1     北京     1
3     王     1     北京     1
1     张     2     上海     3
2     李     2     上海     3
3     王     2     上海     3
1     张     3     南京     10
2     李     3     南京     10
3     王     3     南京     10

*********across join***********
返回笛卡尔积，A*B
SELECT * FROM A
CROSS JOIN B
结果是：
id     name     id     address A_id
1     张     1     北京     1
2     李     1     北京     1
3     王     1     北京     1
1     张     2     上海     3
2     李     2     上海     3
3     王     2     上海     3
1     张     3     南京     10
2     李     3     南京     10
3     王     3     南京     10
等价于sql：
select * from A,B
```
4.联合查询（union与union all）

把多个结果集集中在一起





