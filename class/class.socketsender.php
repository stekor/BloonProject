<?php/* * BloonCrypto * Habbo R63 Post-Shuffle * Based on the work of Burak, edited by BloonCrypto Git Community. (skype: burak.karamahmut) *  * https://github.com/BurakDev/BloonProject/tree/BloonCrypto * Thanks to Ligams for this unZip SCRIPT. */Class SocketSender extends Thread{	// attribut	private $packet = array();	private $socketcount;	public function SetData($packetRequests, $socketRequests)	{		$this->packet = $packetRequests;		$this->socketcount = count($socketRequests);		foreach($socketRequests as $key => $value){			eval('$this->socket'.$key.' = $value;');		}	}		public function run(){		foreach($this->packet as $packet){			for($i = 0; $i < $this->socketcount; $i++):				eval('$socket = $this->socket'.$i.';');				socket_write($socket, $packet, strlen($packet));			endfor;			usleep(500000);		}	}}?>