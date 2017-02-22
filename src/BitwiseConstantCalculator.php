<?php

namespace GisoStallenberg\BitwiseConstantCalculator;

/**
 * Does calculations on strings representing a bitwise setting value.
 *
 * @author Giso Stallenberg
 */
class BitwiseConstantCalculator
{
    /**
     * Creates a class instance.
     *
     * @return \static
     */
    public static function create()
    {
        return new static();
    }

    /**
     * Perform the calculation.
     *
     * @param string $string
     *
     * @return int
     */
    public function calculate($string)
    {
        $parts = array_map(
            'trim',
            preg_split('/([\&\|\^]+)/', $string, -1, PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE)
        );

        $result = 0;
        $operator = false;
        foreach ($parts as $part) {
            if ($this->isOperator($part)) {
                $operator = $part;
                continue;
            }
            if ($operator === false) {
                $result += $this->getConstantValue($part);
                continue;
            }

            $value = $this->getConstantValue($part);
            $this->bitwiseOperation($value, $operator, $result);
        }

        return $result;
    }

    /**
     * Perform the bitwise operation.
     *
     * @param int    $value
     * @param string $operation
     * @param int    $base
     */
    private function bitwiseOperation($value, $operation, &$base)
    {
        switch ($operation) {
            case '&':
                $base &= $value;
                break;
            case '|':
                $base |= $value;
                break;
            case '^':
                $base ^= $value;
                break;
        }
    }

    /**
     * Tells when the given string is one of the accepted operators.
     *
     * @param string $string
     *
     * @return bool
     */
    private function isOperator($string)
    {
        return in_array($string, ['&', '|', '^']);
    }

    /**
     * Gives the value of the constant.
     *
     * @param string $string
     *
     * @return int
     */
    private function getConstantValue($string)
    {
        if (strpos($string, '~') === 0) {
            return ~constant(trim(substr($string, 1)));
        }

        return constant($string);
    }
}
