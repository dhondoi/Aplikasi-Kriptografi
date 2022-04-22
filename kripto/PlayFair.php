<?php

namespace dhondoicipher;

/**
 *
 * @author DHONDOI
 */
class PlayFair
{

    private $MATRIX
    = [
        [
            's', 't', 'a', 'n', 'd'
        ],
        [
            'e', 'r', 'c', 'h', 'b'
        ],
        [
            'k', 'f', 'g', 'i', 'l'
        ],
        [
            'm', 'o', 'p', 'q', 'u'
        ],
        [
            'v', 'w', 'x', 'y', 'z'
        ]
    ];

    private $text, $sR;

    /**
     *
     * @param text untuk kata-kata yang ingin di enkripsi atau dekripsi
     */
    public function __construct(String $text)
    {
        if ((strlen($text) % 2) == 1) {
            $this->sR = substr($text, strlen($text) - 1);
        }
        $temp = 0;
        for ($i = 0; $i < (strlen($text) / 2); $i++) {
            if ($temp + 2 <= strlen($text)) {
                $this->text[$i] = substr($text, $temp, 2);
                $temp += 2;
            }
        }
    }

    /**
     *
     * @return String enkripsi
     */
    public function encrypt()
    {
        for ($i = 0; $i < count($this->text); $i++) {
            if ($this->text[$i][0] != $this->text[$i][1]) {
                for ($j = 0; $j < 2; $j++) {
                    $match = false;
                    for ($k = 0; $k < 5; $k++) {
                        if ($match) {
                            break;
                        } else {
                            for ($l = 0; $l < 5; $l++) {
                                if ($this->text[$i][$j] == $this->MATRIX[$k][$l]) {
                                    $row[$j] = $k;
                                    $col[$j] = $l;
                                    $match = true;
                                    break;
                                }
                            }
                        }
                    }
                    if ($match == false) {
                        $row[$j] = 5;
                        $col[$j] = 5;
                    }
                }
                if ($this->text[$i][0] == 'j') {
                    if ($row[1] == 5) {
                        $this->text[$i] = $this->text[$i][1] . "" . 'j';
                    } else if (($col[1] + 1) == 5) {
                        $this->text[$i] = $this->MATRIX[$row[1]][0] . "" . 'j';
                    } else {
                        $this->text[$i] = $this->MATRIX[$row[1]][($col[1] + 1)] . "" . 'j';
                    }
                } else if ($this->text[$i][1] == 'j') {
                    if ($row[0] == 5) {
                        $this->text[$i] = 'j' . "" . $this->text[$i][0];
                    } else if (($col[0] + 1) == 5) {
                        $this->text[$i] = 'j' . "" . $this->MATRIX[($row[0])][0];
                    } else {
                        $this->text[$i] = 'j' . "" . $this->MATRIX[$row[0]][($col[0] + 1)];
                    }
                } else if ($row[1] != $row[0] && $col[1] != $col[0]) {
                    if ($row[0] == 5) {
                        if (($col[1] + 1) == 5) {
                            $this->text[$i] = $this->MATRIX[$row[1]][0] . "" . $this->text[$i][0];
                        } else {
                            $this->text[$i] = $this->MATRIX[$row[1]][($col[1] + 1)] . "" . $this->text[$i][0];
                        }
                    } else if ($row[1] == 5) {
                        if (($col[0] + 1) == 5) {
                            $this->text[$i] = $this->text[$i][1] . "" . $this->MATRIX[$row[0]][0];
                        } else {
                            $this->text[$i] = $this->text[$i][1] . "" . $this->MATRIX[$row[0]][($col[0] + 1)];
                        }
                    } else {
                        $this->text[$i] = $this->MATRIX[$row[0]][$col[1]] . "" . $this->MATRIX[$row[1]][$col[0]];
                    }
                } else {
                    if ($row[1] == $row[0]) {
                        if ($row[0] == 5) {
                            $this->text[$i] = $this->text[$i][1] . "" . $this->text[$i][0];
                        } else if (($col[0] + 1) == 5) {
                            $this->text[$i] = $this->MATRIX[$row[1]][($col[1] + 1)] . "" . $this->MATRIX[$row[0]][0];
                        } else if (($col[1] + 1) == 5) {
                            $this->text[$i] = $this->MATRIX[$row[1]][0] . "" . $this->MATRIX[$row[0]][($col[0] + 1)];
                        } else {
                            $this->text[$i] = $this->MATRIX[$row[1]][($col[1] + 1)] . "" . $this->MATRIX[$row[0]][($col[0] + 1)];
                        }
                    } else if ($col[1] == $col[0]) {
                        if (($row[0] + 1) == 5) {
                            $this->text[$i] = $this->MATRIX[($row[1] + 1)][$col[1]] . "" . $this->MATRIX[0][$col[0]];
                        } else if (($row[1] + 1) == 5) {
                            $this->text[$i] = $this->MATRIX[0][$col[1]] . "" . $this->MATRIX[($row[0] + 1)][$col[0]];
                        } else {
                            $this->text[$i] = $this->MATRIX[($row[1] + 1)][$col[1]] . "" . $this->MATRIX[($row[0] + 1)][$col[0]];
                        }
                    }
                }
            }
        }
        return implode($this->text) . $this->sR;
    }

    /**
     *
     * @return string dekripsi
     */
    public function decrypt()
    {
        for ($i = 0; $i < count($this->text); $i++) {
            if ($this->text[$i][0] != $this->text[$i][1]) {
                for ($j = 0; $j < 2; $j++) {
                    $match = false;
                    for ($k = 0; $k < 5; $k++) {
                        if ($match) {
                            break;
                        } else {
                            for ($l = 0; $l < 5; $l++) {
                                if ($this->text[$i][$j] == $this->MATRIX[$k][$l]) {
                                    $row[$j] = $k;
                                    $col[$j] = $l;
                                    $match = true;
                                    break;
                                }
                            }
                        }
                    }
                    if ($match == false) {
                        $row[$j] = 5;
                        $col[$j] = 5;
                    }
                }
                if ($this->text[$i][0] == 'j') {
                    if ($row[1] == 5) {
                        $this->text[$i] = $this->text[$i][1] . "" . 'j';
                    } else if (($col[1] - 1) == -1) {
                        $this->text[$i] = $this->MATRIX[$row[1]][4] . "" . 'j';
                    } else {
                        $this->text[$i] = $this->MATRIX[$row[1]][($col[1] - 1)] . "" . 'j';
                    }
                } else if ($this->text[$i][1] == 'j') {
                    if ($row[0] == 5) {
                        $this->text[$i] = 'j' . "" . $this->text[$i][0];
                    } else if (($col[0] - 1) == -1) {
                        $this->text[$i] = 'j' . "" . $this->MATRIX[($row[0])][4];
                    } else {
                        $this->text[$i] = 'j' . "" . $this->MATRIX[$row[0]][($col[0] - 1)];
                    }
                } else if ($row[1] != $row[0] && $col[1] != $col[0]) {
                    if ($row[0] == 5) {
                        if (($col[1] - 1) == -1) {
                            $this->text[$i] = $this->MATRIX[$row[1]][4] . "" . $this->text[$i][0];
                        } else {
                            $this->text[$i] = $this->MATRIX[$row[1]][($col[1] - 1)] . "" . $this->text[$i][0];
                        }
                    } else if ($row[1] == 5) {
                        if (($col[0] - 1) == -1) {
                            $this->text[$i] = $this->text[$i][1] . "" . $this->MATRIX[$row[0]][4];
                        } else {
                            $this->text[$i] = $this->text[$i][1] . "" . $this->MATRIX[$row[0]][($col[0] - 1)];
                        }
                    } else {
                        $this->text[$i] = $this->MATRIX[$row[0]][$col[1]] . "" . $this->MATRIX[$row[1]][$col[0]];
                    }
                } else {
                    if ($row[1] == $row[0]) {
                        if ($row[0] == 5) {
                            $this->text[$i] = $this->text[$i][1] . "" . $this->text[$i][0];
                        } else if (($col[0] - 1) == -1) {
                            $this->text[$i] = $this->MATRIX[$row[1]][($col[1] - 1)] . "" . $this->MATRIX[$row[0]][4];
                        } else if (($col[1] - 1) == -1) {
                            $this->text[$i] = $this->MATRIX[$row[1]][4] . "" . $this->MATRIX[$row[0]][($col[0] - 1)];
                        } else {
                            $this->text[$i] = $this->MATRIX[$row[1]][($col[1] - 1)] . "" . $this->MATRIX[$row[0]][($col[0] - 1)];
                        }
                    } else if ($col[1] == $col[0]) {
                        if (($row[0] - 1) == -1) {
                            $this->text[$i] = $this->MATRIX[($row[1] - 1)][$col[1]] . "" . $this->MATRIX[4][$col[0]];
                        } else if (($row[1] - 1) == -1) {
                            $this->text[$i] = $this->MATRIX[4][$col[1]] . "" . $this->MATRIX[($row[0] - 1)][$col[0]];
                        } else {
                            $this->text[$i] = $this->MATRIX[($row[1] - 1)][$col[1]] . "" . $this->MATRIX[($row[0] - 1)][$col[0]];
                        }
                    }
                }
            }
        }
        return implode($this->text) . $this->sR;
    }
}
