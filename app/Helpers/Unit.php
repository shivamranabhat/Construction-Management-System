<?php

if (!function_exists('construction_units')) {
    /**
     * Return all standard construction units with proper labels
     * 
     * @param bool $withCategories Return with optgroups (for dropdowns)
     * @return array
     */
    function construction_units(bool $withCategories = false): array
    {
        $units = [
            // Length
            'm'     => 'Meter (m)',
            'cm'    => 'Centimeter (cm)',
            'mm'    => 'Millimeter (mm)',
            'ft'    => 'Foot (ft)',
            'in'    => 'Inch (in)',
            'km'    => 'Kilometer (km)',
            'rm'    => 'Running Meter (rm)',
            'rft'   => 'Running Foot (rft)',

            // Area
            'sqm'   => 'Square Meter (sqm)',
            'sqft'  => 'Square Foot (sqft)',
            'sqyd'  => 'Square Yard (sqyd)',
            'acre'  => 'Acre',
            'hectare' => 'Hectare',

            // Volume
            'cum'   => 'Cubic Meter (cum)',
            'cuft'  => 'Cubic Foot (cuft)',
            'liter' => 'Liter (L)',
            'gallon'=> 'Gallon (gal)',

            // Weight / Mass
            'kg'      => 'Kilogram (kg)',
            'ton'     => 'Metric Ton (ton)',
            'quintal' => 'Quintal (100 kg)',
            'gm'      => 'Gram (gm)',
            'lb'      => 'Pound (lb)',

            // Quantity / Count
            'nos'   => 'Numbers (nos)',
            'pcs'   => 'Pieces (pcs)',
            'each'  => 'Each',
            'set'   => 'Set',
            'lot'   => 'Lot',
            'pair'  => 'Pair',
            'box'   => 'Box',
            'roll'  => 'Roll',
            'bundle'=> 'Bundle',
            'bag'   => 'Bag (e.g., cement)',
            'drum'  => 'Drum (200L)',

            // Time
            'day'   => 'Day',
            'month' => 'Month',
            'hour'  => 'Hour',

            // Power & Electrical
            'kw'    => 'Kilowatt (kW)',
            'kva'   => 'Kilovolt-Ampere (kVA)',
            'hp'    => 'Horsepower (HP)',
            'watt'  => 'Watt (W)',

            // Others
            '%'     => 'Percentage (%)',
            'ratio' => 'Ratio',
        ];

        if (!$withCategories) {
            return $units;
        }

        // Return with categories (optgroup) for dropdowns
        return [
            'Length' => [
                'm'   => 'Meter (m)',
                'cm'  => 'Centimeter (cm)',
                'mm'  => 'Millimeter (mm)',
                'ft'  => 'Foot (ft)',
                'in'  => 'Inch (in)',
                'km'  => 'Kilometer (km)',
                'rm'  => 'Running Meter (rm)',
                'rft' => 'Running Foot (rft)',
            ],
            'Area' => [
                'sqm'   => 'Square Meter (sqm)',
                'sqft'  => 'Square Foot (sqft)',
                'sqyd'  => 'Square Yard (sqyd)',
                'acre'  => 'Acre',
                'hectare' => 'Hectare',
            ],
            'Volume' => [
                'cum'   => 'Cubic Meter (cum)',
                'cuft'  => 'Cubic Foot (cuft)',
                'liter' => 'Liter (L)',
                'gallon'=> 'Gallon (gal)',
            ],
            'Weight' => [
                'kg'      => 'Kilogram (kg)',
                'ton'     => 'Metric Ton (ton)',
                'quintal' => 'Quintal (100 kg)',
                'gm'      => 'Gram (gm)',
                'lb'      => 'Pound (lb)',
            ],
            'Quantity' => [
                'nos'   => 'Numbers (nos)',
                'pcs'   => 'Pieces (pcs)',
                'each'  => 'Each',
                'set'   => 'Set',
                'lot'   => 'Lot',
                'pair'  => 'Pair',
                'box'   => 'Box',
                'roll'  => 'Roll',
                'bundle'=> 'Bundle',
                'bag'   => 'Bag',
                'drum'  => 'Drum',
            ],
            'Time' => [
                'day'   => 'Day',
                'month' => 'Month',
                'hour'  => 'Hour',
            ],
            'Power' => [
                'kw'   => 'Kilowatt (kW)',
                'kva'  => 'Kilovolt-Ampere (kVA)',
                'hp'   => 'Horsepower (HP)',
                'watt' => 'Watt (W)',
            ],
            'Others' => [
                '%'     => 'Percentage (%)',
                'ratio' => 'Ratio',
            ],
        ];
    }
}