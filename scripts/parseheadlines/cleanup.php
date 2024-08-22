<?php
/**
 * file to clean up bad voikko from uutisotsikot
 */


$paikannimet = explode(PHP_EOL, file_get_contents("../../uutisotsikot/paikannimi.txt"));

if (false) {
    $c = file_get_contents("../../uutisotsikot/etunimi.txt");
    $p = explode(PHP_EOL, $c);

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
}

if (false) {
    $c = file_get_contents("../../uutisotsikot/laatusana.txt");
    $p = explode(PHP_EOL, $c);
    foreach ($p as $i => $val) {
        // first bad - stuff
        $pcs = explode("-", $val);
        if (count($pcs) >= 2) {
            if (in_array($pcs[0], $paikannimet, true)) {
                print $val . PHP_EOL;
            }
        }
    }
}

if (false) {
    $romanNumerals = ["ii", "iii", "iv", "ix", "vi", "vii", "viii"];
    $c = file_get_contents("../../uutisotsikot/lukusana.txt");
    $p = explode(PHP_EOL, $c);
    foreach ($p as $i => $val) {
        $camp = mb_strtolower($val);
        if (in_array(mb_substr($camp, 0, 1), ["-", "x"], true) || in_array($camp, $romanNumerals, true)) {
            print $val . PHP_EOL;
        }
    }
}

if (false) {
    $badFirsts = array_merge($paikannimet, ["NHL", "äiti", "EM", "MM", "EU", "Missi", "TV"]);

    $c = file_get_contents("../../uutisotsikot/teonsana.txt");
    $p = explode(PHP_EOL, $c);
    foreach ($p as $i => $val) {
        // first bad - stuff
        $pcs = explode("-", $val);
        if (count($pcs) >= 2) {
            if (in_array($pcs[0], $badFirsts, true)) {
                print $val . PHP_EOL;
            }
        }
    }
}

