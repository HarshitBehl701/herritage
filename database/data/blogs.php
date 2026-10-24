<?php

// Blog source data. Each article has an opening, h3 sections, a list and a brand closing.

$meta = function (string $title, string $description, string $keywords): array {
    return [
        'title' => $title,
        'description' => $description,
        'keywords' => $keywords,
    ];
};

$blogs = [
    [
        'title' => 'Understanding RO SMPS Cabinets',
        'slug' => 'understanding-ro-smps-cabinets',
        'image' => 'blogs/understanding-ro-smps-cabinets.webp',
        'source_image' => '01.png',
        'description' => 'Learn how an RO SMPS cabinet houses the power supply board in a water purifier and what to check before choosing a housing.',
        'sections' => [
            [
                'heading' => 'What an RO SMPS cabinet does',
                'body' => 'An RO SMPS cabinet holds the power supply board used by a reverse osmosis water purifier. The moulded body keeps the board, transformer and output wiring together, so the assembly can be fitted and serviced as one unit. A close-fitting lid protects the board from dust and accidental contact while the purifier is in use.',
                'list' => [],
            ],
            [
                'heading' => 'Checks before choosing a cabinet',
                'body' => 'Start with the board length, width and component height, then look at the direction the input and output leads leave the board. The cabinet opening should line up with that route, and the lid should close without pressing on a connector. A compact dibbi suits a short board, while a 24 volt cabinet gives more room for a transformer.',
                'list' => [
                    'Measure the board footprint and the tallest component.',
                    'Check the lead direction and the connector position.',
                    'Confirm that the lid closes without pressure.',
                    'Match the cabinet opening to the cable route.',
                ],
            ],
            [
                'heading' => 'Keeping the assembly serviceable',
                'body' => 'A screw-fixed lid allows a technician to open the cabinet when a board has to be replaced. Tidy lead routing inside the cabinet reduces strain at the terminals and makes a fault easier to trace. The same housing option should be used for a repeat build so the assembly routine stays consistent. Herritage Moulds lists the available RO housings in the <a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a> range, where the dibbi, 24 volt cabinets and larger enclosures can be compared before an order.',
                'list' => [],
            ],
        ],
        'meta' => $meta(
            'Understanding RO SMPS Cabinets',
            'Learn how an RO SMPS cabinet protects a water purifier power supply board and what to check before selecting a moulded enclosure.',
            'RO SMPS cabinet guide, RO SMPS enclosure, water purifier power supply cabinet, moulded RO cabinet, RO SMPS box'
        ),
    ],
    [
        'title' => 'A Guide to Agricultural Charger Cabinets',
        'slug' => 'guide-to-agricultural-charger-cabinets',
        'image' => 'blogs/guide-to-agricultural-charger-cabinets.webp',
        'source_image' => '02.png',
        'description' => 'Understand how agricultural charger cabinets protect a charger board and transformer during field use, transport and service.',
        'sections' => [
            [
                'heading' => 'Why the cabinet matters in the field',
                'body' => 'An agricultural charger is carried to a work point and used in dusty conditions. The cabinet has to hold the board and transformer securely and close firmly, so the internal connections are not disturbed by movement. A moulded body also keeps the user away from exposed terminals.',
                'list' => [],
            ],
            [
                'heading' => 'Matching the profile to the assembly',
                'body' => 'Jhatka, Nexon and round profiles are used in agricultural charger builds. The profile should match the board and transformer that go inside, not just the look of the finished unit. Check the transformer height and the direction of the input and output leads before selecting a cabinet.',
                'list' => [
                    'Compare the Jhatka, Nexon and round outlines.',
                    'Measure the transformer height and board width.',
                    'Check the two output leads on a Nexon build.',
                    'Confirm the lid clears the tallest component.',
                ],
            ],
            [
                'heading' => 'Planning repeat supply',
                'body' => 'A stable moulded shape helps an assembly unit repeat the same build without adjusting the housing. Packing and dispatch should be agreed against the monthly quantity, and a repeat order should follow the earlier cabinet option so the fit stays the same. Herritage Moulds sets out the Jhatka, Nexon and round cabinets in the <a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a> range for a side-by-side comparison.',
                'list' => [],
            ],
        ],
        'meta' => $meta(
            'Guide to Agricultural Charger Cabinets',
            'A practical guide to agricultural charger cabinets, including Jhatka, Nexon and round profiles, board fit and field protection.',
            'agricultural charger cabinet guide, Jhatka charger cabinet, Nexon charger cabinet, round charger cabinet, charger enclosure'
        ),
    ],
    [
        'title' => 'Choosing a CCTV Channel SMPS Cabinet',
        'slug' => 'choosing-a-cctv-channel-smps-cabinet',
        'image' => 'blogs/choosing-a-cctv-channel-smps-cabinet.webp',
        'source_image' => '03.png',
        'description' => 'Compare 4 channel and 8 channel CCTV SMPS cabinets and the details that keep a surveillance power supply tidy and serviceable.',
        'sections' => [
            [
                'heading' => 'Start with the channel count',
                'body' => 'A CCTV power supply cabinet is selected by the number of outputs it has to serve. A 4 channel cabinet suits a four-output board, while an 8 channel cabinet gives room for an eight-output board and its leads. The board dimensions should be checked even when the channel count matches.',
                'list' => [],
            ],
            [
                'heading' => 'Cable routing at the recorder',
                'body' => 'Camera leads and the supply cable should leave the cabinet through planned openings. Keeping the routes separate reduces strain at the terminals and makes it easier to trace a faulty channel. The cabinet should sit close enough to the recorder to avoid a long, loose cable run.',
                'list' => [
                    'Keep the supply cable away from the camera leads.',
                    'Check the opening size against the cable bundle.',
                    'Leave room to trace a single channel at service.',
                    'Place the cabinet close to the recorder.',
                ],
            ],
            [
                'heading' => 'Service and repeat supply',
                'body' => 'A screw-fixed lid gives access to the board and terminals when a channel has to be checked. For an installer or assembly unit, a repeat order should use the same cabinet option and packing so the next unit is prepared in the same way. Herritage Moulds compares the four and eight channel options in the <a href="/category/cctv-channel-smps">CCTV Channel SMPS</a> range.',
                'list' => [],
            ],
        ],
        'meta' => $meta(
            'Choosing a CCTV Channel SMPS Cabinet',
            'Compare 4 channel and 8 channel CCTV SMPS cabinets and learn how cable routing and board fit affect a surveillance power supply.',
            'CCTV channel SMPS cabinet, 4 channel CCTV power supply, 8 channel CCTV SMPS, CCTV SMPS enclosure, CCTV power supply box'
        ),
    ],
    [
        'title' => 'Curved Screw Box and Lockable Cabinet Options',
        'slug' => 'curved-screw-box-and-lockable-cabinet-options',
        'image' => 'blogs/curved-screw-box-and-lockable-cabinet-options.webp',
        'source_image' => '04.png',
        'description' => 'See how curved screw box and lockable regular cabinets differ in profile, access and the assemblies they suit.',
        'sections' => [
            [
                'heading' => 'Two profiles for adapter assemblies',
                'body' => 'The Screw Box Curve Line gives a curved profile with a screw-fixed lid, while the Lock Regular Cabinet uses a regular shape with a locking arrangement. Both are moulded housings for small adapter and component assemblies, and the choice follows the look and access need of the finished product.',
                'list' => [],
            ],
            [
                'heading' => 'Board fit and lead exit',
                'body' => 'A compact adapter board needs a flat base and enough height for the tallest component. The output lead should leave through an opening that lines up with the connector, so the cable does not press against the lid. Check these details before choosing between the two profiles.',
                'list' => [
                    'Measure the adapter board and the tallest part.',
                    'Check the output lead direction.',
                    'Confirm the lid closes without pressure.',
                    'Decide whether the unit needs a keyed lid.',
                ],
            ],
            [
                'heading' => 'When a locking arrangement helps',
                'body' => 'A lockable cabinet suits a unit that should not be opened without a key, while a screw-fixed lid is quicker for routine service. The decision should follow the way the finished product is used, stored and maintained rather than the cabinet cost alone. Herritage Moulds presents both styles in the <a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a> range, with the curved screw box and lockable regular cabinet described side by side.',
                'list' => [],
            ],
        ],
        'meta' => $meta(
            'Curved Screw Box and Lockable Cabinets',
            'Compare curved screw box and lockable regular cabinets for adapter assemblies, including profile, access and cable routing.',
            'curved screw box cabinet, lockable regular cabinet, adapter cabinet, moulded component housing, screw box enclosure'
        ),
    ],
];

return $blogs;
