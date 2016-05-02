<?PHP
include_once realpath(dirname(__FILE__)) . "/vars.php";

class Logger {

	const COLOR_RESET = Vars::NORMAL;
	const COLOR_TRACE = Vars::FGYELLOW;
	const COLOR_ERROR = Vars::FGRED;
	const COLOR_OK = Vars::FGGREEN;
	const COLOR_PROGRESS = Vars::FGYELLOW;
	const COLOR_INFO = Vars::FGMAGENTA;
	const COLOR_DEBUG = Vars::FGWHITE;

	public static $_text;

	static function display($s, $showTime, $nl = true, $lr = false, $color = Logger::COLOR_OK) {
		if($nl) {
			Logger::clear();
		}
		$s = ($showTime ? "[".date("H:i:s")."] " : '') . $s;
		echo $color . ($lr ? "\r" : "") . $s . Logger::COLOR_RESET . ($nl ? "\n" : "");
	}

	static function trace($s) {
		Logger::display($s, true, true, false, Logger::COLOR_TRACE);
	}

	static function debug($s) {
		Logger::display($s, true, true, false, Logger::COLOR_DEBUG);
	}

	static function log($s) {
		Logger::display($s, true, true, false, Logger::COLOR_OK);
	}

	static function error($s) {
		Logger::display($s, true, true, false, Logger::COLOR_ERROR);
	}

	static function kill($s) {
		Logger::error($s);
		die();
	}

	static function info($s) {
		Logger::display($s, true, true, false, Logger::COLOR_INFO);
	}

	static function clear() {
		if(Logger::$_text) {
			Logger::progress(null);
		}
	}

	static function progress($s) {
		if(Logger::$_text) {
			Logger::display(str_repeat(" ", strlen(Logger::$_text)), false, false, true, Logger::COLOR_OK);
		}
		if(null == $s) {
			Logger::$_text = null;
			Logger::display("", false, false, true, Logger::COLOR_OK);
		} else {
			Logger::$_text = "[".date("H:i:s")."] $s";
			Logger::display(Logger::$_text, false, false, true, Logger::COLOR_PROGRESS);
		}
	}
}
