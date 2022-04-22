<?php

namespace dhondoicipher;

/**
 * @author DHONDOI
 */
class PolyAlphabetBlock
{

    private $text, $textArray, $key, $sR = "";

    /**
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     * @param key kata kunci yang digunakan untuk melakukan enkripsi dan
     * dekripsi (dengan syarat kata kunci harus sama baik enkripsi ke dekripsi
     * ataupun sebaliknya) kata kunci berupa huruf dan tidak ada penggunaan
     * huruf yang diulang, jika ada pengulangan huruf, tetap 1 huruf tersebut.
     * @param range berapa huruf setiap blok, jumlah blok dibuat secara otomatis
     */
    public function __construct(String $text, array $key, int $range)
    {
        $this->text = $text;
        $this->key = $key;
        $temp = 0;
        $m = 2;
        if ((strlen($this->text) % $range) != 0) {
            $temp = strlen($this->text) - (strlen($this->text) % $range);
            $this->sR = substr($this->text, $temp);
            $this->text = substr($this->text, 0, strlen($this->text) - strlen($this->sR));
        }
        $temp = 0;
        $block = $range;
        for ($i = 0; $i < strlen($this->text) / $range; $i++) {
            if ($block <= strlen($this->text)) {
                $this->textArray[$i] = substr($this->text, $temp, $range);
                $temp = $block;
                $block = $m * $range;
                $m++;
            }
        }
    }

    /**
     * @return String enkripsi
     */
    public function encrypt()
    {
        $this->text = "";
        for ($i = 0; $i < count($this->textArray); $i++) {
            if ($this->textArray[$i] == null) {
                break;
            } else {
                $polyAlphabet = new PolyAlphabet($this->textArray[$i], $this->key[$i % count($this->key)]);
                $this->text .= $polyAlphabet->encrypt();
            }
        }
        return $this->text . $this->sR;
    }

    /**
     * @return String dekripsi
     */
    public function decrypt()
    {
        $this->text = "";
        for ($i = 0; $i < count($this->textArray); $i++) {
            if ($this->textArray[$i] == null) {
                break;
            } else {
                $polyAlphabet = new PolyAlphabet($this->textArray[$i], $this->key[$i % count($this->key)]);
                $this->text .= $polyAlphabet->decrypt();
            }
        }
        return $this->text . $this->sR;
    }
}
