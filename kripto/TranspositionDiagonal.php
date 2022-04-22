<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class TranspositionDiagonal
{

    private array $cipherText;
    private String $text;
    private String $sR = "";
    private int $rowCol;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     */
    public function __construct(String $text)
    {
        $this->text = $text;
        $this->rowCol = 2;
        $stop = false;
        while (!$stop) {
            if (strlen($this->text) <= $this->rowCol * $this->rowCol) {
                $this->cipherText = array();
                $this->sR = substr($this->text, ($this->rowCol - 1) * ($this->rowCol - 1));
                $this->rowCol -= 1;
                $stop = true;
            } else {
                $this->rowCol++;
                $stop = false;
            }
        }
    }

    /**
     *
     * @return string enkripsi
     */
    public function encrypt()
    {
        $count = 0;
        for ($j = 0; $j < $this->rowCol; $j++) {
            for ($k = 0; $k < $this->rowCol; $k++) {
                if ($count < strlen($this->text)) {
                    $this->cipherText[$k][$j] = substr($this->text, $count++, 1);
                } else {
                    $this->cipherText[$k][$j] = 'X';
                }
            }
        }
        $this->text = "";
        for ($j = 0; $j < count($this->cipherText); $j++) {
            for ($k = 0; $k < count($this->cipherText); $k++) {
                $this->text .= $this->cipherText[$j][$k];
            }
        }
        return $this->text . $this->sR;
    }

    /**
     *
     * @return string dekripsi
     */
    public function decrypt()
    {
        $count = 0;
        for ($i = 0; $i < $this->rowCol; $i++) {
            for ($j = 0; $j < $this->rowCol; $j++) {
                $this->cipherText[$i][$j] = substr($this->text, $count++, 1);
            }
        }
        $this->text = "";
        for ($i = 0; $i < count($this->cipherText); $i++) {
            for ($j = 0; $j < count($this->cipherText); $j++) {
                $this->text .= $this->cipherText[$j][$i];
            }
        }
        return $this->text . $this->sR;
    }
}
