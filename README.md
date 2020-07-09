<h1 align="center"> 类库[\xltxlm\] </h1>
<p align="center"> 数据库操作类</p>

![](https://github.com/xltxlm/orm/workflows/单元测试/badge.svg)

> 数据库操作类;

# 代码编写原则:
- 遵循代码轮廓由后台配置生成,保证不会掺杂人为造成的错误
- 每一个特性都有对应的测试代码
- 向对象编程.每个类只实现一个__invoke函数
- 向对象编程,参数全采用set/get操作,抛弃函数,免去思考每个参数应该写的位置

## 关于composer

> 目前不考虑提供稳定的版本支持.

```shell
$ composer require "xltxlm/orm":"@dev"
```

## 单页测试 - 也是使用案例

>[本类库所有单元测试案例](./test/)

### 读懂单元测试目录结构

1.测试入口文件

test\类、结构体名称\要测试的函数test.php<br>
`runcode` 函数接受参数为：要处理的内容，以及测试函数可能会需要的函数参数（面向对象写法决定：大部分函数是不接受参数）

2.测试数据源表

test\类、结构体名称\要测试的函数test\要测试的数据源Provider.php<br>
`DataProvider` 函数提供一个测试表，为2维数组 <br>

3.数据源数组的结构有4个索引

* 要处理的输入
* 期望得到的结果
* 函数的参数
* 测试案例本身的说明

## License
MIT

