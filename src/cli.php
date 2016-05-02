#!/usr/bin/php5 -q
<?php
include_once "lib/args.php";
include_once "lib/logger.php";
include_once "ImageToBricks.class.php";

class Cli {

	var $usages = array(
			" *** Image to Bricks ***",
			"",
			"Utilisation : ./index.php --source=/path/to/image --size=10 --output=/output/path/ --outputname=output --palette=default",
			"",
			"Arguments :",
			"  --source [path]     		Chemin d'accès à l'image",
			"  --size 				  			Taille des cases",
			"  --palette			  			Type de palette : default, full",
			"  --output [path]  			Chemin de sortie",
			"  --outputname [name]  	Nom du fichier en sortie"
	);

	private $source;

	private $size;

	private $output;

	private $outputname;

	var $color_map = array();

	var $_palette = array();

	function __construct () {
		$args = new Args();
		$args->checkHelp(implode("\n", $this->usages));

		if (! $args->hasFlag('source')) {
			Logger::kill("Argument --source required");
		}
		$this->source = $args->flag('source');
		$this->size = $args->flag('size', 48);
		$this->palette = $args->flag('palette', "default");
		$this->output = $args->flag('output', "/tmp/");
		$this->outputname = $args->flag('outputname', "output");
	}

	function run () {
		Logger::info("******************************************************");
		if (! file_exists($this->source)) Logger::kill(
				'File "' . $this->source . '" not found');

		Logger::info("Pixelating...");
		$builder = new ImageToBricks($this->palette);
		$img = $builder->pixelate($this->source, $this->size);

		// Saving
		$output = $this->output . $this->outputname . '.png';
		Logger::info("Saving the image to : " . $output);
		imagepng($img, $output);
		imagedestroy($img);

		Logger::info("******************************************************");
	}
}

$c = new Cli();
$c->run();