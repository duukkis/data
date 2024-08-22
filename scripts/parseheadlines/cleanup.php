<?php
/**
 * file to clean up bad voikko from uutisotsikot
 */

$c = file_get_contents("../../uutisotsikot/etunimi.txt");
$p = explode(PHP_EOL, $c);

$paikannimet = explode(PHP_EOL, file_get_contents("../../uutisotsikot/paikannimi.txt"));

$badFirsts = array_merge($paikannimet, ["NHL", "äiti", "EM", "MM", "EU", "Missi", "TV"]);
$badSeconds = ["Päivä", "Sisko", "Akseli"];

unset($badFirsts[array_search("Kaija", $badFirsts)]);
unset($badFirsts[array_search("Mari", $badFirsts)]);
unset($badFirsts[array_search("Saku", $badFirsts)]);
unset($badFirsts[array_search("Simo", $badFirsts)]);

foreach ($p as $i => $val) {
    // first bad - stuff
    $pcs = explode("-", $val);
    if (count($pcs) >= 2) {
        if (in_array($pcs[0], $badFirsts, true) || in_array($pcs[1], $badSeconds, true)) {
            print $val . PHP_EOL;
        }
    }
}
