<?php
// Defines a class for counting barcodes scanned
// a class a is a re-usable "machine"
class barcodeCounter {
	protected $keyboard = false;
	protected $scannedBarcodes = [];

	public function mainLoop()
	{

		$this->help();

		if ($this->keyboard === false) {
			$this->openInput();
		}

		echo "Scan: ";

		while ( $keyboardInput = fgets($this->keyboard, 200) ) {
			
			// change it to upper case and remove any spaces or tabs from the beginning or end of the input
			$keyboardInput = trim(strtoupper($keyboardInput));


			if (strlen($keyboardInput) == 0) {
				echo "You didn't enter anything. Please scan: ";
				continue;
			} elseif ( strpos($keyboardInput, "!") === 0) {
				if ( $this->parseCommand($keyboardInput) ) {
					continue;
				}
			}

			if ( !isset($this->scannedBarcodes[$keyboardInput]) ) {
				$this->scannedBarcodes[$keyboardInput] = [
					"count" => 1,
					"times" => [ date("H:m:s") ]
				];
			} else {
				$this->scannedBarcodes[$keyboardInput]['count']++;
				$this->scannedBarcodes[$keyboardInput]['times'][] = date("H:m:s");
			}


			echo "Scan: ";			

		}

	}

	public function openInput()
	{
		$this->keyboard = fopen("php://stdin", "r");
	}

	public function help()
	{
		echo "This is a working tool for counting barcodes scanned.\n";

		echo "You can also type the following commands into it:\n".

			"\t!LIST\tThis will show you the list of barcodes and how many times you scanned each one.\n".
			"\t!TIMELINE\tShow the scanned barcodes as a timeline\n".
			"\tQUIT\tClose the program\n";
	}

	protected function parseCommand($command) {
		// remove the ! from the beginning
		$command = str_replace("!", "", $command);

		switch ($command) {
			case 'LIST':

				foreach ($this->scannedBarcodes as $barcode => $info) {
					echo $barcode. "\t". $info['count']. "\n";
				}

			break;

			case 'TIMELINE':

				$timeLine = [];

				foreach ($this->scannedBarcodes as $barcode => $info) {
					$times = $info['times'];

					foreach ($times as $time) {
						$timeLine[$time] = $barcode;
					}
				}

				ksort($timeLine);

				print_r($timeLine);				


			break;


			default:
				echo "Unrecognized command '$command'\n";

				$this->help();
				return false;
		}

		return true;

	}
}



if ( !defined("INCLUDER")) {
	$counter = new barcodeCounter();
	$counter->mainLoop();	
}


