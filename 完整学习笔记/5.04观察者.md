<?php
/**
 * Created by PhpStorm.
 * User: haobin
 * Date: 2017/10/9
 * Time: 16:26
 */

/**
 * 观察者模式：
 * 一个对象通过添加一个方法（该方法允许另一个对象，即观察者 注册自己）使本身变得可观察。
 * 当可观察的对象更改时，它会将消息发送到已注册的观察者。这些观察者使用该信息执行的操作与可观察的对象无关。
 * 结果是对象可以相互对话，而不必了解原因。
 */

interface IObserver {
    function onChange($sender, $args);
}

interface IObservable {
    function addObserver($observer);
}

class UserList implements IObservable {
    private $_obervers = [];
    
    public function addCustomer($name) {
        foreach($this->_obervers as $oberver) {
            $oberver->onChange($this, $name);
        }
    }
    
    public function addObserver($observers)
    {
        $this->_obervers = $observers;
    }
}

class UserListLogger implements IObserver {
    public function onChange($sender, $args)
    {
        echo "{$args} added to user list \n";
    }
}

$ul = new UserList();
$ul->addObserver(new UserListLogger());
$ul->addCustomer("haobin");