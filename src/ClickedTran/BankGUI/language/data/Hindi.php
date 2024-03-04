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

namespace ClickedTran\BankGUI\language\data;

class Hindi {
  public static function init() : array {
    return [
      "reset" => false,
      "version" => 1,
      "plugininfo.use_ingame" => "§aकृपया इन-गेम में कमांड का उपयोग करें!",
      "plugininfo.reload_language" => "§aभाषा §b%1 §aसफलतापूर्वक पुनरारंभ हो गई है!",
      "plugininfo.message_not_found" => "§aसंदेश §b%1 §bभाषा §d%2 के डेटा में मौजूद नहीं है",
      
      "playerinfo.money" => "§aआपके पैसे: §b%1",
      "playerinfo.money_in_bank" => "§aबैंक में आपके पैसे: §b%1",
      "playerinfo.not_exists" => "§cखिलाड़ी डेटा §b%1 §cमौजूद नहीं है!",
      "playerinfo.transfer.fail" => "§cआपके पास ट्रांसफर करने के लिए पर्याप्त पैसा नहीं है §b%1 §cto §9%2 §c!",
      "playerinfo.transfer.successfully" => "§aआपने राशि §b%1 §9%2 के बैंक में ट्रांसफर कर दी है",
      "playerinfo.transfer.player_claimed.successfully" => "§aआपने राशि §b%1 §9%2 से अपने खाते में प्राप्त की है",
      "playerinfo.transfer.transaction" => "§aबैंक में राशि §b%1 §9%2 को ट्रांसफर करें",
      "playerinfo.transfer.player_claimed.transaction" => "§aखिलाड़ी §b%1 §aसे प्राप्त करें §9%2",
      
      "bank.create" => "§aनया खाता सफलतापूर्वक बनाएं!",
      "bank.error" => "§cअवैध कार्रवाई, कृपया पुनः प्रयास करें!",
      "bank.cancel" => "§aआपने सफलतापूर्वक कार्रवाई को रद्द कर दिया है!",
      
      "bank.claimed_interest" => "§aमिली राशि §b%1 §aको खाते में प्राप्त करें",
      "bank.player_claimed_interest" => "§aआपने ब्याज से अपने बैंक खाते में राशि §b%1 §aप्राप्त की है!",
      
      "bank.deposit.half" => "§aआर्धिक जमा करें",
      "bank.deposit.custom" => "§aकस्टम जमा करें",
      "bank.deposit.custom_message" => "§aसभी को भेजने के लिए §bसभी §a/ ऑपरेशन को रद्द करने के लिए §bकैंसिल §aदर्ज करें",
      "bank.deposit.all" => "§aसभी को जमा करें",
      "bank.deposit.message" => "§aआपने बैंक में §b%1 §aजमा कर दी है!",
      "bank.deposit.transaction" => "§aबैंक में जमा करें §b%1",
      "bank.deposit.fail" => "§cआपके पास जमा करने के लिए पर्याप्त राशि नहीं है §b%1 §cबैंक में!",
      
      "bank.withdraw.half" => "§aआर्धिक निकासी करें",
      "bank.withdraw.custom" => "§aकस्टम निकासी करें",
      "bank.withdraw.custom_message" => "§aसभी को निकालने के लिए §bसभी §a/ ऑपरेशन को रद्द करने के लिए §bकैंसिल §aदर्ज करें",
      "bank.withdraw.all" => "§aसभी को निकालें",
      "bank.withdraw.message" => "§aआपने बैंक से §b%1 §aनिकाला है!",
      "bank.withdraw.transaction" => "§aबैंक से §b%1 §aनिकालें!",
      "bank.withdraw.fail" => "§cआपके पास बैंक से निकालने के लिए पर्याप्त राशि नहीं है §b%1 §c!",
      
      "bank.transfer.custom_message" => "§aसभी को ट्रांसफर करने के लिए §bसभी §a/ ऑपरेशन को रद्द करने के लिए §bकैंसिल §aदर्ज करें",
      
      "bank.create_bank_note" => "§aपूर्ण राशि के लिए एक चेक बनाने के लिए §bसभी §aदर्ज करें/ §bकैंसिल §aऑपरेशन को रद्द करने के लिए §bकैंसिल §aदर्ज करें",
      
      "banknote.create.name" => "§l§bबैंक नोट",
      "banknote.create.lore" => "§aबैंक नोट की मूल्यवानता है: §b%1\n§aद्वारा बनाई गई: §9%2\n \n§9( §bयूज़ करने के लिए राइट क्लिक करें §9)",
      "banknote.create.transaction" => "§aमूल्य §b%1 §के साथ एक बैंक नोट बनाया गया है",
      "banknote.create.fail" => "§cआपके खाते में पर्याप्त राशि नहीं है §b%1 §cएक बैंक नोट बनाने के लिए",
      "banknote.create.successfully" => "§aआपने सफलतापूर्वक एक बैंक नोट बनाया है जिसकी मूल्यवानता है §b%1",
      "banknote.use" => "§aआपने बैंक नोट से §b%1 §aप्राप्त किया है",
      

      "menu.title.bank_menu" => "§bबैंकजी §f| §cमेनू",
      
      "menu.title.bank_transaction_history" => "§bट्रांजैक्शन इतिहास",
      
      "menu.title.bank_transfer" => "§bबैंकजी §f| §cट्रांसफर",
      
      "menu.button.1" => "§aट्रांसफर",
      "menu.button.2" => "§aबैंक नोट बनाएं",
      "menu.button.3" => "§aट्रांजैक्शन इतिहास",
      
      "menu.button.exit" => "§cनिकासी",
      "menu.button.back" => "§cहोम पर वापस जाएं",
      
      "menu.button.page.next" => "§bअगला पृष्ठ",
      "menu.button.page.previous" => "§bपिछला पृष्ठ",
      "menu.button.page.total" => "§b%1 §f/ §9%2"
    ];
  }
}
