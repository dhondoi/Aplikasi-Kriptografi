<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class VigenereAlphabet
{

    private array $text;
    private array $key;
    private array $alphabet;
    private array $alphabetTable;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param key untuk kata kunci yang digunakan untuk enkripsi maupunn dekripsi
     */
    public function __construct(String $text, String $key)
    {
        $this->text = str_split($text);
        $key = strtolower(str_replace(" ", "", $key));
        $this->key = str_split($key);
        $c1 = '';
        $c2 = 'a';
        $this->alphabetTable = array();
        $this->alphabet = array();
        for ($i = 0; $i < 26; $i++) {
            $this->alphabet[$i] = $c2;
            $c1 = $c2++;
            for ($j = 0; $j < 26; $j++) {
                $this->alphabetTable[$i][$j] = $c1;
                if ($c1 == 'z') {
                    $c1 = 'a';
                } else {
                    $c1++;
                }
            }
        }
    }

    /**
     *
     * @return String enkripsi
     */
    public function encrypt()
    {
        $count = 0;
        for ($i = 0; $i < count($this->text); $i++) {
            if ($count >= count($this->key)) {
                $count = 0;
            }
            for ($j = 0; $j < count($this->alphabet); $j++) {
                if ($this->text[$i] == $this->alphabet[$j]) {
                    for ($k = 0; $k < count($this->alphabet); $k++) {
                        if ($this->key[$count] == $this->alphabet[$k]) {
                            $this->text[$i] = $this->alphabetTable[$j][$k];
                            break;
                        }
                    }
                    break;
                }
            }
            $count++;
        }
        return implode($this->text);
    }

    /**
     *
     * @return String dekripsi
     */
    public function decrypt()
    {
        $count = 0;
        for ($i = 0; $i < count($this->text); $i++) {
            if ($count >= count($this->key)) {
                $count = 0;
            }
            for ($j = 0; $j < count($this->alphabet); $j++) {
                if ($this->key[$count] == $this->alphabet[$j]) {
                    for ($k = 0; $k < count($this->alphabet); $k++) {
                        if ($this->text[$i] == $this->alphabetTable[$j][$k]) {
                            $this->text[$i] = $this->alphabet[$k];
                            break;
                        }
                    }
                    break;
                }
            }
            $count++;
        }
        return implode($this->text);
    }
}
