<?PHP
// Single letter options prefixed with a single dash
// cmd -a
// cmd -ab

// Single letter options prefixed with a single dash with value
// cmd -a foo (a will be set to foo.)
// cmd -a foo -b (a will be set to foo.)
// cmd -ab foo (a and b will be set to true and foo will be ignored)

// Double-dashed options
// cmd --value
// cmd --value foo (value is set to foo)
// cmd --value=foo (value is set to foo)


// Help command
// cmd --help
// cmd --h
// cmd --?
// cmd -h
// cmd -?

class Args {
	public $flags;
	public $args;
	public $script;

	public function __construct() {
		$this->flags = array();
		$this->args  = array();

		$argv = $GLOBALS['argv'];
		$this->script = array_shift($argv);

		for($i = 0; $i < count($argv); $i++) {
			$str = $argv[$i];

			// --foo
			if(strlen($str) > 2 && substr($str, 0, 2) == '--') {
				$str = substr($str, 2);
				$parts = explode('=', $str);
				$this->flags[$parts[0]] = true;

				// Does not have an =, so choose the next arg as its value
				if(count($parts) == 1 && isset($argv[$i + 1]) && preg_match('/^--?.+/', $argv[$i + 1]) == 0) {
					$this->flags[$parts[0]] = $argv[$i + 1];
				} elseif(count($parts) == 2) { // Has a =, so pick the second piece
					$this->flags[$parts[0]] = $parts[1];
				}
			} elseif(strlen($str) == 2 && $str[0] == '-') { // -a
				$this->flags[$str[1]] = true;
				if(isset($argv[$i + 1]) && preg_match('/^--?.+/', $argv[$i + 1]) == 0) {
					$this->flags[$str[1]] = $argv[$i + 1];
				}
			} elseif(strlen($str) > 1 && $str[0] == '-') { // -abcdef
				for($j = 1; $j < strlen($str); $j++) {
					$this->flags[$str[$j]] = true;
				}
			}
		}

		for($i = count($argv) - 1; $i >= 0; $i--) {
			if(preg_match('/^--?.+/', $argv[$i]) == 0) {
				$this->args[] = $argv[$i];
			} else {
				break;
			}
		}
		$this->args = array_reverse($this->args);
	}

	public function checkHelp($usage) {
		if($this->hasFlag('help') || $this->flag('h') || $this->flag('?') ) {
			echo $usage;
			die("\n");
		}
	}

	public function flag($name, $default='') {
		return isset($this->flags[$name]) ? $this->flags[$name] : $default;
	}

	public function hasFlag($name) {
		return isset($this->flags[$name]);
	}
}


