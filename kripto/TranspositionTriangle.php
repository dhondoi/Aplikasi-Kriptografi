<?php

namespace dhondoicipher;

/**
 * @author DHONDOI
 */
class TranspositionTriangle
{

    private array $cipherText;
    private String $text;
    private String  $sR = "";
    private int $row, $col;

    /**
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     */
    public function __construct(String $text)
    {
        $this->text = $text;
        $this->row = 1;
        $this->col = 1;
        $agr = 1;
        $stop = false;
        while (!$stop) {
            if (strlen($this->text) <= $agr) {
                $this->cipherText = array();
                $this->sR = substr($this->text, ($this->row - 1) * ($this->row - 1));
                $this->row -= 1;
                $this->col -= 1;
                $stop = true;
            } else {
                $this->row++;
                $this->col += 2;
                $agr += $this->col;
                $stop = false;
            }
        }
        for ($i = 0; $i < $this->row; $i++) {
            for ($j = 0; $j < $this->col; $j++) {
                $this->cipherText[$i][$j] = '^';
            }
        }
    }

    /**
     * @return string enkripsi
     */
    public function encrypt()
    {
        $range = 1;
        $point = 0;
        $a = $this->row - 1;
        $b = 0;
        for ($i = 0; $i < $this->row; $i++) {
            $b = $a;
            for ($j = 0; $j < $this->col; $j++) {
                if ($j < $range) {
                    if ($point < strlen($this->text)) {
                        $this->cipherText[$i][$b] = substr($this->text, $point++, 1);
                    } else {
                        $this->cipherText[$i][$b] = 'X';
                    }
                    $b++;
                } else {
                    break;
                }
            }
            $a--;
            $range += 2;
        }
        $this->text = "";
        for ($i = 0; $i < $this->col; $i++) {
            for ($j = 0; $j < $this->row; $j++) {
                if ($this->cipherText[$j][$i] != '^') {
                    $this->text .= $this->cipherText[$j][$i];
                }
            }
        }
        return $this->text . $this->sR;
    }

    /**
     * @return String dekripsi
     */
    public function decrypt()
    {
        $a = 1;
        $point = 0;
        $b = false;
        for ($i = 0; $i < $this->col; $i++) {
            for ($j = $this->row - $a; $j < $this->row; $j++) {
                $this->cipherText[$j][$i] = substr($this->text, $point++, 1);
            }
            if ($a == $this->row || $a == 0) {
                $b = !$b;
            }
            if ($b == true) {
                $a--;
            } else {
                $a++;
            }
        }
        $this->text = "";
        for ($i = 0; $i < $this->row; $i++) {
            for ($j = 0; $j < $this->col; $j++) {
                if ($this->cipherText[$i][$j] != '^') {
                    $this->text .= $this->cipherText[$i][$j];
                }
            }
        }
        return $this->text . $this->sR;
    }
}
