<?php
/**
 * Created by PhpStorm.
 * User: haobin
 * Date: 2017/9/30
 * Time: 17:25
 */

/**
 * Class SingleTon
 * 单例模式
 * 1. 不通过构造方法获取实例
 * 2. 有一个静态属性保存自身
 * 3. 暴露一个公共方法来获取实例（判断是否有实例，没有就new，有就直接返回）
 */
class SingleTon {
    private static $instance;
    
    private function __construct()
    {
    }
    
    public function getInstance() {
        if(!self::$instance instanceof self) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    
}