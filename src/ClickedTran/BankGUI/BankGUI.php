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
*                                                      Copyright (C) 2024-2025 ClickedTran
*/

namespace ClickedTran\BankGUI;
use pocketmine\Server;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;
use pocketmine\data\bedrock\EnchantmentIdMap;
use pocketmine\item\enchantment\Enchantment;
use pocketmine\item\enchantment\ItemFlags;

use DaPigGuy\libPiggyEconomy\libPiggyEconomy;
use muqsit\invmenu\InvMenuHandler;

use ClickedTran\BankGUI\task\TaskManager;
use ClickedTran\BankGUI\command\BankGUICommand;
use ClickedTran\BankGUI\manager\BankManager;
use ClickedTran\BankGUI\language\LanguageManager;

class BankGUI extends PluginBase 
{
  public $addCustom = [];
  public $takeCustom = [];
  public $bankNote = [];
  public $transferToPlayer = [];
  
  public const FAKE_ENCHANTMENT = -1;
  public const PREFIX = " §9[ §4BankGUI §9] ";
  
  public $bankManager;
  public $economyData;
  public $language;
  public array $language_supported =
  [
    "vi-VN",
    "en-US",
    "hi-IN"
  ];
  
 /**-----------@var BankGUI---------*/
  public static $instance;
  public static function getInstance() : BankGUI
  {
    return self::$instance;
  }
  /**--------------------------------*/
  
  public function onEnable() : void
  {
    /**@register FAKE ENCHANTMENT*/
    EnchantmentIdMap::getInstance()->register(self::FAKE_ENCHANTMENT, new Enchantment("", -1, 1, ItemFlags::ALL, ItemFlags::NONE));
    
    /**@register PLUGIN COMMAND*/
    $this->getServer()->getCommandMap()->register("BankGUI", new BankGUICommand($this));
    
    /**@register PLUGIN EVENTLISTENER*/
    $this->getServer()->getPluginManager()->registerEvents(new EventListener($this), $this);
    
    /**@register Plugin TaskManager*/
    $this->getScheduler()->scheduleRepeatingTask(new TaskManager($this), 1100);
    
    /**@register libPiggyEconomy */
    libPiggyEconomy::init();
    $this->economyData = libPiggyEconomy::getProvider($this->getConfig()->get("economy-type"));
    
    /**@register multip language*/
    @mkdir($this->getDataFolder () . "language/");
    if(!in_array($this->getConfig()->getNested("language"), $this->language_supported)){
      $this->getLogger()->error("§cLanguage §b".$this->getConfig()->getNested("language")."§c not found in data. Please try:\n§9[§d".implode(", ", $this->language_supported)."§9]"
        );
      $this->getServer()->getPluginManager()->disablePlugin($this);
      return;
    }else{
      $this->language = new LanguageManager($this, $this->getConfig()->getNested("language"));
    }
    $this->saveDefaultConfig();
    
    self::$instance = $this;
    
    /**@register InvMenu*/
    if(!InvMenuHandler::isRegistered()) InvMenuHandler::register($this);
  }
  
  public function getBankManager(Player|string $player) : BankManager
  {
    return new BankManager($player);
  }
  
  public function getEconomyData()
  {
    return $this->economyData;
  }
  /**
  public function onDisable() : void
  {
    $this->getBankManager()->saveAll();
  }*/
}
