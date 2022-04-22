<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class VigenereNumerical
{

    private array $cipherText, $text, $range;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param range beberapa jarak untuk melakukan pergeseran
     * dari huruf tersebut
     */
    public function __construct(String $text, array $range)
    {
        $this->text = str_split($text);
        $this->range = $range;
        $this->cipherText = array();
        $temp = 'a';
        for ($i = 0; $i < 26; $i++) {
            $this->cipherText[$i] = $temp++;
        }
    }

    /**
     *
     * @return String enkripsi
     */
    public function encrypt()
    {
        for ($i = 0; $i < count($this->text); $i++) {
            for ($j = 0; $j < count($this->cipherText); $j++) {
                if ($this->text[$i] == $this->cipherText[$j]) {
                    if (($j + $this->range[$i % count($this->range)]) < count($this->cipherText)) {
                        $this->text[$i] = $this->cipherText[$j + $this->range[$i % count($this->range)]];
                    } else {
                        $this->text[$i] = $this->cipherText[($j + $this->range[$i % count($this->range)]) - count($this->cipherText)];
                    }
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
                    if (($j - $this->range[$i % count($this->range)]) >= 0) {
                        $this->text[$i] = $this->cipherText[$j - $this->range[$i % count($this->range)]];
                    } else {
                        $this->text[$i] = $this->cipherText[($j - $this->range[$i % count($this->range)]) + count($this->cipherText)];
                    }
                    break;
                }
            }
        }
        return implode($this->text);
    }
}
