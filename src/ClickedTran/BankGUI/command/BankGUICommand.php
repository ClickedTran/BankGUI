<?php
declare(strict_types=1);
/**
*░█████╗░██╗░░░░░██╗░█████╗░██╗░░██╗███████╗██████╗░████████╗██████╗░░█████╗░███╗░░██╗
*██╔══██╗██║░░░░░██║██╔══██╗██║░██╔╝██╔════╝██╔══██╗╚══██╔══╝██╔══██╗██╔══██╗████╗░██║
*██║░░╚═╝██║░░░░░██║██║░░╚═╝█████═╝░█████╗░░██║░░██║░░░██║░░░██████╔╝███████║██╔██╗██║
*██║░░██╗██║░░░░░██║██║░░██╗██╔═██╗░██╔══╝░░██║░░██║░░░██║░░░██╔══██╗██╔══██║██║╚████║
*╚█████╔╝███████╗██║╚█████╔╝██║░╚██╗███████╗██████╔╝░░░██║░░░██║░░██║██║░░██║██║░╚███║
*░╚════╝░╚══════╝╚═╝░╚════╝░╚═╝░░╚═╝╚══════╝╚═════╝░░░░╚═╝░░░╚═╝░░╚═╝╚═╝░░╚═╝╚═╝░░╚══╝
*
*                                                              Copyright (C) 2023-2024 ClickedTran
*/
namespace ClickedTran\BankGUI\command;

use pocketmine\command\{Command, CommandSender};
use pocketmine\player\Player;
use pocketmine\Server;
use pocketmine\plugin\PluginOwned;

use ClickedTran\BankGUI\BankGUI;
use ClickedTran\BankGUI\gui\GUIManager;
use ClickedTran\BankGUI\language\LanguageManager;

class BankGUICommand extends Command implements PluginOwned{
  
  public BankGUI $plugin;
  public $prefix = "";
  public function __construct(BankGUI $plugin){
    $this->plugin = $plugin;
    $this->prefix = BankGUI::PREFIX;
    parent::__construct("bankgui", "§bOpen Menu BankGUI", null, ["bank"]);
    $this->setPermission("bankgui.command");
  }
  
  public function execute(CommandSender $sender, String $label, Array $args){
    if(!$sender instanceof Player){
       $this->plugin->getLogger()->error($this->prefix. LanguageManager::getTranslate(
         'plugininfo.use_ingame'
         ));
       return;
    }
     $gui = new GUIManager();
     $gui->bankMenu($sender);
  }
  
  public function getOwningPlugin() : BankGUI{
    return $this->plugin;
  }
}
