<?php
/**
 * file to clean up bad voikko from uutisotsikot
 */

$paikannimet = explode(PHP_EOL, file_get_contents("../../uutisotsikot/paikannimi.txt"));
$etuliitteet = ["NHL", "äiti", "EM", "MM", "EU", "Missi", "TV", "äiti", "Afganistanin", "Afrikan"];
$badSeconds = ["Päivä", "Sisko", "Akseli", "poika", "vaimo"];

$debug = false;
$runOnFiles = [
    "etunimi" => true,
    "laatusana" => true,
    "lukusana" => true,
    "nimisana" => true,
    "sukunimi" => true,
    "teonsana" => true,
];

if ($runOnFiles["etunimi"]) {
    $filename = "../../uutisotsikot/etunimi.txt";
    $c = file_get_contents($filename);
    $p = explode(PHP_EOL, $c);

    $badFirsts = array_merge($paikannimet, $etuliitteet);

    unset($badFirsts[array_search("Kaija", $badFirsts)]);
    unset($badFirsts[array_search("Mari", $badFirsts)]);
    unset($badFirsts[array_search("Saku", $badFirsts)]);
    unset($badFirsts[array_search("Simo", $badFirsts)]);

    foreach ($p as $i => $val) {
        // first bad - stuff
        $pcs = explode("-", $val);
        if (count($pcs) >= 2) {
            if (in_array($pcs[0], $badFirsts, true) || in_array($pcs[1], $badSeconds, true)) {
                if ($debug) {
                    print $val . PHP_EOL;
                } else {
                    unset($p[$i]);
                }
            }
        }
    }
    if (!$debug) {
        file_put_contents($filename, implode(PHP_EOL, $p));
    }
}

if ($runOnFiles["nimisana"]) {
    $filename = "../../uutisotsikot/nimisana.txt";
    $c = file_get_contents($filename);
    $p = explode(PHP_EOL, $c);
    foreach ($p as $i => $val) {
        // first bad - stuff
        $pcs = explode("-", $val);
        if (count($pcs) >= 2) {
            if (in_array($pcs[0], $paikannimet, true)) {
                if ($debug) {
                    print $val . PHP_EOL;
                } else {
                    unset($p[$i]);
                }
            }
        }
    }
    if (!$debug) {
        file_put_contents($filename, implode(PHP_EOL, $p));
    }
}

if ($runOnFiles["laatusana"]) {
    $filename = "../../uutisotsikot/laatusana.txt";
    $c = file_get_contents($filename);
    $p = explode(PHP_EOL, $c);
    foreach ($p as $i => $val) {
        // first bad - stuff
        $pcs = explode("-", $val);
        if (count($pcs) >= 2) {
            if (in_array($pcs[0], $paikannimet, true)) {
                if ($debug) {
                    print $val . PHP_EOL;
                } else {
                    unset($p[$i]);
                }
            }
        }
    }
    if (!$debug) {
        file_put_contents($filename, implode(PHP_EOL, $p));
    }
}

if ($runOnFiles["lukusana"]) {
    $romanNumerals = ["ii", "iii", "iv", "ix", "vi", "vii", "viii"];
    $filename = "../../uutisotsikot/lukusana.txt";
    $c = file_get_contents($filename);
    $p = explode(PHP_EOL, $c);
    foreach ($p as $i => $val) {
        $camp = mb_strtolower($val);
        if (in_array(mb_substr($camp, 0, 1), ["-", "x"], true) || in_array($camp, $romanNumerals, true)) {
            if ($debug) {
                print $val . PHP_EOL;
            } else {
                unset($p[$i]);
            }
        }
    }
    if (!$debug) {
        file_put_contents($filename, implode(PHP_EOL, $p));
    }
}

if ($runOnFiles["sukunimi"]) {
    $badFirsts = array_merge($paikannimet, $etuliitteet);
    unset($badFirsts[array_search("Väinölä", $badFirsts)]);
    unset($badFirsts[array_search("Ukkola", $badFirsts)]);
    unset($badFirsts[array_search("Takalo", $badFirsts)]);
    unset($badFirsts[array_search("Tervo", $badFirsts)]);
    unset($badFirsts[array_search("Tervola", $badFirsts)]);
    unset($badFirsts[array_search("Salmela", $badFirsts)]);
    unset($badFirsts[array_search("Pisa", $badFirsts)]);
    unset($badFirsts[array_search("Mikkola", $badFirsts)]);
    unset($badFirsts[array_search("Koski", $badFirsts)]);

    $filename = "../../uutisotsikot/sukunimi.txt";
    $c = file_get_contents($filename);
    $p = explode(PHP_EOL, $c);
    foreach ($p as $i => $val) {
        // first bad - stuff
        $pcs = explode("-", $val);
        if (count($pcs) >= 2) {
            if (in_array($pcs[0], $badFirsts, true)) {
                if ($debug) {
                    print $val . PHP_EOL;
                } else {
                    unset($p[$i]);
                }
            }
        }
    }
    if (!$debug) {
        file_put_contents($filename, implode(PHP_EOL, $p));
    }
}

if ($runOnFiles["teonsana"]) {
    $badFirsts = array_merge($paikannimet, $etuliitteet);
    $filename = "../../uutisotsikot/teonsana.txt";
    $c = file_get_contents($filename);
    $p = explode(PHP_EOL, $c);
    foreach ($p as $i => $val) {
        // first bad - stuff
        $pcs = explode("-", $val);
        if (count($pcs) >= 2) {
            if (in_array($pcs[0], $badFirsts, true)) {
                if ($debug) {
                    print $val . PHP_EOL;
                } else {
                    unset($p[$i]);
                }
            }
        }
    }
    if (!$debug) {
        file_put_contents($filename, implode(PHP_EOL, $p));
    }
}

