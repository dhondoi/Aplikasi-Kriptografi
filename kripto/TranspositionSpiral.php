<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class TranspositionSpiral
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
        $top = 0;
        $down = $this->rowCol - 1;
        $left = 0;
        $right = $this->rowCol - 1;
        $dir = 0;
        $count = 0;
        while ($top <= $down && $left <= $right) {
            switch ($dir) {
                case 0:
                    for ($i = $left; $i <= $right; $i++) {
                        if ($count < strlen($this->text)) {
                            $this->cipherText[$top][$i] = substr($this->text, $count++, 1);
                        } else {
                            $this->cipherText[$top][$i] = 'x';
                        }
                    }
                    $top++;
                    break;
                case 1:
                    for ($i = $top; $i <= $down; $i++) {
                        if ($count < strlen($this->text)) {
                            $this->cipherText[$i][$right] = substr($this->text, $count++, 1);
                        } else {
                            $this->cipherText[$i][$right] = 'x';
                        }
                    }
                    $right--;
                    break;
                case 2:
                    for ($i = $right; $i >= $left; $i--) {
                        if ($count < strlen($this->text)) {
                            $this->cipherText[$down][$i] = substr($this->text, $count++, 1);
                        } else {
                            $this->cipherText[$down][$i] = 'x';
                        }
                    }
                    $down--;
                    break;
                case 3:
                    for ($i = $down; $i >= $top; $i--) {
                        if ($count < strlen($this->text)) {
                            $this->cipherText[$i][$left] = substr($this->text, $count++, 1);
                        } else {
                            $this->cipherText[$i][$left] = 'x';
                        }
                    }
                    $left++;
                    break;
                default:
                    break;
            }
            $dir = ($dir + 1) % $this->rowCol;
        }
        $this->text = "";
        for ($i = 0; $i < $this->rowCol; $i++) {
            for ($j = 0; $j < $this->rowCol; $j++) {
                $this->text .= $this->cipherText[$j][$i];
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
        $csr = 0;
        for ($i = 0; $i < $this->rowCol; $i++) {
            for ($j = 0; $j < $this->rowCol; $j++) {
                $this->cipherText[$j][$i] = substr($this->text, $csr++, 1);
            }
        }
        $this->text = "";
        $top = 0;
        $down = $this->rowCol - 1;
        $left = 0;
        $right = $this->rowCol - 1;
        $dir = 0;
        while ($top <= $down && $left <= $right) {
            switch ($dir) {
                case 0:
                    for ($i = $left; $i <= $right; $i++) {
                        $this->text .= $this->cipherText[$top][$i];
                    }
                    $top++;
                    break;
                case 1:
                    for ($i = $top; $i <= $down; $i++) {
                        $this->text .= $this->cipherText[$i][$right];
                    }
                    $right--;
                    break;
                case 2:
                    for ($i = $right; $i >= $left; $i--) {
                        $this->text .= $this->cipherText[$down][$i];
                    }
                    $down--;
                    break;
                case 3:
                    for ($i = $down; $i >= $top; $i--) {
                        $this->text .= $this->cipherText[$i][$left];
                    }
                    $left++;
                    break;
                default:
                    break;
            }
            $dir = ($dir + 1) % $this->rowCol;
        }
        return $this->text . $this->sR;
    }
}
