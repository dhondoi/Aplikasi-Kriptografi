<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class PolyAlphabetZigzag
{

    private String $text, $tempText;
    private String $temp;
    private array $key;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param key beberapa kata kunci yang digunakan dalam enkripsi maupun
     * dekripsi
     */
    public function __construct(String $text, array $key)
    {
        $this->temp = $text;
        $this->key = $key;
    }

    /**
     *
     * @return String enkripsi
     */
    public function encrypt()
    {
        $this->text = "";
        for ($i = 0; $i < strlen($this->temp); $i++) {
            $this->tempText = substr($this->temp, $i, 1);
            for ($j = 0; $j < count($this->key); $j++) {
                if ($j == 0) {
                    $polyAlphabet = new PolyAlphabet($this->tempText, $this->key[$j]);
                    $this->tempText = $polyAlphabet->encrypt();
                } else {
                    $polyAlphabet = new PolyAlphabet($this->tempText, $this->key[$j]);
                    $this->tempText = $polyAlphabet->decrypt();
                }
            }
            $this->text .= $this->tempText;
        }
        return $this->text;
    }

    /**
     *
     * @return String dekripsi
     */
    public function decrypt()
    {
        $this->text = "";
        for ($i = 0; $i < strlen($this->temp); $i++) {
            $this->tempText = substr($this->temp, $i, 1);
            for ($j = count($this->key) - 1; $j >= 0; $j--) {
                if ($j == 0) {
                    $polyAlphabet = new PolyAlphabet($this->tempText, $this->key[$j]);
                    $this->tempText = $polyAlphabet->decrypt();
                } else {
                    $polyAlphabet = new PolyAlphabet($this->tempText, $this->key[$j]);
                    $this->tempText = $polyAlphabet->encrypt();
                }
            }
            $this->text .= $this->tempText;
        }
        return $this->text;
    }
}
