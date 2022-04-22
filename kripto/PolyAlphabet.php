<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class PolyAlphabet
{

    private $plainText, $cipherText, $text;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param key kata kunci yang digunakan untuk melakukan enkripsi dan dekripsi
     * (dengan syarat kata kunci harus sama baik enkripsi ke dekripsi ataupun sebaliknya)
     * kata kunci berupa huruf dan tidak ada penggunaan huruf yang diulang,
     * jika ada pengulangan huruf, tetap 1 huruf tersebut.
     */
    public function __construct(String $text, String $key)
    {
        $key = strtolower(str_replace(" ", "", $key));
        $this->text = str_split($key);
        $key = str_split(count_chars($key, 3));
        $result = array();
        $plus = 0;
        for ($i = 0; $i < count($this->text); $i++) {
            $count = 0;
            for ($j = 0; $j < count($this->text); $j++) {
                if ($this->text[$i] == $this->text[$j]) {
                    $count++;
                }
            }
            if ($count == 1) {
                $result[$plus++] = $this->text[$i];
            } else {
                $bol = false;
                for ($k = 0; $k < count($result); $k++) {
                    if ($result[$k] == $this->text[$i]) {
                        $bol = true;
                        break;
                    }
                }
                if ($bol == false) {
                    $result[$plus++] = $this->text[$i];
                }
            }
        }

        $temp = 'a';
        for ($i = 0; $i < 26; $i++) {
            $this->plainText[$i] = $temp;
            $this->cipherText[$i] = $temp;
            $temp++;
        }
        for ($i = 0; $i < count($result); $i++) {
            for ($j = $i; $j < count($this->cipherText); $j++) {
                if ($result[$i] == $this->cipherText[$j]) {
                    for ($k = $i; $k < $j; $k++) {
                        $temp = $this->cipherText[$k + 1];
                        $this->cipherText[$k + 1] = $this->cipherText[$i];
                        $this->cipherText[$i] = $temp;
                    }
                    break;
                }
            }
        }
        $this->text = str_split($text);
    }

    /**
     *
     * @return String enkripsi
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
