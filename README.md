# auto-correct

自动给中英文之间加入合理的空格并纠正专用名词大小写

## 安装

首先你需要安装有 `composer`，然后执行下面的命令安装：
```
composer require naux/auto-correct
```

## 使用

```php
use Naux\AutoCorrect;

$correct = new AutoCorrect;

// 在中英文之间加入合理的空格
$correct->auto_space("php是世界上最好的语言，之一"); // php 是世界上最好的语言，之一

// 纠正专用词汇大小写
$correct->auto_correct("php是世界上最好的语言，之一"); // PHP是世界上最好的语言，之一

// 加入空格并纠正词汇（auto_space + auto_correct）
$correct->convert("php是世界上最好的语言，之一"); // PHP 是世界上最好的语言，之一

//添加外置词典，可添加多个
echo $auto
  ->withDict(['hello world' => 'Hello World'])
  ->withDict(['foo bar' => 'Foo Bar'])
  ->convert('hello world, foo bar, phphub'); // Hello World, Foo Bar, PHPHub
```

## 应用案例

[LaravelChina (PHPHub)](https://laravel-china.org/) - 整站标题都做了自动转换处理。
