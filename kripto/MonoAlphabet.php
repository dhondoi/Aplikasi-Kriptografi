<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class MonoAlphabet
{

    private $plainText, $cipherText, $text;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param range untuk jarak alphabet melakukan pergeseran
     * 
     */
    public function __construct($text, $range)
    {
        $this->text = str_split($text);
        $temp = 'a';
        for ($i = 0; $i < 26; $i++) {
            $this->plainText[$i] = $temp;
            $this->cipherText[$i] = $temp;
            $temp++;
        }
        for ($i = 0; $i < $range; $i++) {
            for ($j = 0; $j < count($this->cipherText) - 1; $j++) {
                $temp = $this->cipherText[$j];
                $this->cipherText[$j] = $this->cipherText[$j + 1];
                $this->cipherText[$j + 1] = $temp;
            }
        }
    }

    /**
     *
     * @return string hasil enkripsi
     * 
     */
    public function encrypt()
    {
        for ($i = 0; $i < count($this->text); $i++) {
            for ($j = 0; $j < count($this->plainText); $j++) {
                if ($this->text[$i] == $this->plainText[$j]) {
                    $this->text[$i] = $this->cipherText[$j];
                    break;
                }
            }
        }
        return implode($this->text);
    }

    /**
     *
     * @return String dekripsi
     */
    public function decrypt()
    {
        for ($i = 0; $i < count($this->text); $i++) {
            for ($j = 0; $j < count($this->cipherText); $j++) {
                if ($this->text[$i] == $this->cipherText[$j]) {
                    $this->text[$i] = $this->plainText[$j];
                    break;
                }
            }
        }
        return implode($this->text);
    }
}
