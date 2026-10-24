<?php

// Category source data. Copy is written per record so no sentence is reused.

$para = fn (string ...$paragraphs): string => implode('', array_map(
    fn (string $paragraph): string => '<p>' . $paragraph . '</p>',
    $paragraphs
));

$block = function (string $intro, array $points, string $closing): string {
    $html = '<p>' . $intro . '</p><ul>';
    foreach ($points as $heading => $explanation) {
        $html .= '<li><p><strong>' . $heading . '</strong> : ' . $explanation . '</p></li>';
    }

    return $html . '</ul><p>' . $closing . '</p>';
};

$faq = fn (string $question, string $answer): array => [
    'question' => $question,
    'answer' => $answer,
];

$meta = function (string $name, string $title, string $description): array {
    $keywords = $name . ' in {location}, '
        . 'top rated ' . $name . ' manufacturers in {location}, '
        . 'top rated ' . $name . ' suppliers in {location}, '
        . 'best ' . $name . ' in {location}, '
        . 'best ' . $name . ' manufacturers in {location}, '
        . 'best ' . $name . ' suppliers in {location}, '
        . $name . ' manufacturers in {location}, '
        . $name . ' suppliers in {location}, '
        . $name . ' traders';

    return [
        'title' => $title,
        'description' => $description,
        'keywords' => $keywords,
    ];
};

$categories = [
    [
        'title' => 'RO SMPS Cabinet',
        'slug' => 'ro-smps-cabinet',
        'image' => 'categories/ro-smps-cabinet.webp',
        'sub_name' => 'RO Power Supply Cabinets',
        'description' => $para(
            'RO SMPS Cabinet is the umbrella listing at Herritage Moulds for the moulded shells that carry a reverse osmosis power supply board on a purifier line. Planners who weigh <strong>top rated RO SMPS Cabinet manufacturers</strong> against <strong>best RO SMPS Cabinet suppliers</strong> can use the page as a shortlist, because every shell beneath it answers a different seating problem. The choice is rarely about outside size; it turns on how an assembled board rests, how the cover clears the tallest part and where the output cable leaves the body.',
            '<strong>How does an assembler narrow five shells down to one?</strong> Begin with the board as it will be assembled, record the tallest part and mark the side that carries the terminals. Lay the board on the bench and follow the output lead with a finger: if the cable has to bend sharply to meet an opening, that shell is wrong for the job. <strong><a href="/product/ro-smps-dibbi">RO SMPS Dibbi</a></strong> and <strong><a href="/product/24-volt-3-amp-cabinet">24 Volt 3 Amp Cabinet</a></strong> sit at opposite ends of that test, and the distance between them explains why a shortlist beats a single sample.',
            '<strong>Why do repeat purifier batches drift after a few lots?</strong> Often because the housing is re-ordered from a picture instead of a note, so a new consignment arrives with a slightly different seat or cable exit. Pairing the board outline with the shell reference on one sheet keeps the next purchase tied to the fit that already worked. <strong><a href="/product/advance-enclosure-solution">Advance Enclosure Solution</a></strong> rewards that discipline most, since its larger interior is the hardest one to recreate from memory.',
            'Taken together, the page works as a decision sheet for purifier production rather than a catalogue of boxes. Buyers who check <strong>top rated RO SMPS Cabinet manufacturers</strong> and <strong>best RO SMPS Cabinet suppliers</strong> should ask for the seat, the lid clearance and the cable exit in writing, then place the order against those three answers. A range documented that way lets a service replacement and a fresh batch land in the same assembly routine.'
        ),
        'content' => [
            'sub_name' => 'RO Power Supply Cabinets',
            'highlights' => [
                'reverse osmosis supply board',
                'assembled board outline',
                'lid clearance above the transformer',
                'repeat purifier batch',
                'output cable exit position',
            ],
            'features' => $block(
                'The RO SMPS Cabinet page is organised around the three measurements that decide whether a shell suits a purifier build: board seating, clearance over the transformer and the line the output cable follows to its opening. Anyone weighing <strong>top rated RO SMPS Cabinet manufacturers</strong> with <strong>best RO SMPS Cabinet suppliers</strong> gets further by testing those points on a sample than by reading a size table. The five notes below explain what each measurement changes at the bench.',
                [
                    'Board seating on the base' => 'An assembled board should rest on its own standoffs without rocking, so the shell is checked with the transformer fitted rather than with an empty PCB.',
                    'Lid clearance over the transformer' => 'The tallest part needs a visible gap under the cover, because a lid that touches the transformer passes pressure to the solder joints when the screws are tightened.',
                    'Cable exit aligned to the terminal' => 'The output lead should run straight from the terminal to the opening, with enough slack to absorb movement without curling back across the board.',
                    'Shell chosen from the batch plan' => 'A model that repeats across a season is worth more than a tight one-off fit, so the shortlist starts with the variants already used on the line.',
                    'Reference kept with the drawing' => 'The shell code, board outline and opening position belong on one sheet, which removes guesswork when a purchase assistant reorders.',
                ],
                'A shortlist only helps when the evidence travels with it. Herritage Moulds records the shell, lid and opening against the board details a buyer supplies, so the next conversation starts from the same sheet. Anyone comparing <strong>top rated RO SMPS Cabinet manufacturers</strong> with <strong>best RO SMPS Cabinet suppliers</strong> can then reorder from that sheet, and can see the individual RO housings side by side once the three measurements are known.'
            ),
            'why_choose_us' => $block(
                'Choosing among shells for a water purifier is a purchasing decision and a production decision at once, because the person who closes the lid on the line inherits whatever was agreed at the desk. The range is presented so that <strong>top rated RO SMPS Cabinet manufacturers</strong> and <strong>best RO SMPS Cabinet suppliers</strong> can be judged on the same handful of facts instead of a size guessing game. Each point below is a step that happens before dispatch.',
                [
                    'Board drawing read first' => 'The team asks for the assembled outline, the tallest part and the connector edges before naming a shell, so the first answer is already close.',
                    'Sample agreed before the lot' => 'A first-off check on the buyer\'s own board settles seating and lid clearance while a change is still inexpensive.',
                    'Batch continuity protected' => 'The same moulded shape is held for repeat orders, which spares the line a fresh fitting routine every quarter.',
                    'Packing planned with dispatch' => 'Carton counts and cushioning are settled with the delivery point, so shells arrive ready to issue rather than to repack.',
                    'One thread for the order' => 'Selection, packing and paperwork stay with a single contact, which shortens the gap between a question and a written answer.',
                ],
                'None of this replaces a physical check, and it is not meant to. It simply puts the board, the lid and the cable route into one conversation before money is committed. A buyer who expects <strong>top rated RO SMPS Cabinet manufacturers</strong> and <strong>best RO SMPS Cabinet suppliers</strong> to behave predictably across a year should judge them on that paperwork as much as on the first sample.'
            ),
            'applications' => $block(
                'The applications block is the practical side of the RO SMPS Cabinet page: it shows where each shell earns its place once the board has been chosen. A purifier fitted into a kitchen cabinet, a service unit swapped at a customer\'s home and a distributor shelf all ask something slightly different from a housing. The notes below follow those situations in turn.',
                [
                    'Kitchen purifier installation' => 'A wall-mounted purifier needs a shell whose cable exit points towards the existing supply, so the fit is checked against the mounting gap and not the bench.',
                    'Service swap at a home' => 'A technician carrying one familiar shell can replace a damaged body without rerouting the customer\'s supply cable or disturbing the plumbing.',
                    'Distributor shelf stock' => 'A dealer who holds two or three variants covers most repair calls without promising a shell that still has to be ordered.',
                    'New purifier model trial' => 'A first build uses a sample shell to prove the board seat before tooling and purchase quantities are fixed.',
                    'Bulk consignment planning' => 'A large buyer groups shells by model so the carton plan follows the assembly sequence at the receiving unit.',
                ],
                'Each situation begins with a board and ends with a dispatch note, which is why the range is presented as a set rather than one universal box. Herritage Moulds confirms the shell, opening and packing against the details supplied, so a service swap and a production order can follow the same reference. The individual housing pages carry the measurements that the choice depends on.'
            ),
            'contact_us' => '<p>Share the assembled board outline, the tallest component and the quantity you expect each month with <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>, and the Herritage Moulds team will reply with the closest RO SMPS Cabinet option. The answer names the shell, the lid type and the packing plan, which gives a purifier line a written basis for its next purchase order.</p>',
        ],
        'faqs' => [
            $faq('Which purifier assemblies does the RO SMPS Cabinet range cover?', 'The range covers compact purifier boards through to larger supplies that need room for a taller transformer and several connectors. Selection starts from the assembled board and the space behind the purifier, not from the model name alone.'),
            $faq('How are RO SMPS Cabinet shells packed for a bulk order?', 'Shells are counted by model and cushioned so lids are not pressed against one another in the carton. The packing plan is agreed with the quantity and the receiving unit before dispatch, and the carton marking follows the assembly sequence.'),
            $faq('Can the cable opening be positioned for a new board layout?', 'An entry can be moved for a new connector position where the mould permits, and the revision is proven on a first-off before the lot runs. A change that would demand new tooling is stated at that point instead of after the purchase is confirmed.'),
            $faq('How is a moulded RO shell checked before dispatch?', 'The shell, cover and opening are compared with the board particulars held on file, and the seal is tried with the buyer\'s own assembly where one can be sent. Material and finish are named in the quotation, and a first-off check is the usual proof of a change.'),
            $faq('What details should go with an RO SMPS Cabinet price request?', 'Send the assembled board outline, the tallest part and the monthly draw to herritagemoulds@gmail.com, and Herritage Moulds will return a shell recommendation with a written price. The reply also names the lid type and the packing plan.'),
        ],
        'meta' => $meta(
            'RO SMPS Cabinet',
            'RO SMPS Cabinet Range for Purifier Boards',
            'Compare moulded RO SMPS cabinets by board seat, lid clearance and cable exit. Herritage Moulds supplies purifier housings in several sizes.'
        ),
        'seo' => true,
        'featured' => true,
    ],
    [
        'title' => 'Agricultural Charger Cabinet',
        'slug' => 'agricultural-charger-cabinet',
        'image' => 'categories/agricultural-charger-cabinet.webp',
        'sub_name' => 'Agricultural Charger Enclosures',
        'description' => $para(
            'An Agricultural Charger Cabinet moves between a farm store, a field edge and a dealer counter, so the shell has to survive handling as well as hold a charger board. Farmers and traders who compare <strong>top rated Agricultural Charger Cabinet manufacturers</strong> with <strong>best Agricultural Charger Cabinet suppliers</strong> tend to care about the same few things: a lid that stays shut, a transformer with room to breathe and a shape the customer recognises. This page gathers the profiles used in that work.',
            '<strong>What makes a charger shell last through a dusty season?</strong> The answer is less about thick plastic than about a cover that seats along its full rim and cable entries that close around the lead instead of leaving a slot. Dust travels through gaps and open screw holes, so a lid that sits flat after repeated opening protects the board better than a heavier body with a poor seam. A quick check after the charger has run warm shows whether the cover still settles down properly.',
            '<strong>Why do dealers ask for the same outline again?</strong> A farmer who has used one charger for two seasons identifies the replacement by shape, and a different silhouette raises doubt about whether the unit is the same product. Holding the Jhatka, Nexon or round outline also means an existing storage spot still works. <strong><a href="/product/agriculture-round">Agriculture Round</a></strong> and <strong><a href="/product/agriculture-2no-nexon">Agriculture 2No Nexon</a></strong> are the two profiles where recognition matters most, because the curve and the twin lead exit are visible from a short distance.',
            'The range is therefore a small, practical set rather than a long catalogue, and its worth lies in matching a charger build to a profile a farm customer will accept. Buyers who assess <strong>top rated Agricultural Charger Cabinet manufacturers</strong> alongside <strong>best Agricultural Charger Cabinet suppliers</strong> should confirm the profile, the clearance above the transformer and the carton plan before the season order is placed. Settling those three points early stops a replacement charger from looking like a new product to the farmer.'
        ),
        'content' => [
            'sub_name' => 'Agricultural Charger Enclosures',
            'highlights' => [
                'dust-resistant lid seam',
                'transformer clearance inside the body',
                'twin output lead exits',
                'seasonal charger consignment',
                'recognisable charger outline',
            ],
            'features' => $block(
                'Field use stresses parts that a bench test never touches, so the Agricultural Charger Cabinet is judged on its rim, the space above the transformer, the exits for two leads and the strength of the corners. A profile that survives a season is usually the one with the plainest closure rather than the most elaborate shape. A trader sorting <strong>top rated Agricultural Charger Cabinet manufacturers</strong> from <strong>best Agricultural Charger Cabinet suppliers</strong> will learn more from a sample than from a rate card.',
                [
                    'Lid seam against field dust' => 'A cover that rests evenly on its rim keeps the fine dust of a threshing floor out of the board area, while a warped lid leaves a gap along one side.',
                    'Warm transformer given room' => 'A charger run for an hour warms its transformer, and a visible gap under the lid stops the cover from holding that heat against the winding.',
                    'Separate exits for two leads' => 'Where a charger feeds two lead sets, distinct entries prevent the cables rubbing and let a dealer trace one run without freeing the other.',
                    'Corner strength under handling' => 'The body is lifted, set down and occasionally dropped, so the profile needs enough material at the corners to take that without cracking.',
                    'Profile matched to the market' => 'Jhatka, Nexon and round outlines are used in different builds, so the outside shape is agreed before the internal layout is finalised.',
                ],
                'A sample settles most of these questions faster than a drawing, and it is the cheapest way to test a rim or a corner before a season order. Herritage Moulds reviews the charger assembly, the transformer and the lead positions against the chosen profile, then sets packing with the delivery point. A first-off unit sent to the dealer answers more than a catalogue page, and the profiles from <strong>top rated Agricultural Charger Cabinet manufacturers</strong> and <strong>best Agricultural Charger Cabinet suppliers</strong> can be compared on that unit before the carton plan is settled.'
            ),
            'why_choose_us' => $block(
                'Seasonal buying leaves little room for a late surprise, because a charger that arrives after the sowing rush has missed its market. The team therefore treats <strong>top rated Agricultural Charger Cabinet manufacturers</strong> and <strong>best Agricultural Charger Cabinet suppliers</strong> as promises about a date and a shape, not only about a rate. Each step below happens before the cartons are closed.',
                [
                    'Profile agreed from a sample' => 'The buyer sees the actual outline and lid before the order, so a dealer knows what the farmer will unwrap.',
                    'Board and transformer mapped' => 'Internal space is checked against the real charger assembly, not against a nominal figure copied from an old invoice.',
                    'Season timing worked backwards' => 'Production and dispatch are planned from the selling window, so the consignment is not left to the final week before demand.',
                    'Cartons braced for the road' => 'Rural transport is rough, so packing is discussed with the route and the quantity in view instead of left to a default carton.',
                    'Replacement outline held' => 'A repeat order stays on the same profile, which keeps a dealer\'s promise of a matching replacement credible.',
                ],
                'A date and a shape are simple promises, and they are the two a seasonal buyer remembers after the rush. Herritage Moulds puts both into the quotation, so buyers judging <strong>top rated Agricultural Charger Cabinet manufacturers</strong> and <strong>best Agricultural Charger Cabinet suppliers</strong> can compare delivery as well as the sample. The range pages show which profile each charger build should follow.'
            ),
            'applications' => $block(
                'An agricultural charger is used wherever a farmer needs a lead to reach a pump, a sprayer or a lighting set, so the cabinet has to suit a working routine rather than a showroom shelf. The situations below follow the charger from assembly to the field and back to a dealer counter. Each one asks a different question of the profile and the lid.',
                [
                    'Irrigation pump charging' => 'A charger taken to a pump house needs a body that can be set on damp ground without the lid springing open.',
                    'Sprayer battery top-up' => 'A short charging session between sprays suits a compact profile that a farmer can carry in one hand along the rows.',
                    'Dealer replacement counter' => 'A shop that swaps a failed charger needs the same outline in stock, so the farmer keeps the unit he already knows.',
                    'Seasonal bulk supply' => 'A distributor buying before the season needs cartons that stack neatly and open in sequence at the counter.',
                    'Repair bench servicing' => 'A technician opening the lid repeatedly needs screw points that still hold firmly after several services.',
                ],
                'From a pump house to a repair bench, the same shell is asked to close firmly and open easily, which is why the profile and the lid are settled together. Herritage Moulds confirms the charger assembly, the outline and the carton plan with the buyer before dispatch. The agricultural housing pages show the shapes that fit each of these routines.'
            ),
            'contact_us' => '<p>Send the charger assembly, the transformer height and the quantity needed for the coming season to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a> for an Agricultural Charger Cabinet discussion. Herritage Moulds replies with the profile that matches the build, the packing arrangement and a dispatch window, which gives a dealer something firm to promise a farmer.</p>',
        ],
        'faqs' => [
            $faq('Which charger builds use an Agricultural Charger Cabinet?', 'The range covers single-lead field chargers, twin-output units and circular profiles used on farm equipment. The build decides the outline, while the transformer and lead routes decide the internal space.'),
            $faq('How is a seasonal Agricultural Charger Cabinet order scheduled?', 'The selling window is agreed first, then production and transport are planned backwards from it. Quantities are split where a dealer needs stock in two stages, and the carton marking follows the counter sequence.'),
            $faq('Would a new board force a change to the outside shape?', 'A new board is reviewed inside the existing outline first, because the profile often carries more value than a small internal gain. Where a revision is possible, it is proven on a sample before the season order.'),
            $faq('What is checked on the lid and body before packing?', 'Each cover is tried on its rim, the screw points are operated and the corners are inspected for moulding faults. Material and finish are confirmed with the quotation, and the carton is tested with the stacking pattern a dealer will use.'),
            $faq('Who do I contact for an Agricultural Charger Cabinet price?', 'herritagemoulds@gmail.com is the address for a charger cabinet quote; include the profile, the number of leads and the season quantity. Herritage Moulds can then answer with packing detail and a delivery window as well as a rate.'),
        ],
        'meta' => $meta(
            'Agricultural Charger Cabinet',
            'Agricultural Charger Cabinet for Field Use',
            'Agricultural charger cabinets for field use, with dust-resistant lids and transformer clearance. Compare Jhatka, Nexon and round profiles.'
        ),
        'seo' => true,
        'featured' => true,
    ],
    [
        'title' => 'CCTV Channel SMPS',
        'slug' => 'cctv-channel-smps',
        'image' => 'categories/cctv-channel-smps.webp',
        'sub_name' => 'CCTV Power Supply Cabinets',
        'description' => $para(
            'A CCTV Channel SMPS cabinet is chosen on site as much as in the office, because the installer who lands eight camera cores remembers whether the terminal bank was reachable. Technicians comparing <strong>top rated CCTV Channel SMPS manufacturers</strong> with <strong>best CCTV Channel SMPS suppliers</strong> want a body that keeps the supply board covered while leaving the terminals and the camera leads workable. This page treats the cabinet as part of the wiring plan rather than a box added at the end of the job.',
            '<strong>How many channels should the cabinet be sized for?</strong> Size it for the board and the terminal row that will actually be fitted, not only for the number of cameras on the drawing. A four-output board with a long terminal block can need more room than a short eight-output board, and the camera bundle leaving the lid needs clearance of its own. Count the leads, then look at how they will leave the body before weighing <strong><a href="/product/cctv-4-channel-smps">CCTV 4 Channel SMPS</a></strong> against the eight-way cabinet.',
            '<strong>What helps an installer trace a fault after handover?</strong> A cabinet that opens across the whole terminal row lets a technician check one channel with the supply still fixed to the wall. Keeping each camera lead on its own path from terminal to entry, grouped by the direction it leaves the building, turns a tangle into a map. <strong><a href="/product/cctv-8-channel-smps">CCTV 8 Channel SMPS</a></strong> gains most from that discipline, since its bundle is the thicker of the two.',
            'For a surveillance job the housing proves itself at commissioning and again at the first service call, long after the price has been forgotten. Project teams weighing <strong>top rated CCTV Channel SMPS manufacturers</strong> and <strong>best CCTV Channel SMPS suppliers</strong> should request the terminal drawing, the entry positions and the consignment plan with the quote. A cabinet specified that way keeps a camera supply serviceable for the life of the site.'
        ),
        'content' => [
            'sub_name' => 'CCTV Power Supply Cabinets',
            'highlights' => [
                'terminal bank driver access',
                'camera lead entry position',
                'mains and camera run separation',
                'multi-site consignment packing',
                'channel identification at service',
            ],
            'features' => $block(
                'The terminal bank is where an installer spends time and where a later fault is found, so the CCTV Channel SMPS page begins there rather than with the outside finish. Driver access, lead separation and the position of the entries decide more about a camera supply than the colour of the lid. A firm comparing <strong>top rated CCTV Channel SMPS manufacturers</strong> with <strong>best CCTV Channel SMPS suppliers</strong> can ask for those three details on a sample before the first carton is opened.',
                [
                    'Terminal bank within reach' => 'Each screw should accept a driver from above or the side without the rim blocking the turn, which counts when the supply is already on a wall.',
                    'One path per camera lead' => 'A separate route from terminal to entry lets a technician lift one core without disturbing the seven beside it.',
                    'Supply and camera runs apart' => 'The mains entry and the camera bundle should not share a narrow slot, so a fault on one side is less likely to reach the other.',
                    'Channel marking kept visible' => 'A numbered or labelled row saves a return visit when the next installer cannot tell which core serves which camera.',
                    'Lid opening over the row' => 'A cover that clears the whole terminal bank allows a check without taking the cabinet off its fixing.',
                ],
                'None of these points adds cost to a moulded body, yet each one decides how long a site takes to commission. Herritage Moulds checks the board, the terminal row and the lead entries against the installation described by the buyer, and confirms the carton plan for the consignment. Installers judging <strong>top rated CCTV Channel SMPS manufacturers</strong> and <strong>best CCTV Channel SMPS suppliers</strong> should confirm the entries before the order, because a terminal that cannot be reached slows every service visit.'
            ),
            'why_choose_us' => $block(
                'Surveillance work is usually priced per site, so a cabinet that saves an hour at commissioning is worth more than a small saving on the unit. That is why <strong>top rated CCTV Channel SMPS manufacturers</strong> and <strong>best CCTV Channel SMPS suppliers</strong> are compared on the information they supply before the sale. Each point below is a question an installer can put to any supplier.',
                [
                    'Layout shared before dispatch' => 'The terminal arrangement and entry positions are confirmed against the board, so the installer knows the interior before opening the carton.',
                    'First unit checked on site' => 'The first cabinet is tried with the real camera cores landed, which exposes a tight entry while the batch is still open.',
                    'Repeat layout across buildings' => 'A multi-site buyer keeps the same interior, so a technician moving between buildings finds a familiar terminal order.',
                    'Consignment grouped by site' => 'Cartons are arranged to match the buildings on the schedule, which cuts sorting at the gate and at the store.',
                    'Answers fixed in the offer' => 'Entry size, terminal spacing and packing are written into the quotation, so nothing depends on a phone call remembered later.',
                ],
                'A site buyer who compares <strong>top rated CCTV Channel SMPS manufacturers</strong> with <strong>best CCTV Channel SMPS suppliers</strong> is really comparing how much each explains before the sale. Herritage Moulds puts the interior detail and the packing plan into the written offer, which gives the installer something concrete to check on arrival. The channel pages carry the layout for each output count.'
            ),
            'applications' => $block(
                'Camera supplies are installed in shops, offices, schools and along compound walls, and the cabinet has to suit the place as well as the board. The situations below show where the channel count and the cable route change the choice. Each assumes the supply is fixed within reach of the recorder it serves.',
                [
                    'Shop counter installation' => 'A small retail site needs a compact body that can sit above a counter without blocking access to the recorder.',
                    'Office ceiling void' => 'A supply fixed in a ceiling void needs entries that keep camera leads tidy in a place nobody opens often.',
                    'School corridor run' => 'A long run from several corridors rewards a cabinet whose entries face the direction the bundle actually travels.',
                    'Factory gate coverage' => 'An outdoor camera group needs a body placed where the leads can be inspected without moving the supply.',
                    'Site upgrade to eight' => 'A site planning extra cameras later benefits from choosing the larger terminal bank at the first installation.',
                ],
                'Each setting changes the entry direction more than the electronics, which is why the cabinet is chosen with the cable route on the table. Herritage Moulds confirms the board, the entries and the fixing position with the installer before dispatch. The channel pages show the terminal space available in each size.'
            ),
            'contact_us' => '<p>Send the board, the number of camera outputs and the fixing position to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a> for a CCTV Channel SMPS recommendation. The Herritage Moulds reply sets out the terminal space, the lead entries and the carton arrangement, which gives an installer a wiring plan that can be checked before the unit reaches the wall.</p>',
        ],
        'faqs' => [
            $faq('Which kinds of premises need a channel power supply?', 'Small retail counters, offices, schools, workshops and boundary camera groups all use one where the supply sits near the recorder. The premises decide the fixing position and entry direction more than the board does.'),
            $faq('Can a CCTV Channel SMPS order be delivered in stages?', 'A staged delivery is planned against the building schedule, with each carton group marked for its site. Quantities, packing and the delivery sequence are agreed together so the second stage does not arrive before the first is installed.'),
            $faq('Can the terminal arrangement be revised for another board?', 'A changed board is compared with the existing terminal row, the driver clearance and the entry edges before any revision is accepted. Where the tool permits the change, a single unit is closed with camera cores landed first.'),
            $faq('How is a channel cabinet inspected before dispatch?', 'A channel body is checked along the terminal row and the entry edges against the stored board particulars, and one unit is closed with camera leads landed. Material and finish appear in the quotation, and the carton is tried with its intended stack height.'),
            $faq('Which figures should a channel cabinet quote include?', 'A quotation request goes to herritagemoulds@gmail.com with the channel count, the terminal row length and the number of buildings on the schedule. Herritage Moulds answers with the cabinet size, the interior layout and a written price for the installer to weigh.'),
        ],
        'meta' => $meta(
            'CCTV Channel SMPS',
            'CCTV Channel SMPS Cabinet for Camera Power',
            'CCTV channel SMPS cabinets for four and eight camera supplies. Check terminal space, lead entries and recorder placement before ordering.'
        ),
        'seo' => true,
        'featured' => true,
    ],
    [
        'title' => 'Charger Adapter Cabinet',
        'slug' => 'charger-adapter-cabinet',
        'image' => 'categories/charger-adapter-cabinet.webp',
        'sub_name' => 'Charger Adapter Enclosures',
        'description' => $para(
            'A Charger Adapter Cabinet does two jobs at once: it protects a small adapter board and it gives the finished product the outline a buyer sees on a shelf. Designers comparing <strong>top rated Charger Adapter Cabinet manufacturers</strong> with <strong>best Charger Adapter Cabinet suppliers</strong> are therefore choosing a shape as well as a container. This page sets out how the curved and regular bodies differ once a board, a lid and an output cord are fitted.',
            '<strong>Which adapter housing suits a board with tall components?</strong> Measure the assembled board at its highest point and compare that figure with the inside of the lid, not with the outside height of the shell. A curved body loses headroom towards its edges, so a component near the wall can foul a cover that looks generous in the centre. Place the board on the flat seat, mark the tallest part and check the lid line before deciding between a curved and a straight-sided body.',
            '<strong>When does a keyed lid make sense on an adapter?</strong> A lock is useful where the unit sits in a shared space, a counter or a cupboard other people can reach, and where accidental opening would interrupt a supply. It is not a substitute for keeping the key with the person responsible for service, and the key needs room to turn without the wall or the cord in the way. <strong><a href="/product/lock-regular-cabinet">Lock Regular Cabinet</a></strong> carries that arrangement, while <strong><a href="/product/screw-box-curve-line">Screw Box Curve Line</a></strong> keeps a simple screw fixing for products that do not need controlled access.',
            'The category is small for a reason: two bodies cover most compact adapter builds, one curved and screw-fixed, one regular and keyed. Buyers who assess <strong>top rated Charger Adapter Cabinet manufacturers</strong> alongside <strong>best Charger Adapter Cabinet suppliers</strong> should settle the board height, the lid type and the cord exit before asking for a rate. Those three details decide whether the finished adapter looks deliberate or merely housed.'
        ),
        'content' => [
            'sub_name' => 'Charger Adapter Enclosures',
            'highlights' => [
                'flat seat inside the curve',
                'component height at the lid line',
                'output cord exit clearance',
                'keyed lid for shared spaces',
                'repeat compact adapter build',
            ],
            'features' => $block(
                'An adapter housing is judged on the seat, the lid and the exit for the output cord, because all three are visible to the person who eventually uses the product. A curved shell and a regular one solve those points differently, and the difference shows up in the hand rather than on a drawing. A designer comparing <strong>top rated Charger Adapter Cabinet manufacturers</strong> with <strong>best Charger Adapter Cabinet suppliers</strong> can see that difference on a moulded sample, where the seat and the lid line show at once.',
                [
                    'Flat seat inside the curve' => 'The board must rest on the flat area of a curved base, so the useful measurement is that flat width rather than the widest point of the outline.',
                    'Component height at the lid line' => 'The tallest part is checked where the cover sits lowest, which is usually near the edge of a curved body.',
                    'Cord exit clear of the seam' => 'The output lead should leave through an opening that does not rub against the lid edge when the cover is fitted.',
                    'Screw posts away from parts' => 'Fixing points are placed so a driver does not pass over a component, which protects the board during assembly and service.',
                    'Key swing planned early' => 'On a lockable body the key needs a clear arc outside the shell, so the mounting position is chosen with that movement in mind.',
                ],
                'A compact product hides nothing, so a poor seat or a cord pressed under the lid shows up in the customer\'s hand. Herritage Moulds reviews the adapter board, the lid preference and the cord route against the chosen body before dispatch. Buyers who weigh <strong>top rated Charger Adapter Cabinet manufacturers</strong> and <strong>best Charger Adapter Cabinet suppliers</strong> should ask for that sample with the packing note before the batch is set.'
            ),
            'why_choose_us' => $block(
                'Small adapters are bought in modest quantities, which makes a wrong first sample expensive relative to the order. The Herritage Moulds approach keeps the comparison between <strong>top rated Charger Adapter Cabinet manufacturers</strong> and <strong>best Charger Adapter Cabinet suppliers</strong> short by settling it on a real moulding rather than in a long specification. Each step below is brief and happens early.',
                [
                    'Board sketch accepted' => 'A simple drawing with the outline, the tallest part and the cord position is enough to start a conversation about the right body.',
                    'One sample before the batch' => 'The first moulding is checked with the real board, so a tight corner or a lid contact is found while adjustment is still practical.',
                    'Product look protected' => 'A repeat order stays on the same profile, so the adapter does not change shape between one batch and the next.',
                    'Small lots handled sensibly' => 'Quantities are planned with the assembly rate, which avoids a shelf of housings that the line cannot use yet.',
                    'Single point of contact' => 'Mould, lid and packing questions reach the same person, which keeps the answer consistent from sample to delivery.',
                ],
                'For a compact product the gap between a good and a poor housing is often a millimetre at the lid, and that is exactly what a sample reveals. A price list cannot show <strong>top rated Charger Adapter Cabinet manufacturers</strong> and <strong>best Charger Adapter Cabinet suppliers</strong> apart on that figure, so ask to see the seat and the packing detail before the order. The curved and keyed pages carry the interior notes for each body.'
            ),
            'applications' => $block(
                'Adapter cabinets turn up in chargers for small appliances, in power units sold at a counter and in components that need a closed body without a large enclosure. The situations below show how the choice shifts between a curved shell and a keyed regular one. Each assumes a compact board and one output lead.',
                [
                    'Counter-sold adapter unit' => 'A product displayed on a counter benefits from a curved outline that separates it from a plain rectangular box.',
                    'Shared-office power unit' => 'A unit in a shared room suits a keyed lid, so the board is not opened by whoever happens to be passing.',
                    'Appliance charger build' => 'A charger supplied with a small appliance needs a screw-fixed body that a service centre can open without a key.',
                    'Component housing retrofit' => 'A part moved from an open plate into a closed body needs the seat and cord exit checked against the existing layout.',
                    'Trial batch for a new design' => 'A first run uses one body to confirm the look and the fit before a larger moulding order is placed.',
                ],
                'The application decides the lid more often than the board does, and that is why both bodies sit in the same category. Herritage Moulds confirms the adapter layout, the lid type and the cord exit with the buyer before dispatch. The two housing pages show which interior suits each situation.'
            ),
            'contact_us' => '<p>Send the adapter board sketch, the lid preference and the batch size to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a> for a Charger Adapter Cabinet quotation. Herritage Moulds replies with the body that suits the product, the sample arrangement and the packing plan, so a compact adapter can reach the counter with a housing that matches its design.</p>',
        ],
        'faqs' => [
            $faq('Which products use a Charger Adapter Cabinet?', 'The bodies suit compact chargers, small power units and component assemblies that need a closed shell with one output cord. Curved screw-fixed and regular keyed versions cover most of those builds.'),
            $faq('How are small adapter cabinet orders supplied?', 'Small batches are packed in counts that match the assembly rate, with lids kept from rubbing against one another. Larger runs are split into cartons by body type, and the packing note follows the delivery schedule.'),
            $faq('Can the lid be changed from screw-fixed to keyed?', 'The two closures are separate bodies rather than a single shell with a swap, so the change is treated as a different model. The board seat and cord exit are checked again for the keyed version before the order.'),
            $faq('How are the seat and cover checked on a keyed body?', 'The flat seat is tried with the actual adapter board, the cover is closed to confirm the tallest part clears it, and the fixing point is operated once. Material and finish appear in the quotation, with a sample used for the last check.'),
            $faq('How do I ask for a Charger Adapter Cabinet quote?', 'For a price on either body, message herritagemoulds@gmail.com with the board sketch, the lid preference and the batch size. Herritage Moulds replies with the sample plan and a written rate that can be compared before the moulding run is confirmed.'),
        ],
        'meta' => $meta(
            'Charger Adapter Cabinet',
            'Charger Adapter Cabinet for Small Adapters',
            'Charger adapter cabinets in curved screw-fixed and keyed regular styles. Compare board seat, lid type and cord exit for compact adapters.'
        ),
        'seo' => true,
        'featured' => true,
    ],
    [
        'title' => 'Wires',
        'slug' => 'wires',
        'image' => 'categories/wires.webp',
        'sub_name' => 'Wiring for Enclosures',
        'description' => $para(
            'The Wires category covers the lead route inside a moulded cabinet rather than a spool on a shelf, because a conductor\'s path from a terminal to the opening decides how the unit assembles and services. Buyers comparing <strong>top rated Wires manufacturers</strong> and <strong>best Wires suppliers</strong> for enclosure work are really asking how a cable entry, a bend and a connector will sit once the lid is closed. This page explains the points worth settling before a housing is ordered.',
            '<strong>What decides whether a lead will fit an opening?</strong> The outside diameter of the finished cable matters more than the conductor size printed on it, because insulation and any sleeve add to the figure. A cable that passes the opening with no clearance will chafe each time the unit is moved, while one that passes too loosely leaves a gap for dust. Add the connector width to the measurement when the plug has to travel through the same hole during assembly.',
            '<strong>Why plan a service loop instead of cutting the lead short?</strong> A little slack inside the body lets a technician move a terminal aside or lift the board without pulling on a solder joint. Too much slack curls against a component or gets trapped under the lid, so the loop is sized to the interior rather than to the cable reel. Lead route planning therefore starts with the cabinet dimensions and works back to the lead length.',
            'Good wiring stays invisible until something fails, and then it decides how quickly the fault is found. Buyers who assess <strong>top rated Wires manufacturers</strong> and <strong>best Wires suppliers</strong> should ask for the entry size, the intended route and the separation between mains and low-voltage leads in writing. A short route plan on paper is more useful to an assembly team than a longer conversation held once.'
        ),
        'content' => [
            'sub_name' => 'Wiring for Enclosures',
            'highlights' => [
                'finished cable outside diameter',
                'bend radius beside the terminal',
                'service loop inside the body',
                'mains and signal separation',
                'repeat lead route plan',
            ],
            'features' => $block(
                'The wiring questions on this page follow the physical path of a lead: entry, bend, terminal and lid. Those four stages show whether a proposed route will survive assembly and service long after the order is placed. Anyone comparing <strong>top rated Wires manufacturers</strong> with <strong>best Wires suppliers</strong> can use the same path to test an enclosure before the order.',
                [
                    'Cable diameter through the entry' => 'The finished cable, including insulation, is measured against the opening so the lead passes without chafing or leaving a wide gap.',
                    'Bend radius beside the board' => 'A lead needs a gentle curve near the terminal, so the route is checked for space before the lid goes on.',
                    'Ferrule and terminal fit' => 'A crimped end should seat fully in the terminal without insulation entering the clamp, which means the strip length is fixed before assembly.',
                    'Mains separated from signal' => 'Keep the supply cable on its own side of the interior so a damaged conductor cannot reach the low-voltage run during service.',
                    'Service loop left inside' => 'A short length of slack lets the board be lifted or a terminal reached without stretching the conductor.',
                ],
                'These five checks cost nothing at the drawing stage and save time at the bench. Herritage Moulds discusses the route alongside the housing, so the entry and the internal space are agreed together rather than corrected after delivery. A written entry size and route also give buyers a fair way to compare <strong>top rated Wires manufacturers</strong> and <strong>best Wires suppliers</strong>.'
            ),
            'why_choose_us' => $block(
                'Wiring advice is only useful when it matches the cabinet that will hold the lead, which is why this category sits beside the moulded range instead of being sold as a separate item. A buyer who arrives with a route gets an answer tied to a real body, not a general rule about cables. That is also where <strong>top rated Wires manufacturers</strong> and <strong>best Wires suppliers</strong> differ, since a route tied to a body is harder to copy than a price list.',
                [
                    'Route reviewed with the shell' => 'The entry and the internal path are checked against the cabinet body, so the advice does not assume space that is not there.',
                    'Simple drawing accepted' => 'A sketch of the board, the connector and the lead direction is enough to discuss a route without a formal wiring diagram.',
                    'Repeat build kept identical' => 'The same entry and lead length are held for a repeat order, so the assembly team does not adjust its routine.',
                    'Packing that protects leads' => 'Cartons are planned so pre-wired units are not compressed in transit, which matters when the lead is already fitted.',
                    'Answers in one place' => 'Housing, entry and packing questions reach the same contact, so the route plan and the order do not drift apart.',
                ],
                'A route agreed once and written down is easier to repeat than one rebuilt from memory at each batch. Buyers who compare <strong>top rated Wires manufacturers</strong> and <strong>best Wires suppliers</strong> can judge that discipline by asking what is recorded with the order. The enclosure pages give the dimensions that the wiring plan must respect.'
            ),
            'applications' => $block(
                'Wiring routes differ by product even when the cabinet family is the same, because a purifier, a field charger and a camera supply each place their terminals differently. The situations below show how the route changes with the application. Each assumes the lead is fitted during assembly rather than added on site.',
                [
                    'Purifier supply lead' => 'A purifier route keeps the output lead away from the filter housing and gives the technician room to reach the terminal.',
                    'Field charger lead set' => 'A charger carried outdoors needs a route that does not pull at the terminal when the body is lifted.',
                    'Camera bundle at a recorder' => 'A camera route groups cores by direction so one channel can be traced without undoing the bundle.',
                    'Adapter output cord' => 'A compact adapter needs a short, direct exit that keeps the cord clear of the lid seam.',
                    'Pre-wired unit for a dealer' => 'A unit wired before dispatch needs the lead coiled and packed so it arrives without a kink.',
                ],
                'Each route starts from the same three facts: the cable, the connector and the space inside the body. Herritage Moulds confirms those with the buyer before the housing and the packing are settled. The enclosure pages show where each family puts its entries.'
            ),
            'contact_us' => '<p>Describe the cable, the connector and the cabinet it has to suit in a message to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a> for a Wires planning discussion. Herritage Moulds replies with the entry position, the internal route and the packing note that go with the housing, so a pre-wired unit can be assembled to one agreed plan.</p>',
        ],
        'faqs' => [
            $faq('Which enclosure builds does the Wires category support?', 'It supports lead routing for reverse osmosis supplies, agricultural chargers, camera power units and compact adapters. The housing decides the entry position, while the cable and connector decide the space needed inside.'),
            $faq('Can wiring guidance be included with a cabinet order?', 'Yes, the route is discussed as part of the housing order, with the entry and lead length recorded on the same note. A pre-wired consignment is packed so the leads are not compressed, and the packing detail is confirmed with the schedule.'),
            $faq('Can a lead route be changed for a different connector?', 'A different connector is checked against the entry width, the bend available beside the terminal and the lid clearance. Where the body allows the change, the revised route is tried on one unit before the batch is wired.'),
            $faq('What is checked in a lead route plan?', 'The plan records the finished cable diameter, the strip length for the ferrule, the bend beside the terminal and the separation from mains wiring. It also notes where the service loop sits so the lid cannot trap it.'),
            $faq('How do I discuss a Wires requirement?', 'Email herritagemoulds@gmail.com with the cable type, the connector and the cabinet application. Herritage Moulds replies with the entry position, the lead route and a written price for the housing that the plan fits.'),
        ],
        'meta' => $meta(
            'Wires',
            'Wires and Lead Routing for Cabinets',
            'Plan wiring and lead routes for moulded cabinets. Check cable entry, bend radius and terminal space with Herritage Moulds before ordering.'
        ),
        'seo' => true,
        'featured' => true,
    ],
];

return $categories;
