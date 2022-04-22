<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class PolyAlphabetCharacter
{

    private String $text;
    private String $temp;
    private array $key;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param key beberapa kata kunci yang digunakan dalam enkripsi maupun dekripsi
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
            $polyAlphabet = new PolyAlphabet(substr($this->temp, $i, 1), $this->key[$i % count($this->key)]);
            $this->text .= $polyAlphabet->encrypt();
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
            $polyAlphabet = new PolyAlphabet(substr($this->temp, $i, 1), $this->key[$i % count($this->key)]);
            $this->text .= $polyAlphabet->decrypt();
        }
        return $this->text;
    }
}
