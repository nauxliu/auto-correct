# auto-correct
自动给中英文之间加入合理的空格并纠正专用名词大小写

## 安装
首先你需要安装有 `composer`，然执行下面的命令安装：
```
composer require naux/auto-correct
```

## 使用
```php
use Naux\AutoCorrect;

$correct = new AutoCorrect;

// 加入空格并纠正词汇
$correct->convert($value);

// 在中英文之间加入合理的空格
$correct->auto_space($value);

// 纠正专用词汇大小写
$correct->auto_correct($value);
```
