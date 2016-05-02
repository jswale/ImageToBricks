<?PHP

class Vars {

	/**
	 * COLORS
	 */
	const FGBLACK = "\033[30m";
	// foreground to black
	const FGRED = "\033[31m";
	// foreground to red
	const FGGREEN = "\033[32m";
	// foreground to green
	const FGYELLOW = "\033[33m";
	// foreground to yellow
	const FGBLUE = "\033[34m";
	// foreground to blue
	const FGMAGENTA = "\033[35m";
	// foreground to magenta
	const FGCYAN = "\033[36m";
	// foreground to cyan
	const FGWHITE = "\033[37m";
	// foreground to white
	const FGBLACK2 = "\033[90m";
	// foreground to black
	const FGRED2 = "\033[91m";
	// foreground to red
	const FGGREEN2 = "\033[92m";
	// foreground to green
	const FGBLUE2 = "\033[94m";
	// foreground to blue
	const FGMAGENTA2 = "\033[95m";
	// foreground to magenta
	const FGCYAN2 = "\033[96m";
	// foreground to cyan
	const FGWHITE2 = "\033[97m";
	// foreground to white
	const BGBLACK = "\033[40m";
	// background to black
	const BGRED = "\033[41m";
	// background to red
	const BGGREEN = "\033[42m";
	// background to green
	const BGYELLOW = "\033[43m";
	// background to yellow
	const BGBLUE = "\033[44m";
	// background to blue
	const BGCYAN = "\033[45m";
	// background to cyan
	const BGWHITE = "\033[47m";
	// background to white
	const BGBLACK2 = "\033[100m";
	// background to black
	const BGRED2 = "\033[101m";
	// background to red
	const BGGREEN2 = "\033[102m";
	// background to green
	const BGYELLOW2 = "\033[103m";
	// background to yellow
	const BGBLUE2 = "\033[104m";
	// background to blue
	const BGCYAN2 = "\033[105m";
	// background to cyan
	const BGWHITE2 = "\033[107m";
	// background to white
	const NORMAL = "\033[0m";
	// terminal to normal
	const BOLD = "\033[1m";
	// bold
	const UNDERLINE = "\033[4m";
	// terminal to underline
	const BLINK = "\033[5m";
	// terminal to blink
	const REVERSE = "\033[7m";
	// terminal to reverse video
	const STROKE = "\033[9m";
	// stroke
	const NOUNDERLINE = "\033[24m"; // terminal to cancel underline
}

class Bricks {

	// Color ID: 1 | Official LEGO Name: White
	const COLOR1 = "#ffffff";
	// Color ID:5 | Official LEGO Name: Tan
	const COLOR5 = "#d9bb7b";
	// Color ID:18 | Official LEGO Name: Flesh
	const COLOR18 = "#d67240";
	// Color ID:21 | Official LEGO Name: Red
	const COLOR21 = "#de000d";
	// Color ID:23 | Official LEGO Name: Blue
	const COLOR23 = "#0057a8";
	// Color ID:24 | Official LEGO Name: Yellow
	const COLOR24 = "#fec400";
	// Color ID:26 | Official LEGO Name: Black
	const COLOR26 = "#010101";
	// Color ID:28 | Official LEGO Name: Green
	const COLOR28 = "#007b28";
	// Color ID:37 | Official LEGO Name: Bright Green
	const COLOR37 = "#009624";
	// Color ID:38 | Official LEGO Name: Dark Orange
	const COLOR38 = "#a83d15";
	// Color ID:102 | Official LEGO Name: Medium Blue
	const COLOR102 = "#478cc6";
	// Color ID:106 | Official LEGO Name: Orange
	const COLOR106 = "#e76318";
	// Color ID:119 | Official LEGO Name: Lime
	const COLOR119 = "#95b90b";
	// Color ID:124 | Official LEGO Name: Magenta
	const COLOR124 = "#9c006b";
	// Color ID:135 | Official LEGO Name: Sand Blue
	const COLOR135 = "#5e748c";
	// Color ID:138 | Official LEGO Name: Dark Tan
	const COLOR138 = "#8d7452";
	// Color ID:140 | Official LEGO Name: Dark Blue
	const COLOR140 = "#002541";
	// Color ID:141 | Official LEGO Name: Dark Green
	const COLOR141 = "#003416";
	// Color ID:151 | Official LEGO Name: Sand Green
	const COLOR151 = "#5f8265";
	// Color ID:154 | Official LEGO Name: Dark Red
	const COLOR154 = "#80081b";
	// Color ID:191 | Official LEGO Name: Bright Light Orange
	const COLOR191 = "#f49b00";
	// Color ID:192 | Official LEGO Name: Reddish Brown
	const COLOR192 = "#5b1c0c";
	// Color ID:194 | Official LEGO Name: Light Grey
	const COLOR194 = "#9c9291";
	// Color ID:199 | Official LEGO Name: Dark Grey
	const COLOR199 = "#4c5156";
	// Color ID:208 | Official LEGO Name: Very Light Grey
	const COLOR208 = "#e4e4da";
	// Color ID:212 | Official LEGO Name: Light Blue
	const COLOR212 = "#87c0ea";
	// Color ID:221 | Official LEGO Name: Bright Pink
	const COLOR221 = "#de378b";
	// Color ID:222 | Official LEGO Name: Light Pink
	const COLOR222 = "#ee9dc3";
	// Color ID:226 | Official LEGO Name: Blonde
	const COLOR226 = "#ffff99";
	// Color ID:268 | Official LEGO Name: Dark Purple
	const COLOR268 = "#2c1577";
	// Color ID:283 | Official LEGO Name: Light Flesh
	const COLOR283 = "#f5c189";
	// Color ID:308 | Official LEGO Name: Dark Brown
	const COLOR308 = "#300f06";
	// Color ID:312 | Official LEGO Name: Medium Dark Flesh
	const COLOR312 = "#aa7d55";
	// Color ID:321 | Official LEGO Name:
	const COLOR321 = "#469bc3";
	// Color ID:322 | Official LEGO Name: Azure
	const COLOR322 = "#68c3e2";
	// Color ID:323 | Official LEGO Name: Unikitty Blue
	const COLOR323 = "#d3f2ea";
	// Color ID:324 | Official LEGO Name:
	const COLOR324 = "#a06eb9";
	// Color ID:325 | Official LEGO Name: Lavender
	const COLOR325 = "#cda4de";
	// Color ID:326 | Official LEGO Name: Unikitty Green
	const COLOR326 = "#e2f99a";
	// Color ID:329 | Official LEGO Name: Glow-in-the-dark
	const COLOR329 = "#f5f3d7";
	// Color ID:330 | Official LEGO Name: Olive Green
	const COLOR330 = "#77774e";
	// Color ID: 331 | Official LEGO Name: Dark Lime Medium Lime
	const COLOR331 = "#96b93b";
}