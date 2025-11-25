<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Units for Items & Services (BOQ, Requisition, Purchase, etc.)
    |--------------------------------------------------------------------------
    | Only practical units used daily on construction sites.
    | No fluff. Used by L&T, Tata Projects, Shapoorji, etc.
    */

    'item_units' => [
        // Most Used (Top 10)
        'nos'    => 'Numbers (nos)',
        'kg'     => 'Kilogram (kg)',
        'ton'    => 'Metric Ton (ton)',
        'cum'    => 'Cubic Meter (cum)',
        'sqm'    => 'Square Meter (sqm)',
        'sqft'   => 'Square Foot (sqft)',
        'm'      => 'Meter (m)',
        'rm'     => 'Running Meter (rm)',
        'rft'    => 'Running Foot (rft)',
        'liter'  => 'Liter (L)',

        // Secondary but common
        'bag'    => 'Bag (50 kg cement)',
        'pcs'    => 'Pieces (pcs)',
        'each'   => 'Each',
        'set'    => 'Set',
        'lot'    => 'Lot',
        'drum'   => 'Drum (200L)',
        'box'    => 'Box',
        'roll'   => 'Roll',
        'bundle' => 'Bundle',
        'pair'   => 'Pair',

        // Less common but needed
        'ft'     => 'Foot (ft)',
        'in'     => 'Inch (in)',
        'mm'     => 'Millimeter (mm)',
        'cm'     => 'Centimeter (cm)',
        'quintal'=> 'Quintal (100 kg)',
        'gm'     => 'Gram (gm)',
        'cuft'   => 'Cubic Foot (cuft)',
        'gallon' => 'Gallon (gal)',
        'day'    => 'Day (for labor/service)',
        'hour'   => 'Hour',
        'month'  => 'Month',
        'kw'     => 'Kilowatt (kW)',
        '%'      => 'Percentage (%)',
    ],

    // Grouped version — looks premium in dropdown
    'grouped' => [
        'Top Used' => ['nos','kg','ton','cum','sqm','sqft','m','rm','rft','liter'],
        'Packaging' => ['bag','pcs','each','set','lot','drum','box','roll','bundle','pair'],
        'Length'    => ['m','rm','rft','ft','in','mm','cm'],
        'Area'      => ['sqm','sqft'],
        'Volume'    => ['cum','cuft','liter','gallon'],
        'Weight'    => ['kg','ton','quintal','gm'],
        'Time'      => ['day','hour','month'],
        'Others'    => ['kw','%'],
    ],

];