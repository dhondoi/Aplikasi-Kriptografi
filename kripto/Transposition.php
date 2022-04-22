<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class Transposition
{

    private array $text;
    private array $key;
    private String $tempText;
    private String $sR = "";

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param key beberapa kata kunci untuk melakukan enkripsi atau dekripsi
     */
    public function __construct(String $text, array $key)
    {
        $this->key = $key;
        $this->tempText = $text;
        if ((strlen($this->tempText) % count($this->key)) != 0) {
            $this->sR = substr($this->tempText, strlen($this->tempText) - (strlen($this->tempText) % count($this->key)));
            $this->tempText = substr($this->tempText, 0, strlen($this->tempText) - (strlen($this->tempText) % count($this->key)));
        }
        $count = 0;
        for ($i = 0; $i < (strlen($this->tempText) / count($this->key)); $i++) {
            for ($j = 0; $j < count($this->key); $j++) {
                if ($count < strlen($this->tempText)) {
                    $this->text[$i][$j] = substr($this->tempText, $count, 1);
                }
                $count++;
            }
        }
    }

    /**
     *
     * @return String enkripsi
     */
    public function encrypt()
    {
        $this->tempText = "";
        for ($i = 0; $i < count($this->text); $i++) {
            for ($j = 0; $j < count($this->key); $j++) {
                for ($k = 0; $k < count($this->key); $k++) {
                    if ($this->key[$j] == ($k + 1)) {
                        $this->tempText .= $this->text[$i][$k];
                        break;
                    }
                }
            }
        }
        return $this->tempText . $this->sR;
    }

    /**
     *
     * @return String dekripsi
     */
    public function decrypt()
    {
        $keyDecrypt = array();
        for ($i = 1; $i <= count($this->key); $i++) {
            for ($j = 1; $j <= count($this->key); $j++) {
                if ($i == $this->key[$j - 1]) {
                    $keyDecrypt[$i - 1] = $j;
                    break;
                }
            }
        }
        $this->tempText = "";
        for ($i = 0; $i < count($this->text); $i++) {
            for ($j = 0; $j < count($keyDecrypt); $j++) {
                for ($k = 0; $k < count($keyDecrypt); $k++) {
                    if ($keyDecrypt[$j] == ($k + 1)) {
                        $this->tempText .= $this->text[$i][$k];
                        break;
                    }
                }
            }
        }
        return $this->tempText . $this->sR;
    }
}
