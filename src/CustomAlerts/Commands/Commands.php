<?php

/*
 * CustomAlerts (v1.6) by EvolSoft
 * Developer: EvolSoft (Flavius12)
 * Website: http://www.evolsoft.tk
 * Date: 05/06/2015 10:52 AM (UTC)
 * Copyright & License: (C) 2014-2015 EvolSoft
 * Licensed under MIT (https://github.com/EvolSoft/CustomAlerts/blob/master/LICENSE)
 */

namespace CustomAlerts\Commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;

use CustomAlerts\CustomAlerts;

class Commands extends PluginCommand {

	public function __construct(CustomAlerts $plugin){
        parent::__construct("customalerts", $plugin);
        $this->setDescription("The master CustomAlerts command");
        $this->setPermission("customalerts");
        $this->setAliases(["calerts"]);
    }
    
    public function onCommand(CommandSender $sender, Command $cmd, string $label, array $args) : bool {
    	$fcmd = strtolower($cmd->getName());
    	switch($fcmd){
    		case "customalerts":
    			if(isset($args[0])){
    				$args[0] = strtolower($args[0]);
    				if($args[0]=="help"){
    					if($sender->hasPermission("customalerts.help")){
    					    $sender->sendMessage($this->getPlugin()->translateColors("&", "&b-- &a 可供使用的指令 &b--"));
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&d/calerts help &b-&a 展示本插件帮助内容"));
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&d/calerts info &b-&a 展示本插件介绍内容"));
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&d/calerts reload &b-&a 重新加载本插件的配置文件"));
    						break;
    					}else{
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&c您没有足够的权限"));
    						break;
    					}
    				}elseif($args[0]=="info"){
    					if($sender->hasPermission("customalerts.info")){
    						$sender->sendMessage($this->getPlugin()->translateColors("&", CustomAlerts::PREFIX . "&aCustomAlerts &dv" . CustomAlerts::VERSION . " &adeveloped by&d " . CustomAlerts::PRODUCER));
    						$sender->sendMessage($this->getPlugin()->translateColors("&", CustomAlerts::PREFIX . "&aWebsite &d" . CustomAlerts::MAIN_WEBSITE));
    				        break;
    					}else{
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&c您没有足够的权限"));
    						break;
    					}
    				}elseif($args[0]=="reload"){
    					if($sender->hasPermission("customalerts.reload")){
    						$this->getPlugin()->reloadConfig();
    						//Reload Motd
    						if(!CustomAlerts::getAPI()->isMotdCustom()){
    							CustomAlerts::getAPI()->setMotdMessage($this->getPlugin()->getServer()->getMotd());
    						}
    						$sender->sendMessage($this->getPlugin()->translateColors("&", CustomAlerts::PREFIX . "&a成功重新读取本插件的配置文件."));
    				        break;
    					}else{
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&c您没有足够的权限"));
    						break;
    					}
    				}else{
    					if($sender->hasPermission("customalerts")){
    						$sender->sendMessage($this->getPlugin()->translateColors("&",  CustomAlerts::PREFIX . "&c子指令 &a" . $args[0] . " &c没有被找到,请使用 &a/calerts help &c来获取本插件所有可用的指令"));
    						break;
    					}else{
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&c您没有足够的权限"));
    						break;
    					}
    				}
    				}else{
    					if($sender->hasPermission("customalerts.help")){
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&b-- &a可供使用的指令 &b--"));
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&d/calerts help &b-&a 展示本插件帮助内容"));
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&d/calerts info &b-&a 展示本插件介绍内容"));
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&d/calerts reload &b-&a 重新加载本插件的配置文件"));
    						break;
    					}else{
    						$sender->sendMessage($this->getPlugin()->translateColors("&", "&c您没有足够的权限"));
    						break;
    					}
    				}
    			}
    			return true;
    	}
}
