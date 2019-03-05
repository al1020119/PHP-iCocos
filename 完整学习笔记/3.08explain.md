# explain分析sql语句

现有如下的sql语句`EXPLAIN SELECT * FROM inventory WHERE item_id = 16102176;`  
打印结果如下：
``` 
  id: 1  
  select_type: SIMPLE  
  table: inventory  
  type: ref  
  possible_keys: item_id  
  key: item_id  
  key_len: 4  
  ref: const  
  rows: 1  
  Extra: Using where
```
1. key: 指出优化器使用的索引。
2. rows: mysql认为他查询必须要检查的行数，优化器估计值。
3. possible_keys: 支出优化器为查询选定的索引
4. key_len: sql语句的连接条件的键的长度
5. select_type: select使用的类型。  
   有以下几种： simple（简单的select不含union或子查询）、primary（最外面的select）、union（union中第二个或后面的select）、dependent union（union中第二个或后面的select，取决于外面的查询）、union result（union的结果）、 subquery（子查询中第一个select）
6. type： 连接类型。system（表仅有一行）、const（表最多有一个匹配行）、eq_ref(对于每个前面的表的行组合，从该表中读取一行)、ref（对于每个来自于前面表的行组合，所有匹配索引值将从这张表中读取）、index_merge(使用了索引合并优化方法)、all（完整的表扫描）
7. ref： 显示使用哪个列或常数与key一起从表中选择行