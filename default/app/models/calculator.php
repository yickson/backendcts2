<?php


class Calculator
{
    /**
     * @param $a
     * @param $b
     * @return number
     */
    public function sum($a, $b)
    {
        return array_sum(func_get_args());
    }

    /**
     * @param $a
     * @param $b
     * @return mixed
     */
    public function substract($a, $b)
    {
        return $a - $b;
    }

    /**
     * @param $a
     * @param $b
     * @return mixed
     */
    public function multiply($a, $b)
    {
        return $a * $b;
    }

    /**
     * @param $a
     * @param $b
     * @return float
     */
    public function divide($a, $b)
    {
        return $a / $b;
    }

    /**
     * @param $a
     * @param $b
     * @return number
     */
    public function pow($a, $b)
    {
        return pow($a, $b);
    }
}
