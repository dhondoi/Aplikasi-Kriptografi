<?php

use dhondoicipher\PlayFair;
use dhondoicipher\MonoAlphabet;
use dhondoicipher\PolyAlphabet;
use dhondoicipher\Transposition;
use dhondoicipher\VigenereAlphabet;
use dhondoicipher\MonoAlphabetSlide;
use dhondoicipher\PolyAlphabetBlock;
use dhondoicipher\VigenereNumerical;
use dhondoicipher\PolyAlphabetZigzag;
use dhondoicipher\TranspositionSpiral;
use dhondoicipher\TranspositionZigzag;
use dhondoicipher\PolyAlphabetCharacter;
use dhondoicipher\TranspositionDiagonal;
use dhondoicipher\TranspositionTriangle;

spl_autoload_register(function ($class) {
    $class = explode("\\", $class);
    $class = end($class);
    // require_once "dhondoicipher/".$class . ".php";
    require_once $class . ".php";
});


const RANGE = [4, 5, 1, 6, 3, 2];
const KEY = ["merdeka", "indonesia", "putih merah"];

function getEncrypt(String $string)
{
    $string = new MonoAlphabet($string, RANGE[0]);
    $string = $string->encrypt();
    $string = new PolyAlphabet($string, KEY[0]);
    $string = $string->encrypt();
    $string = new PolyAlphabetBlock($string, KEY, RANGE[0]);
    $string = $string->encrypt();
    $string = new PolyAlphabetCharacter($string, KEY);
    $string = $string->encrypt();
    $string = new PolyAlphabetZigzag($string, KEY);
    $string = $string->encrypt();
    $string = new MonoAlphabetSlide($string, RANGE[0]);
    $string = $string->encrypt();
    $string = new VigenereNumerical($string, RANGE);
    $string = $string->encrypt();
    $string = new VigenereAlphabet($string, KEY[0]);
    $string = $string->encrypt();
    $string = new PlayFair($string);
    $string = $string->encrypt();
    $string = new Transposition($string, RANGE);
    $string = $string->encrypt();
    $string = new TranspositionZigzag($string, RANGE[0]);
    $string = $string->encrypt();
    $string = new TranspositionTriangle($string);
    $string = $string->encrypt();
    $string = new TranspositionSpiral($string);
    $string = $string->encrypt();
    $string = new TranspositionDiagonal($string);
    $string = $string->encrypt();
    return $string;
}

function getDecrypt(String $string)
{
    $string = new TranspositionDiagonal($string);
    $string = $string->decrypt();
    $string = new TranspositionSpiral($string);
    $string = $string->decrypt();
    $string = new TranspositionTriangle($string);
    $string = $string->decrypt();
    $string = new TranspositionZigzag($string, RANGE[0]);
    $string = $string->decrypt();
    $string = new Transposition($string, RANGE);
    $string = $string->decrypt();
    $string = new PlayFair($string);
    $string = $string->decrypt();
    $string = new VigenereAlphabet($string, KEY[0]);
    $string = $string->decrypt();
    $string = new VigenereNumerical($string, RANGE);
    $string = $string->decrypt();
    $string = new MonoAlphabetSlide($string, RANGE[0]);
    $string = $string->decrypt();
    $string = new PolyAlphabetZigzag($string, KEY);
    $string = $string->decrypt();
    $string = new PolyAlphabetCharacter($string, KEY);
    $string = $string->decrypt();
    $string = new PolyAlphabetBlock($string, KEY, RANGE[0]);
    $string = $string->decrypt();
    $string = new PolyAlphabet($string, KEY[0]);
    $string = $string->decrypt();
    $string = new MonoAlphabet($string, RANGE[0]);
    $string = $string->decrypt();
    return $string;
}

// $_POST["submit"] = "encrypt";
// $_POST["dataEnc"] = "perhatikanrakyatkecil";
$data = json_decode(file_get_contents('php://input'), true);
if (isset($data["submit"])) {
    if ($data["submit"] == "encrypt") {
        $response['success'] = getEncrypt($data["dataEnc"]);
        die(json_encode($response));
    } else if ($data["submit"] == "decrypt") {
        $response['success'] = getDecrypt($data["dataDec"]);
        die(json_encode($response));
    } else {
        $response['success'] = null;
        die(json_encode($response));
    }
}
