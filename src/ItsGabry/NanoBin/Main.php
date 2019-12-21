<?php

namespace ItsGabry\NanoBin;

use pocketmine\command\Command;
use muqsit\invmenu\InvMenu;
use muqsit\invmenu\InvMenuHandler;
use pocketmine\command\CommandSender;
use pocketmine\inventory\transaction\action\SlotChangeAction;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\network\mcpe\protocol\LevelEventPacket;
use pocketmine\Player;
use pocketmine\utils\TextFormat;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener {


    public function onEnable() {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->saveDefaultConfig();
        if (!InvMenuHandler::isRegistered()) {
            InvMenuHandler::register($this);
        }

    }

    public function onCommand(CommandSender $sender, Command $command, string $label, array $args): bool {
        switch (strtolower($command->getName())) {
            case "bin":
                if ($sender instanceof Player) {
                    $menu = InvMenu::create(InvMenu::TYPE_CHEST);
                    $menu->getInventory()->setContents([
                        0 => ItemFactory::get(Item::GLASS_PANE),
                        1 => ItemFactory::get(Item::GLASS_PANE),
                        2 => ItemFactory::get(Item::GLASS_PANE),
                        3 => ItemFactory::get(Item::GLASS_PANE),
                        4 => ItemFactory::get(Item::GLASS_PANE),
                        5 => ItemFactory::get(Item::GLASS_PANE),
                        6 => ItemFactory::get(Item::GLASS_PANE),
                        7 => ItemFactory::get(Item::GLASS_PANE),
                        8 => ItemFactory::get(Item::GLASS_PANE),
                        9 => ItemFactory::get(Item::GLASS_PANE),
                        17 => ItemFactory::get(Item::GLASS_PANE),
                        18 => ItemFactory::get(Item::GLASS_PANE),
                        19 => ItemFactory::get(Item::GLASS_PANE),
                        20 => ItemFactory::get(Item::GLASS_PANE),
                        21 => ItemFactory::get(Item::GLASS_PANE),
                        22 => ItemFactory::get(Item::GLASS_PANE),
                        23 => ItemFactory::get(Item::GLASS_PANE),
                        24 => ItemFactory::get(Item::GLASS_PANE),
                        25 => ItemFactory::get(Item::GLASS_PANE),
                        26 => ItemFactory::get(Item::GLASS_PANE),
                    ]);
                    $colore = $this->getConfig()->get("Color");
                    $nome = $this->getConfig()->get("Name");
                    $menu->send($sender, constant(TextFormat::class . "::" . strtoupper($colore)) . $nome . " "  . $sender->getName());
                    $sender->getLevel()->broadcastLevelEvent($sender, LevelEventPacket::EVENT_SOUND_ANVIL_USE, (int)100);
                    $menu->setListener(function(Player $player, Item $itemClicked, Item $itemClickedWith, SlotChangeAction $action) :bool {
                        if($action->getSlot() <= 9 or $action->getSlot() >= 17) {
                            return false;
                        }else{
                            return true;
                        }

                    });
                }
        }
        return true;
    }
}

