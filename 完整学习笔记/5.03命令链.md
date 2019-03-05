<?php
/**
 * Created by PhpStorm.
 * User: haobin
 * Date: 2017/10/9
 * Time: 16:41
 */

/**
 * 命令链模式以松散耦合主题为基础，发送消息、命令和请求，或通过一组处理程序发送任意内容。
 * 每个处理程序都会自行判断自己能否处理请求。如果可以，该请求被处理，进程停止。
 * 我们可以为系统添加或移除处理程序，而不影响其他处理程序。
 */

interface ICommand {
    function onCommand($name, $args);
}

class CommandChain {
    private $_commands = [];
    
    public function addCommand($cmd) {
        $this->_commands = $cmd;
    }
    
    public function runCommand($name, $args) {
        foreach($this->_commands as $command) {
            if($command->onCommand($name, $args)) {
                return;
            }
        }
    }
}

class UserCommand implements ICommand {
    public function onCommand($name, $args)
    {
        if($name != 'addUser') 
            return false;
        echo "user handind! \n";
        return true;
    }
}

class MailCommond implements ICommand {
    public function onCommand($name, $args)
    {
        if($name != 'addMail')
            return false;
        echo "mail handind! \n";
        return true;
    }
}

$chain = new CommandChain();
$chain->addCommand(new UserCommand());
$chain->addCommand(new MailCommond());
$chain->runCommand('addUser', null);
$chain->runCommand('addMail', null);
