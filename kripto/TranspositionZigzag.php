<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class TranspositionZigzag
{

    private array $cipherText;
    private Int $row;
    private String $text;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param row jumlah baris yang nantinya diisi oleh text
     */
    public function __construct(String $text, int $row)
    {
        $this->text = $text;
        $this->row = $row;
        $this->cipherText = array();
    }

    /**
     *
     * @return string enkripsi
     */
    public function encrypt()
    {
        for ($i = 0; $i < $this->row; $i++) {
            for ($j = 0; $j < strlen($this->text); $j++) {
                $this->cipherText[$i][$j] = '^';
            }
        }
        $temp = $this->row - 1;
        $b = false;
        $last = 0;
        for ($i = 0; $i < strlen($this->text); $i++) {
            $this->cipherText[$temp][$i] = substr($this->text, $i, 1);
            if ($temp == 0 || $temp == ($this->row - 1)) {
                $b = !$b;
            }
            if ($b == true) {
                $last = $temp--;
            } else {
                $last = ($this->row - $temp++) - 1;
            }
        }
        $resultText = "";
        for ($i = 0; $i < $this->row; $i++) {
            for ($j = 0; $j < strlen($this->text); $j++) {
                if ($this->cipherText[$i][$j] != '^') {
                    $resultText .= $this->cipherText[$i][$j];
                }
            }
        }
        return $resultText;
    }

    /**
     *
     * @return string dekripsi
     */
    public function decrypt()
    {
        for ($i = 0; $i < $this->row; $i++) {
            for ($j = 0; $j < strlen($this->text); $j++) {
                $this->cipherText[$i][$j] = '^';
            }
        }
        $temp = $this->row - 1;
        $b = false;
        $last = 0;
        for ($i = 0; $i < strlen($this->text); $i++) {
            $this->cipherText[$temp][$i] = ' ';
            if ($temp == 0 || $temp == ($this->row - 1)) {
                $b = !$b;
            }
            if ($b == true) {
                $last = $temp--;
            } else {
                $last = ($this->row - $temp++) - 1;
            }
        }
        $csr = 0;
        for ($i = 0; $i < $this->row; $i++) {
            for ($j = 0; $j < strlen($this->text); $j++) {
                if ($this->cipherText[$i][$j] == ' ') {
                    $this->cipherText[$i][$j] = substr($this->text, $csr++, 1);
                }
            }
        }
        $resultText = "";
        $temp = $this->row - 1;
        $b = false;
        for ($i = 0; $i < strlen($this->text); $i++) {
            $resultText .= $this->cipherText[$temp][$i];
            if ($temp == 0 || $temp == ($this->row - 1)) {
                $b = !$b;
            }
            if ($b == true) {
                $temp--;
            } else {
                $temp++;
            }
        }
        return $resultText;
    }
}
