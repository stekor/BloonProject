<?php
/*
 * BloonCrypto
 * Habbo R63 Post-Shuffle
 * Based on the work of Burak, edited by BloonCrypto Git Community. (skype: burak.karamahmut)
 * 
 * https://github.com/BurakDev/BloonProject/tree/BloonCrypto
 */

Class SocketSender extends Thread{
	// attribut
	private $packet = array();
	private $socketcount;
	private $allow;
	private $x = array();
	private $y = array();
	private $xa;
	private $ya;
	public function SetData($packetRequests, $socketRequests,$x,$y){
		$this->packet = $packetRequests;
		$this->socketcount = count($socketRequests);
		foreach($socketRequests as $key => $value){
			eval('$this->socket'.$key.' = $value;');
		}
		$this->allow = true;
		$this->x = $x;
		$this->y = $y;
	}
	public function stop(){
		$this->allow = false;
	}
	public function run(){
		$cpt = 0;
		foreach($this->packet as $packet){
			if($this->allow){
			$this->xa = $this->x[$cpt];
			$this->ya = $this->y[$cpt];
				usleep(500000);
				for($i = 0; $i < $this->socketcount; $i++):
					eval('$socket = $this->socket'.$i.';');
					socket_write($socket, $packet, strlen($packet));
				endfor;
			}else{
				break;
			}
			$cpt++;
		}
	}
}
?>