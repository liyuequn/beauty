<?php
//第一题答案
$sql = "select id from user where phone='131'
 union all
 select id from user where phone='139'";
//第二题答案
//粗暴一点的方法：以name分组，每个name查出一条数据来，然后删除整个表的数据，最后把取出来的数据重新插入进去（此方法不考虑性能，程序实现简单，就不写出来了）
//1.子查询的
$sql = "DELETE from users where id NOT in( SELECT id from (SELECT name from users Group by name Having count(name)>1) a )";
//2.内关联的
$sql = "DELETE u from test_users u inner join 
( select name, count(*)num,max(id) id  from test_users GROUP BY name HAVING num>1)m 
on  m.name=u.name and m.id<>u.id;";
//3.避免以后出现重复数据，应将name字段设为值唯一
//4.若以php实现的话，可以先用name分组查出几个id来，然后再根绝id删除这几个id之外的所有数据
//第三题答案
//  使用linux定时器即可 crontab -e  * 3 * * * php run.php
//第四题答案
/**
 * @param $arr
 * @param $start
 * @param $end
 * @return array
 * 数组切片
 */
function spliceArr($arr,$start,$end){
    $newArr = [];
    foreach ($arr as $key => $item){
        if($key>=$start && $key<=$end){
            $newArr[]=$arr[$key];
        }
    }
    return $newArr;
}
/**
 * @param $arr
 * @return array
 * 找出连续子数组中和最大的子数组
 */
function maxChildrenArr($arr){
    //1.找出所有的连续子数组
    //1.1先实现一个切片的函数
    //1.2弄出所有可能的的 开始索引和结束索引 并以+号连接
    $len = count($arr);
    $childrenValues = [];
    for ($i=0;$i<$len;$i++){
        for($j=0;$j<$len;$j++){
            if($j>=$i){
                $newArr = spliceArr($arr,$i,$j);
                $childrenValues[$i."+".$j] = array_sum($newArr);
            }
        }
    }
    //2.使用「排序」找出连续子数组的和最大的「开始索引」和「结束索引」
    $newChild = $childrenValues;
    sort($newChild);
    $max = array_pop($newChild);
    //3.猜测最大和可能不止一个，所以定义一个数组容器保存
    $res = [];
    foreach ($childrenValues as $key=>$value){
        if($value==$max){
            $tmpArr =explode('+',$key);
            $finalRes[] = spliceArr($arr,$tmpArr[0],$tmpArr[1]);
        }
    }
    return $finalRes;
}
$arr = [1, 2, -4, 4, 10, -3, 4, -5, 1];
$res = maxChildrenArr($arr);
print_r($res);

//第五题答案
//回想遇见最难的，讲真一直感觉最难的是未知的东西，曾经最难的可能就是设计模式了，因其抽象性所以难。
//设计模式按道理说跟语言是没有关系的，但市场上关于PHP的书籍好的也不太多，于是入门容易精通难。
//我的做法：后来于是我就开始尽可能的找资料，看过很多人的博客，读过《大话设计模式》《深入浅出设计模式》每次读都会仔细体味，
//并可能的以php的形式写出来练习，除了反复练习再就是平时写代码的时候去思考，
//因为有的时候不能为了设计模式而设计模式，最后导致代码可读性差，又不真正具备可扩展的特性以及代码可重用性等等特点，得不偿失，
//最后慢慢体会设计模式在根本上是为了代码的重用性、可扩展、更容易被他人理解，并学习了设计的原则，然后再回头去读那些书，去研究一些框架的源码，学习其设计，
//最终掌握了一些常用的设计模式如：简单工厂，工厂模式，单例模式，策略模式
