# Bitwise Constant Calculator
Calculates the value of bitwise operations on a list of constants

## Installation
```bash
composer require gisostallenberg/bitwise-constant-calculator
```

## Usage examples
```php

$result = BitwiseConstantCalculator::create()
            ->calculate("E_ALL | E_STRICT");
($result === E_ALL | E_STRICT); // true
```