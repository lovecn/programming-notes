//http://stackoverflow.com/questions/3331992/how-to-delete-from-multiple-tables-in-mysql
select * from delete_test order by create_time desc;
+----+------+---------------------+
| id | code | create_time         |
+----+------+---------------------+
|  6 | fff  | 2016-06-17 22:19:04 |
|  5 | eee  | 2016-06-17 22:18:59 |
|  4 | ddd  | 2016-06-17 22:18:53 |
|  3 | ccc  | 2016-06-17 22:18:48 |
|  2 | bbb  | 2016-06-17 22:18:42 |
|  1 | aaa  | 2016-06-17 22:18:37 |
+----+------+---------------------+

#尝试一 失败
delete from delete_test where code in (select code from delete_test order by create_time desc limit 3);
ERROR 1235 (42000): This version of MySQL doesn't yet support 'LIMIT & IN/ALL/ANY/SOME subquery'

#尝试二 失败
delete from delete_test a where  exists (select code from delete_test b where a.code = b.code order by b.create_time desc limit 3);
ERROR 1064 (42000): You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a where  exists (select code from delete_test b where a.code = b.code order by b' at line 1

#尝试三 失败
delete from delete_test a, (select code from delete_test order by create_time desc limit 3) b where a.code = b.code;
ERROR 1064 (42000): You have an error in your SQL syntax; check the manual that corresponds to your MySQL server version for the right syntax to use near 'a, (select code from delete_test order by create_time desc limit 3) b where a.co' at line 1

#尝试四 失败 但明明code字段是唯一索引啊（UNIQUE KEY `code` (`code`)）
delete a from delete_test a, (select code from delete_test order by create_time desc limit 3) b where a.code = b.code;
ERROR 1175 (HY000): You are using safe update mode and you tried to update a table without a WHERE that uses a KEY column
#尝试五 失败 改用join 显式使用id主键 
delete a from delete_test a join (select code from delete_test order by create_time desc limit 3) b on a.code = b.code where a.id>0;
ERROR 1175 (HY000): You are using safe update mode and you tried to update a table without a WHERE that uses a KEY column

#然后重新连接会话 没有使用--safe-updates
mysql -uroot -p123456
#删除成功
delete a from delete_test a, (select code from delete_test order by create_time desc limit 3) b where a.code = b.code and a.id>0;
Query OK, 3 rows affected (0.00 sec)
# 验证已成功删除
select * from delete_test order by create_time desc;
+----+------+---------------------+
| id | code | create_time         |
+----+------+---------------------+
|  3 | ccc  | 2016-06-17 22:18:48 |
|  2 | bbb  | 2016-06-17 22:18:42 |
|  1 | aaa  | 2016-06-17 22:18:37 |
+----+------+---------------------+

DELETE FROM `pets` p,
            `pets_activities` pa
      WHERE p.`order` > :order
        AND p.`pet_id` = :pet_id
        AND pa.`id` = p.`pet_id`
        
        DELETE p, pa
      FROM pets p
      JOIN pets_activities pa ON pa.id = p.pet_id
     WHERE p.order > :order
       AND p.pet_id = :pet_id
