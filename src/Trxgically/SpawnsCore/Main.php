<?php

namespace Trxgically\SpawnsCore;

use pocketmine\{Server,Player};
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat as TF;
use pocketmine\event\Listener;
use pocketmine\command\{Command,CommandSender,ConsoleCommandSender};
use pocketmine\event\player\PlayerInteractEvent;
use pocketmine\math\Vector3;
use pocketmine\level\Level;
use pocketmine\level\Position;
use pocketmine\utils\Config;

class Main extends PluginBase implements Listener {
    private $config;
    private $playerInteractions = false;
    private $setHub = false;
    private $setSpawn = false;
    private $setLobby = false;
    
    
    
    public function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this,$this);
        $this->saveDefaultConfig();
    	$this->config = new Config($this->getDataFolder()."config.yml", Config::YAML);
    	$this->config->getAll();
	}

	public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool {
		$color1 = $this->config->getNested("theme.color1");
		$color2 = $this->config->getNested("theme.color2");
		$color3 = $this->config->getNested("theme.color3");
		$color4 = $this->config->getNested("theme.color4");
		$color5 = $this->config->getNested("theme.color5");
		
		$px = $this->config->get("prefix");
		switch ($command->getName()) {
			case 'sc':
				if ($sender->hasPermission("sc.cmd")){
					if (count($args) === 0) {
						$sender->sendMessage($color1 . TF::BOLD . "SpawnsCore Commands :" . TF::RESET . "\n" . "\n" . $color2 . "/sc sethub" . $color3 . " - Set the player spawnpoint of /hub" . "\n" . $color2 . "/sc setspawn" . $color3 . " - Set the player spawnpoint of /spawn" . "\n" . $color2 . "/sc setlobby" . $color3 . " - Set the player spawnpoint of /lobby" . "\n" . "\n" . $color2 . "/sc resethub" . $color3 . " - Reset the player spawnpoint of /hub" . "\n" . $color2 . "/sc resetspawn" . $color3 . " - Reset the player spawnpoint of /spawn" . "\n" . $color2 . "/sc resetlobby" . $color3 . " - Reset the player spawnpoint of /lobby" . "\n" . "\n" . $color2 . "/hub" . $color3 . " - Teleport to the /hub player spawnpoint" . "\n" . $color2 . "/spawn" . $color3 . " - Teleport to the /spawn player spawnpoint" . "\n" . $color2 . "/lobby" . $color3 . " - Teleport to the /lobby player spawnpoint");
					} else {
						switch ($args[0]){
							case "sethub":
								if ($this->config->getNested("set.prefix", true){
$this->setHub = true;
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Please click or tap where you would like to set the spawnpoint");
} elseif ($this->config->getNested("set.prefix", false){
this->setHub = true;
$sender->sendMessage("Please click or tap where you would like to set the spawnpoint");
}

								break;

							case "setspawn":
								if ($this->config->getNested("set.prefix", true){
$this->setSpawn = true;
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Please click or tap where you would like to set the spawnpoint");
} elseif ($this->config->getNested("set.prefix", false){
this->setSpawn = true;
$sender->sendMessage("Please click or tap where you would like to set the spawnpoint");
}

								break;

							case "setlobby":
								if ($this->config->getNested("set.prefix", true){
$this->setLobby = true;
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Please click or tap where you would like to set the spawnpoint");
} elseif ($this->config->getNested("set.prefix", false){
this->setLobby = true;
$sender->sendMessage("Please click or tap where you would like to set the spawnpoint");
}
								break;

							case "resethub":
								if ($this->config->getNested("set.prefix", true){
$this->config->setNested("set.hub", false);
$this->config->save();
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Spawnpoint has successfully been reset!");
} elseif ($this->config->getNested("set.prefix", false){
$this->config->setNested("set.hub", false);
$this->config->save();
$sender->sendMessage("Spawnpoint has successfully been reset!");
}
								break;
								
							case "resetspawn":
								if ($this->config->getNested("set.prefix", true){
$this->config->setNested("set.spawn", false);
$this->config->save();
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Spawnpoint has successfully been reset!");
} elseif ($this->config->getNested("set.prefix", false){
$this->config->setNested("set.spawn", false);
$this->config->save();
$sender->sendMessage("Spawnpoint has successfully been reset!");
}
								break;

							case "resetlobby":
								if ($this->config->getNested("set.prefix", true){
$this->config->setNested("set.lobby", false);
$this->config->save();
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Spawnpoint has successfully been reset!");
} elseif ($this->config->getNested("set.prefix", false){
$this->config->setNested("set.lobby", false);
$this->config->save();
$sender->sendMessage("Spawnpoint has successfully been reset!");
}
	                                                        break;
						}
					}
				} else {
					$sender->sendMessage($color1 . TF::BOLD . "SpawnsCore Commands :" . TF::RESET . "\n" . "\n" . $color2 . "hub" . $color3 . " - teleport to the /hub player spawnpoint" . "\n" . $color2 . "spawn" . $color3 . " - teleport to the /spawn player spawnpoint" . "\n" . $color2 . "lobby" . $color3 . " - teleport to the /lobby player spawnpoint");
				}
				break;
			
			case "hub":
				if ($this->config->getNested("set.prefix", true){
if ($this->config->getNested("set.hub") === false) {
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " There is no current hub set!");
} elseif ($this->config->getNested("set.hub") === true) {
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Teleporting to hub...");
$x = $this->config->getNested("hspawn-point.x");
$y = $this->config->getNested("hspawn-point.y");
$z = $this->config->getNested("hspawn-point.z");
$position = new Position($x, $y, $z);
$sender->teleport($position);
}
} elseif ($this->config->getNested("set.prefix", false){
if ($this->config->getNested("set.hub") === false) {
$sender->sendMessage("There is no current hub set!");
} elseif ($this->config->getNested("set.hub") === true) {
$sender->sendMessage("Teleporting to hub...");
$x = $this->config->getNested("hspawn-point.x");
$y = $this->config->getNested("hspawn-point.y");
$z = $this->config->getNested("hspawn-point.z");
$position = new Position($x, $y, $z);
$sender->teleport($position);
				}
}


				break;

			case "spawn":
				if ($this->config->getNested("set.prefix", true){
if ($this->config->getNested("set.spawn") === false) {
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " There is no current spawn set!");
} elseif ($this->config->getNested("set.spawn") === true) {
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Teleporting to spawn...");
$x = $this->config->getNested("sspawn-point.x");
$y = $this->config->getNested("sspawn-point.y");
$z = $this->config->getNested("sspawn-point.z");
$position = new Position($x, $y, $z);
$sender->teleport($position);
}
} elseif ($this->config->getNested("set.prefix", false){
if ($this->config->getNested("set.spawn") === false) {
$sender->sendMessage("There is no current spawn set!");
} elseif ($this->config->getNested("set.spawn") === true) {
$sender->sendMessage("Teleporting to spawn...");
$x = $this->config->getNested("sspawn-point.x");
$y = $this->config->getNested("sspawn-point.y");
$z = $this->config->getNested("sspawn-point.z");
$position = new Position($x, $y, $z);
$sender->teleport($position);
				}
}
				break;

			case "lobby":
				if ($this->config->getNested("set.prefix", true){
                                if ($this->config->getNested("set.lobby") === false) {
               $sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " There is no current lobby set!");
                               } elseif ($this->config->getNested("set.lobby") === true) {
$sender->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " Teleporting to lobby...");
$x = $this->config->getNested("lspawn-point.x");
$y = $this->config->getNested("lspawn-point.y");
$z = $this->config->getNested("lspawn-point.z");
$position = new Position($x, $y, $z);
$sender->teleport($position);
                                }
                                } elseif ($this->config->getNested("set.prefix", false){
if ($this->config->getNested("set.lobby") === false) {
$sender->sendMessage("There is no current lobby set!");
} elseif ($this->config->getNested("set.lobby") === true) {
$sender->sendMessage("Teleporting to lobby...");
$x = $this->config->getNested("lspawn-point.x");
$y = $this->config->getNested("lspawn-point.y");
$z = $this->config->getNested("lspawn-point.z");
$position = new Position($x, $y, $z);
$sender->teleport($position);
				}
}


				break;
		}
		return true;
	}
	
   	public function onInteract(PlayerInteractEvent $event) {
		$color1 = $this->config->getNested("theme.color1");
		$color2 = $this->config->getNested("theme.color2");
		$color3 = $this->config->getNested("theme.color3");
		$color4 = $this->config->getNested("theme.color4");
		$color5 = $this->config->getNested("theme.color5");
		
		$px = $this->config->get("prefix");
    	if ($this->setHub === true) {
		if ($this->config->getNested("set.prefix", true){
                        $player = $event->getPlayer();
			$block = $event->getBlock();
			$x = $block->getX();
			$y = $block->getY();
			$z = $block->getZ();
			$hubx = $this->config->setNested("hspawn-point.x", $x);
			$huby = $this->config->setNested("hspawn-point.y", $y);
			$hubz = $this->config->setNested("hspawn-point.z", $z);
			$this->config->save();
			$hubxd = $this->config->getNested("hspawn-point.x");
			$hubyd = $this->config->getNested("hspawn-point.y");
			$hubzd = $this->config->getNested("hspawn-point.z");
			$player->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " You have successfully set the spawn point!");
			$this->setHub = false;
			$this->config->setNested("set.hub", true);
			$this->config->save();
                } elseif ($this->config->getNested("set.prefix", false){
                        $player = $event->getPlayer();
			$block = $event->getBlock();
			$x = $block->getX();
			$y = $block->getY();
			$z = $block->getZ();
			$hubx = $this->config->setNested("hspawn-point.x", $x);
			$huby = $this->config->setNested("hspawn-point.y", $y);
			$hubz = $this->config->setNested("hspawn-point.z", $z);
			$this->config->save();
			$hubxd = $this->config->getNested("hspawn-point.x");
			$hubyd = $this->config->getNested("hspawn-point.y");
			$hubzd = $this->config->getNested("hspawn-point.z");
			$player->sendMessage("You have successfully set the spawn point!");
			$this->setHub = false;
			$this->config->setNested("set.hub", true);
			$this->config->save();
                 }
			
     	} elseif ($this->setSpawn === true) {
	    if ($this->config->getNested("set.prefix", true){
                        $player = $event->getPlayer();
			$block = $event->getBlock();
			$x = $block->getX();
			$y = $block->getY();
			$z = $block->getZ();
			$spawnx = $this->config->setNested("sspawn-point.x", $x);
			$spawny = $this->config->setNested("sspawn-point.y", $y);
			$spawnz = $this->config->setNested("sspawn-point.z", $z);
			$this->config->save();
			$spawnxd = $this->config->getNested("sspawn-point.x");
			$spawnyd = $this->config->getNested("sspawn-point.y");
			$spawnzd = $this->config->getNested("sspawn-point.z");
			$player->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " You have successfully set the spawn point!");
			$this->setSpawn = false;    $this->config->setNested("set.spawn", true);
			$this->config->save();
        } elseif ($this->config->getNested("set.prefix", false){
                        $player = $event->getPlayer();
			$block = $event->getBlock();
			$x = $block->getX();
			$y = $block->getY();
			$z = $block->getZ();
			$spawnx = $this->config->setNested("sspawn-point.x", $x);
			$spawny = $this->config->setNested("sspawn-point.y", $y);
			$spawnz = $this->config->setNested("sspawn-point.z", $z);
			$this->config->save();
			$spawnxd = $this->config->getNested("sspawn-point.x");
			$spawnyd = $this->config->getNested("sspawn-point.y");
			$spawnzd = $this->config->getNested("sspawn-point.z");
			$player->sendMessage("You have successfully set the spawn point!");
			$this->setSpawn = false;    $this->config->setNested("set.spawn", true);
			$this->config->save();
                }
			
     	} elseif ($this->setLobby === true) {
		if ($this->config->getNested("set.prefix", true){
			$player = $event->getPlayer();
			$block = $event->getBlock();
			$x = $block->getX();
			$y = $block->getY();
			$z = $block->getZ();
			$lobbyx = $this->config->setNested("lspawn-point.x", $x);
			$lobbyy = $this->config->setNested("lspawn-point.y", $y);
			$lobbyz = $this->config->setNested("lspawn-point.z", $z);
			$this->config->save();
			$lobbyxd = $this->config->getNested("lspawn-point.x");
			$lobbyyd = $this->config->getNested("lspawn-point.y");
			$lobbyzd = $this->config->getNested("lspawn-point.z");
			$player->sendMessage($color5 . "[" . $color2 . $px . $color5 . "]" . TF::RESET . " You have successfully set the spawn point!");
			$this->setLobby = false;
			$this->config->setNested("set.lobby", true);
			$this->config->save();
		} elseif ($this->config->getNested("set.prefix", false){
			$player = $event->getPlayer();
			$block = $event->getBlock();
			$x = $block->getX();
			$y = $block->getY();
			$z = $block->getZ();
			$lobbyx = $this->config->setNested("lspawn-point.x", $x);
			$lobbyy = $this->config->setNested("lspawn-point.y", $y);
			$lobbyz = $this->config->setNested("lspawn-point.z", $z);
			$this->config->save();
			$lobbyxd = $this->config->getNested("lspawn-point.x");
			$lobbyyd = $this->config->getNested("lspawn-point.y");
			$lobbyzd = $this->config->getNested("lspawn-point.z");
			$player->sendMessage("You have successfully set the spawn point!");
			$this->setLobby = false;
			$this->config->setNested("set.lobby", true);
			$this->config->save();
		}
     	}
    }
}
