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

namespace ClickedTran\BankGUI\language;

use pocketmine\utils\Config;

use ClickedTran\BankGUI\BankGUI;
use ClickedTran\BankGUI\language\data\{
  Vietnamese,
  English,
  Hindi
};

class LanguageManager {
  private static BankGUI $plugin;
  private static $lang = "?";
  private $version = null;
  private static $langData = null;
  
  public function __construct(BankGUI $plugin, string $lang){
    self::$plugin = $plugin;
    self::$lang = $lang;
    self::$langData = new Config(self::getPlugin()->getDataFolder() . "language/".self::$lang.".yml", Config::YAML, array());
    $data = self::getLangData()->getAll();
    if(!isset($data["reset"]) or $data["reset"] === true){
      $this->reload();
      $this->getPlugin()->getLogger()->info(LanguageManager::getTranslate(
        "plugininfo.reload_language", 
        [LanguageManager::getLanguage()]
      ));
    }
    
    if(isset($data["version"])){
      $this->version = $data["version"];
      if($this->getVersion() !== 1){
         $this->getPlugin()->getLogger()->info("Language ".self::getLanguage()." outdated, please update!");
      }
    }else{
      $this->reload();
      $this->getPlugin()->getLogger()->info("Language ".self::getLanguage()." is the latest version!");
    }
  }
  
  public function reload() : void{
    if($this->getLanguage() === "vi-VN"){
      foreach(Vietnamese::init() as $key => $value){
        LanguageManager::getLangData()->setNested($key, $value);
      }
    }
    
    if($this->getLanguage() === "en-US"){
      foreach(English::init() as $key => $value){
        LanguageManager::getLangData()->setNested($key, $value);
      }
    }

    if($this->getLanguage() === "hi-IN"){
      foreach(Hindi::init() as $key => $value){
        LanguageManager::getLangData()->setNested($key, $value);
      }
    }
    self::getLangData()->save();
  }
  
  public static function getTranslate(string|int $text, array $key = []) : string{
    $data = LanguageManager::getLangData();
    if(!$data->exists($text)){
      $message = $data->getNested($text);
      for($i = 0; $i < count($key); $i++){
        $message = str_replace('%'.($i + 1), $key[$i], $message);
      }
      return $message;
    }else{
      return LanguageManager::getTranslate(
        "plugininfo.message_not_found", 
        [$text, LanguageManager::getLanguage()]
      );
    }
  }
  
  public static function getLanguage() : string {
    return self::$lang;
  }
  
  public static function getPlugin() : BankGUI {
    return self::$plugin;
  }
  
  public static function getLangData() : Config {
    return self::$langData;
  }
  
  public function getVersion() : int {
    return $this->version;
  }
}
