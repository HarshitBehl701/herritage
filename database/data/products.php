<?php

// Product source data. Each record is written on its own, with copy that follows
// the board, transformer, terminal, profile or fixing that the product actually uses.

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

$products = [
    [
        'title' => 'RO SMPS Enclosure',
        'slug' => 'ro-smps-enclosure',
        'category' => 'ro-smps-cabinet',
        'image' => 'products/ro-smps-enclosure.webp',
        'source_image' => 'lock-regular-cabinet.png',
        'sub_name' => 'RO SMPS enclosure',
        'description' => $para(
            'An RO SMPS Enclosure is the moulded shell that turns a bare reverse osmosis power supply board into a unit an assembly team can handle, store and fit without touching live terminals. Its task is more than covering the PCB: the base must seat the board squarely, the lid must clear the tallest component, and the cable opening must line up with the output lead. For the RO SMPS Enclosure, top rated manufacturers and best suppliers are judged on those three fits rather than on the outside look, because a shell that misses any of them slows the line. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> listing places this model beside the dibbi and the 24 volt cabinets.',
            '<strong>Which measurement decides whether an RO SMPS Enclosure will accept a board?</strong> Length and width come first, but they are not enough on their own: the height of the transformer and the position of the input and output connectors decide whether the lid closes cleanly. A board can sit inside the footprint and still fail because a terminal block fouls the side wall or a lead has to bend sharply to reach the opening. Measure the populated board, not the bare PCB, and note which edge carries the connectors. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> range is arranged so this enclosure can be compared with the smaller dibbi on those figures.',
            '<strong>How does the RO SMPS Enclosure behave during a service visit?</strong> The lid lifts after its screws are released, giving the technician a clear view of the board, the transformer and the terminal points without disturbing the mounting of the purifier. Because the output lead stays in its opening, the cable does not have to be pulled back through the wall, and the connector can be checked in place. Refitting the lid returns the assembly to the same closed shape, which matters when the unit is mounted in a customer kitchen. Service teams that value that routine usually begin with the <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page.',
            'Repeat production is where the RO SMPS Enclosure earns its place. Once the board and the shell have been matched, the next batch follows the same seat, lid clearance and cable exit, so an operator does not re-learn the fit each time. Buyers who weigh the RO SMPS Enclosure against top rated manufacturers and best suppliers should ask how the opening is positioned, how the lid is fixed and how the units are packed, then set the order against those answers. A buyer who has the populated board, the opening position and the carton plan in writing can place the order without a second round of questions.'
        ),
        'content' => [
            'sub_name' => 'RO SMPS enclosure',
            'specification' => '<p>RO SMPS Enclosure is supplied as a moulded housing with a matching lid. The populated board, transformer height and output lead direction are checked against the shell before dispatch, so the opening and internal space suit the reverse osmosis supply.</p>',
            'features' => $block(
                'Every claim about the RO SMPS Enclosure is easy to test on a bench: place the populated board on the base, route the output lead through the opening and close the lid. For this model, top rated manufacturers and best suppliers are separated by how little adjustment that sequence needs. A shell that demands the transformer be tilted or the cable forced will cost time on every unit, so the checks below follow the assembly order rather than a catalogue list. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page also shows the shorter dibbi, so the shell can be compared on body length before the board is measured.',
                [
                    'Board seat and stand-offs' => 'The moulded base presents a flat platform for the PCB, with the mounting points kept clear so the board can be fixed without the shell flexing under the screwdriver.',
                    'Lid clearance over transformer' => 'Internal height is read against the wound transformer rather than the bare board, so the lid sits clear of laminations, sleeving and any soldered joint left standing proud.',
                    'Output lead exit line' => 'The cable opening sits on the same axis as the output connector, so the lead runs straight out instead of bending against the wall or crossing the board.',
                    'Screw pillar lid fixing' => 'Lid screws land in moulded pillars that take the load away from the thin wall, keeping the seam closed after the cabinet has been opened for a check.',
                    'Repeat batch shell shape' => 'Each production lot comes from the same tool, so the seat, opening and lid seat of the next cabinet match the sample already approved on the line.',
                ],
                'A cabinet is only useful when the board, lid and cable agree, and that agreement is what the RO SMPS Enclosure is designed to hold. Buyers reviewing the RO SMPS Enclosure against top rated manufacturers and best suppliers should ask for the opening position and the lid clearance before confirming a quantity. A five-minute trial with the populated board settles more than a page of description, and that trial is what the quotation should promise.'
            ),
            'why_choose_us' => $block(
                'Price is the last question a production engineer should ask about a housing. The RO SMPS Enclosure has to survive repeated opening, a transformer that runs warm and a cable that is pulled during installation, so the useful comparison between top rated manufacturers and best suppliers rests on those points. The notes below describe how Herritage Moulds handles an order, from the first board drawing to the packed carton. In the <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> family, this is the general-purpose shell, while the dibbi covers a board that needs a shorter body.',
                [
                    'Fit confirmed before dispatch' => 'The board drawing is checked against the available shell, including component height and connector edges, before the order is released for packing.',
                    'Opening plan in writing' => 'The position and size of the cable opening are stated in the quotation, so the buyer can compare them with the lead exit on the actual assembly.',
                    'Consistent moulded lots' => 'Successive batches use the same tool, which keeps the seat and lid seat stable when the buyer reorders months later.',
                    'Packing for bench handling' => 'Units are packed so lids and shells arrive without scuffing, because a marked cabinet is rejected even when the fit is correct.',
                    'Technical reply, not a sales script' => 'Questions about clearance, screw fixing or cable routing are answered against the drawing rather than deflected to a catalogue.',
                ],
                'An enclosure that arrives with the right opening and a clean lid saves more than a lower unit rate ever will. Buyers comparing the RO SMPS Enclosure on top rated manufacturers and best suppliers should treat the fit check, the written opening plan and the packing as the real specification. Three points carried from enquiry to dispatch are worth more than a brochure, and they are the reason a repeat order needs no fresh trial.',
            ),
            'applications' => $block(
                'The RO SMPS Enclosure is used wherever a reverse osmosis purifier needs its power supply board protected inside a closed body. That covers a factory assembly line, a service van carrying replacement units and a distributor shelf, and each setting asks something slightly different of the shell. An assembly line wants speed, a service visit wants access and a stock line wants a cabinet that still looks new after months in a carton. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page is where a purifier line, a service van and a dealer shelf meet the same shell question.',
                [
                    'Water purifier assembly' => 'The shell is fitted where an RO board, transformer and output lead are built into a purifier supply that has to leave the line ready to install.',
                    'Service unit replacement' => 'A cracked or discoloured cabinet can be swapped for the same pattern, restoring the protection around a board that is still working.',
                    'Monthly purifier runs' => 'A maker can book the shell on a monthly draw once the board drawing and the opening position are signed off.',
                    'Distributor spare stock' => 'A dealer can hold a small quantity against urgent service calls, knowing the shell matches the units already sold.',
                    'New model prototyping' => 'A fresh purifier design tests the shell with the populated board before the moulding order is fixed, which exposes a clearance problem early.',
                ],
                'Each of these uses starts with the same question: will the populated board sit, close and leave through the opening without adjustment? Once that is answered, quantity and packing follow. The same fitting logic travels from a first sample to a repeat lot, provided the board drawing is kept with the order.'
            ),
            'contact_us' => '<p>Send the populated board drawing, the transformer height and the monthly quantity to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a> and the Herritage Moulds team will reply with the RO SMPS Enclosure option that suits the assembly, the packing method and the dispatch window. A short note on the cable exit and the lid fixing helps the reply arrive with the right detail the first time.</p>',
            'highlights' => [
                'RO SMPS enclosure for purifiers',
                'moulded reverse osmosis power shell',
                'RO SMPS board housing',
                'screw fixed RO enclosure',
                'RO power supply cabinet shell',
            ],
        ],
        'faqs' => [
            $faq('Which reverse osmosis units use the RO SMPS Enclosure?', 'The enclosure suits a purifier whose power supply board and transformer are built into one closed unit. It is used on domestic purifier lines and for service replacements where the same board has to be housed again.'),
            $faq('Can the RO SMPS Enclosure be shipped to another region?', 'Orders can be packed for dispatch to a different region once the quantity, carton preference and delivery address are known. The shells travel with their lids matched, so a consignment does not arrive as loose parts.'),
            $faq('Can a purifier rebuild move the output lead to a new exit without a fresh tool?', 'The opening position is discussed against the connector edge on the board. Where the tool allows a change, the revised route is confirmed on a drawing before production, so the lead does not end up crossing the transformer.'),
            $faq('What is inspected on an RO SMPS Enclosure before dispatch?', 'The shell is checked for a flat seat, a lid that meets the rim and an opening that clears the lead. The offer names the shell material and the colour, and the buyer can hold the sample against them before the lot is moulded.'),
            $faq('How do I obtain a price for the RO SMPS Enclosure?', 'Email herritagemoulds@gmail.com with the board size, component height and order quantity, and Herritage Moulds will send a written quotation covering the shell, lid, packing and dispatch.'),
        ],
        'meta' => $meta(
            'RO SMPS Enclosure',
            'RO SMPS Enclosure for Water Purifiers',
            'Moulded RO SMPS enclosure for reverse osmosis power supply boards, with a screw-fixed lid and a planned cable exit for tidy assembly.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => '24 Volt 2.5 Amp Cabinet',
        'slug' => '24-volt-2-5-amp-cabinet',
        'category' => 'ro-smps-cabinet',
        'image' => 'products/24-volt-2-5-amp-cabinet.webp',
        'source_image' => '24-volt-2-5-amp-cabinet.png',
        'sub_name' => '24 volt 2.5 amp cabinet',
        'description' => $para(
            'A 24 Volt 2.5 Amp Cabinet is chosen when the supply board is small, the transformer is modest and the purifier has little room to spare. The lower output means a shorter terminal row and less heat, so the shell can stay compact without crowding the components. What decides a good fit is not the label on the cabinet but the populated board, the height of the transformer and the direction the output lead takes. For the 24 Volt 2.5 Amp Cabinet, top rated manufacturers and best suppliers are separated by how honestly each one reads a shallow board against a short shell, a test the <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> listing makes easy to repeat.',
            '<strong>Does a 2.5 amp rating tell you the cabinet size?</strong> No, because the rating describes the electrical output rather than the physical board. A 2.5 amp supply may still carry a transformer of surprising height, and the terminal block can sit close to one edge. The cabinet is selected from the board outline, the tallest part and the connector positions, then checked against the lead route. Sizing from the rating alone is how compact builds end up with a lid that will not close. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> range lists this model between the dibbi and the 3 amp housing.',
            '<strong>How should the output lead leave a 24 Volt 2.5 Amp Cabinet?</strong> The lead needs a straight run from the terminal to the opening, with enough slack to absorb movement during installation but not so much that it curls against the board. A sharp bend near the connector puts strain on the solder joint, and a cable pressed under the lid can chafe over time. Route the lead first on the bench, then close the lid and check that nothing traps it. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> listing shows how the compact and larger shells differ on that route.',
            'Compact supplies reward a cabinet that fits the first time. A repeat 24 Volt 2.5 Amp Cabinet order follows the same seat and opening, so the person closing the lid does not have to test the clearance again. Buyers who measure the 24 Volt 2.5 Amp Cabinet against top rated manufacturers and best suppliers should ask for the internal height, the lead exit position and the packing arrangement before the schedule is set. A second order placed against the same board drawing avoids the small clearance questions that a new supplier would raise again.'
        ),
        'content' => [
            'sub_name' => '24 volt 2.5 amp cabinet',
            'specification' => '<p>Low-output reverse osmosis boards get a short moulded shell in the 24 Volt 2.5 Amp Cabinet, which arrives with a lid matched to the body. The board footprint, the transformer crown and the exit for the output cable are compared before the internal space is fixed.</p>',
            'features' => $block(
                'A compact cabinet is judged on the space it does not waste. The 24 Volt 2.5 Amp Cabinet holds a small board and a modest transformer, so the walls can sit close without touching either, and the opening can be short because the lead run is short. Buyers who compare top rated manufacturers and best suppliers for the 24 Volt 2.5 Amp Cabinet should look at the seat, the lid gap and the exit rather than the outside dimensions alone. On the <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page, this short shell is easier to judge than a taller one, because the three checks below show up at once.',
                [
                    'Compact internal footprint' => 'The base is proportioned for a small RO supply board, so a low-current build does not carry the empty volume of a larger cabinet.',
                    'Transformer height allowance' => 'The lid depth is checked against the transformer, leaving clearance above the laminations instead of relying on the board thickness alone.',
                    'Short output lead run' => 'The exit sits close to the terminal edge, which keeps the cable run brief and reduces the chance of a loop forming inside the shell.',
                    'Rim contact along the seam' => 'The lid meets the body on a continuous rim, so dust has fewer paths into the cabinet when the unit waits in storage.',
                    'Low current board support' => 'The seat supports the PCB across its length, which matters when a small board carries a transformer at one end.',
                ],
                'A low-current cabinet should disappear into the assembly, not demand attention at every stage. The 24 Volt 2.5 Amp Cabinet is checked against top rated manufacturers and best suppliers on seat flatness, lid clearance and lead exit, because those are the points a compact build cannot correct later. A compact shell that closes without force on the first sample is the one to reorder, and the board drawing is the document that makes that repeat possible.'
            ),
            'why_choose_us' => $block(
                'A small cabinet can still cause a large delay if the transformer fouls the lid or the terminal sits under the rim. The 24 Volt 2.5 Amp Cabinet is therefore reviewed as an assembly rather than as a plastic part, and the comparison between top rated manufacturers and best suppliers is made on how the review is handled. Herritage Moulds asks for the populated board, the lead direction and the packing preference before quoting. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page sets the compact body next to the dibbi, so a buyer can compare length without leaving the low-current family.',
                [
                    'Rating checked with the board' => 'The 2.5 amp label is read alongside the board outline, because the electrical rating alone does not describe the transformer or terminal height.',
                    'Clear compact dimensions' => 'The quotation states the internal space and the opening position, so the buyer can compare them with the assembly before committing to a quantity.',
                    'Repeat low current batches' => 'A reorder follows the same moulded pattern, keeping the compact fit stable when the purifier model is unchanged.',
                    'Carton packing for small units' => 'The smaller shell is packed in a carton that suits bench storage, so lids and bodies stay matched until the assembly stage.',
                    'Direct technical answers' => 'Questions on transformer clearance or cable routing receive a specific reply based on the drawing, not a general statement about quality.',
                ],
                'The right compact cabinet is the one that closes without force and opens without damage. Buyers reviewing the 24 Volt 2.5 Amp Cabinet against top rated manufacturers and best suppliers should ask how the low-current board is checked and what the packing protects. Both answers belong in the quotation, because a compact cabinet that arrives without them is a cabinet that will be measured again on the bench.'
            ),
            'applications' => $block(
                'The 24 Volt 2.5 Amp Cabinet appears in purifier builds where the supply has to fit behind a filter housing or inside a narrow control space. Its low output suits a small board, and its compact body leaves room for the plumbing around it. That makes the cabinet useful to a domestic assembly line, a service technician and a dealer holding spare housings. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page groups the low-current builds with the larger housings, which helps when a board is measured for the first time.',
                [
                    'Domestic purifier builds' => 'The cabinet is used on a household purifier whose supply board sits close to the filter housing and cannot take a wide shell.',
                    'Compact OEM assemblies' => 'A maker building a small power supply into another appliance can use the shell where the board and transformer fit the low-current envelope.',
                    'Service unit swaps' => 'A technician can replace a damaged compact cabinet without changing the board or the wiring already installed in the purifier.',
                    'Dealer spare stock' => 'A dealer can keep a few units for repairs, since the compact shell takes little shelf space and matches the common low-current board.',
                    'New low-current designs' => 'A new purifier model can trial the cabinet with its board before the production quantity is fixed.',
                ],
                'The common thread is a small board that still needs a closed, serviceable body. Once the populated board is measured, the compact cabinet, packing and delivery can be settled in one exchange. When the populated board outgrows the short body, the next size is a question of transformer height and terminal length, not of price.'
            ),
            'contact_us' => '<p>Email the board outline, transformer height and expected monthly volume to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a> for a 24 Volt 2.5 Amp Cabinet quotation. Herritage Moulds will confirm the compact shell, the cable exit and the carton arrangement, so a low-current build can be planned without a second round of questions.</p>',
            'highlights' => [
                '24 volt 2.5 amp cabinet',
                'compact low current RO shell',
                '2.5 amp purifier cabinet',
                'small RO transformer housing',
                'low output RO enclosure',
            ],
        ],
        'faqs' => [
            $faq('Which domestic purifier builds are happiest inside the shallow 24 Volt 2.5 Amp shell?', 'It suits a domestic purifier or small appliance whose supply board has a 2.5 amp output and a compact transformer. The shell is intended for a low-current assembly where the board sits close to the filter or control space.'),
            $faq('Can a dealer reorder the shallow 2.5 amp shell in the same colour several times a year?', 'Repeat lots are planned against the monthly assembly volume, with the carton and delivery point agreed in advance. Send the board details and the required quantity so the schedule can be set.'),
            $faq('Can the compact cabinet be adjusted for a taller transformer?', 'The internal height is checked against the transformer before the order, and a different board can be reviewed where the tool allows. Any change is confirmed on the drawing rather than assumed from the 2.5 amp rating.'),
            $faq('What is checked on the 24 Volt 2.5 Amp Cabinet body?', 'Inspection covers the seat, the rim and the cable exit, and every lid is closed on its own body before packing. Material and finish are stated with the quotation so the buyer knows what the compact shell is made from.'),
            $faq('How can I request a 24 Volt 2.5 Amp Cabinet price?', 'A compact quotation starts with the populated board outline and the monthly draw, sent to herritagemoulds@gmail.com; Herritage Moulds answers with the shell, carton plan and delivery date.'),
        ],
        'meta' => $meta(
            '24 Volt 2.5 Amp Cabinet',
            '24 Volt 2.5 Amp Cabinet for RO Supplies',
            'Compact moulded 24 volt 2.5 amp cabinet for low-current RO supply boards, with a close-fitting lid and a short output lead route.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => '24 Volt 3 Amp Cabinet',
        'slug' => '24-volt-3-amp-cabinet',
        'category' => 'ro-smps-cabinet',
        'image' => 'products/24-volt-3-amp-cabinet.webp',
        'source_image' => '24-volt-3-amp-cabinet.png',
        'sub_name' => '24 volt 3 amp cabinet',
        'description' => $para(
            'The 24 Volt 3 Amp Cabinet answers a different problem from its 2.5 amp sibling: the board is larger, the transformer carries more copper and the supply runs warmer, so the shell needs breathing room around the components. A cabinet that merely looks bigger is not enough if the lid still sits close to a heat-generating part or the input and output leads share one tight exit. Where the 24 Volt 3 Amp Cabinet is concerned, top rated manufacturers and best suppliers differ in how much room they allow above a taller transformer, a point the <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page illustrates with its deeper sibling.',
            '<strong>Why does a 3 amp supply need more clearance than a 2.5 amp unit?</strong> The higher current usually brings a larger transformer and a terminal arrangement that takes more space, and the board itself may run warmer under load. Clearance above the tallest component lets air move and keeps the lid from becoming a contact surface. The same gap also makes room for a service screwdriver and prevents a connector from being pressed when the cover is fitted. Checking that space before the order is more useful than comparing outside dimensions. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> range places this model above the 2.5 amp cabinet.',
            '<strong>How should input and output leads be separated in a 24 Volt 3 Amp Cabinet?</strong> The two runs should not cross the board diagonally or share a single narrow slot if the layout allows separate exits. An input lead kept away from the output side reduces accidental coupling and makes a fault easier to trace during service. The opening plan should follow the connector positions on the actual board, with enough room for the cable insulation to pass without being cut. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> listing shows the related housings and their different internal volumes.',
            'A 3 amp build usually repeats across a product family, so the cabinet has to hold the same clearances lot after lot. The 24 Volt 3 Amp Cabinet is worth comparing on top rated manufacturers and best suppliers only when the board, the transformer and the two lead routes are on the table together. Buyers who do that avoid a shell that fits the drawing but crowds the assembly. The order is settled once the board, the transformer and the two routes have been checked against one drawing.'
        ),
        'content' => [
            'sub_name' => '24 volt 3 amp cabinet',
            'specification' => '<p>More current means a taller transformer and a terminal row with less spare room, and the 24 Volt 3 Amp Cabinet is the deeper moulded body built around that. The taller transformer and the two cable runs are mapped against the internal volume before the order is accepted.</p>',
            'features' => $block(
                'Heat, cable separation and service access are the three concerns that shape a higher-current housing. The 24 Volt 3 Amp Cabinet gives the transformer room above and around it, keeps the input and output routes apart and lets the lid come off without disturbing the board. Buyers comparing top rated manufacturers and best suppliers for the 24 Volt 3 Amp Cabinet should slide a loaded pcb into the sample and watch whether the taller transformer still clears the lid line. On the <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page, this deeper shell sits above the low-current cabinet, and the extra space is there for the transformer.',
                [
                    'Thermal gap above parts' => 'The lid sits high enough to leave a still-air gap over the transformer and regulator, so heat is not trapped against a plastic surface.',
                    'Wider terminal clearance' => 'The base allows the terminal block and its screws to be reached without the side wall pressing on a wire or a probe.',
                    'Separate input and output exits' => 'Two distinct cable routes keep the incoming supply away from the outgoing load, which simplifies fault finding at the terminal.',
                    'Lid removal without rewiring' => 'The cover lifts clear of the board and the lead entries, so a service check does not require the supply to be disconnected from the purifier.',
                    'Stable 3 amp shell pattern' => 'The same moulded geometry is repeated for each batch, keeping the clearances identical when the product is reordered.',
                ],
                'Clearance is not visible from the outside, which is why the 24 Volt 3 Amp Cabinet has to be judged on a fitted sample. Buyers who compare the model on top rated manufacturers and best suppliers should ask where the transformer sits relative to the lid and how the two cable routes leave the body. A fitted sample is the only convincing proof of clearance, and the board drawing is what makes that sample worth building.'
            ),
            'why_choose_us' => $block(
                'A higher-current supply punishes a careless housing twice: once at assembly, when a cable will not bend into place, and again in service, when the board cannot be reached without dismantling the unit. The 24 Volt 3 Amp Cabinet is planned around those two moments, and the difference between top rated manufacturers and best suppliers shows in how the plan is documented. Herritage Moulds works from the populated board rather than a nominal size. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page puts the 3 amp shell beside the low-current cabinet, so the extra depth can be judged against a smaller transformer.',
                [
                    'Board and heat review' => 'The board outline, transformer height and likely warm spots are discussed before the shell is confirmed, so the lid is not chosen on length and width alone.',
                    'Written clearance figures' => 'The quotation records the internal height and the cable entry positions, giving the buyer a reference for the next batch or a second product.',
                    'Repeat 3 amp consistency' => 'A repeat order keeps the same tool and the same clearances, so a board approved in one lot still fits the next without a trial.',
                    'Protective carton packing' => 'The larger shells are packed with the lids matched and the rims protected, because a chipped rim can spoil the seam before assembly begins.',
                    'Answers from the drawing' => 'A question about lead separation or lid access is answered against the actual layout, which is more useful than a generic assurance.',
                ],
                'The value of a housing lies in the problems it prevents, not in the thickness of its wall. Buyers assessing the 24 Volt 3 Amp Cabinet against top rated manufacturers and best suppliers should ask for the clearance figures and the lead entry plan in writing. Written figures remove the guesswork from a reorder, which is why they belong with the quotation rather than in a later email.'
            ),
            'applications' => $block(
                'The 24 Volt 3 Amp Cabinet is fitted to purifier supplies that draw more current than a compact board and therefore need a larger transformer and a more generous terminal area. It appears in domestic and light commercial purifier builds, in service stocks for those units and in OEM lines that repeat the same supply. Each use benefits from a shell that leaves room around the warm parts and keeps the two cable runs distinct. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page gathers the higher-current builds with the other housings, which keeps the clearance question in one place.',
                [
                    'Higher-current purifier lines' => 'The cabinet is used where a 3 amp board and its transformer are assembled into a purifier that needs a closed, serviceable supply.',
                    'Light commercial units' => 'A small commercial purifier with a longer duty cycle can use the shell where the extra internal room helps the supply run cooler.',
                    'Service stock for installed units' => 'A technician can carry the same cabinet as a replacement, avoiding a mismatch when the original housing has been damaged.',
                    'Repeating supply builds' => 'A maker can place the 3 amp body on a standing schedule after the board, transformer and exits are settled.',
                    'Redesigned supply trials' => 'A new 3 amp layout can be tested in the shell before the production tooling order is confirmed.',
                ],
                'Whether the unit serves a home or a small commercial site, the cabinet has to accommodate the same three things: the board, the transformer and the two cable routes. Once those are measured, the order can be planned with confidence. Where the transformer is smaller, the low-current shell does the same job with less depth.'
            ),
            'contact_us' => '<p>Send the 3 amp board outline, transformer height and the preferred cable exit positions to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>, together with the monthly quantity. Herritage Moulds will reply with the 24 Volt 3 Amp Cabinet option, the internal clearance it offers and the packing plan for the lot.</p>',
            'highlights' => [
                '24 volt 3 amp cabinet',
                'higher current RO housing',
                '3 amp purifier supply shell',
                'ventilated RO transformer cabinet',
                'RO cabinet with separate exits',
            ],
        ],
        'faqs' => [
            $faq('When does a purifier supply draw enough current to call for the deeper 3 amp moulding?', 'It is intended for a reverse osmosis supply with a 3 amp output, a larger transformer and a terminal block that needs more room. Domestic purifiers and small commercial units with a longer duty cycle are the usual applications.'),
            $faq('What carton arrangement protects a distributor consignment of the deeper 3 amp bodies?', 'Bulk dispatch is arranged around the monthly quantity, the carton type and the delivery point. Share the board details and the required date so the production and packing slots can be reserved.'),
            $faq('What can be revised if a new 3 amp board arrives with a taller transformer?', 'The available shell is compared with the board outline, transformer height and connector positions. When the tool can accommodate a taller transformer, the new clearance is drawn and agreed before moulding begins.'),
            $faq('How is the 24 Volt 3 Amp Cabinet inspected?', 'Level seat, close lid seam and clear cable entries are the three checks signed off before the cartons close. Material and finish are declared in the quotation so the buyer can judge the shell against the sample.'),
            $faq('How do I get a quotation for the 24 Volt 3 Amp Cabinet?', 'A price follows once the board drawing, transformer height and annual volume reach herritagemoulds@gmail.com, where Herritage Moulds prepares the 3 amp option with clearance notes for the assembly.'),
        ],
        'meta' => $meta(
            '24 Volt 3 Amp Cabinet',
            '24 Volt 3 Amp Cabinet for RO Supplies',
            'Moulded 24 volt 3 amp cabinet for higher-current RO supply boards, with clearance above the transformer and separate cable exits.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => 'RO SMPS Dibbi',
        'slug' => 'ro-smps-dibbi',
        'category' => 'ro-smps-cabinet',
        'image' => 'products/ro-smps-dibbi.webp',
        'source_image' => 'ro-smps-dibbi.png',
        'sub_name' => 'RO SMPS dibbi',
        'description' => $para(
            'Where a purifier leaves only a narrow gap behind the filter housing, the RO SMPS Dibbi is the body that slips into it. It is the shortest cabinet in the RO family, built for a small supply board whose transformer stands low and whose output lead leaves close to the edge. Compact size is useful only if the board still sits flat and the lid clears the tallest part, so both are checked before a dibbi is chosen. For the RO SMPS Dibbi, top rated manufacturers and best suppliers earn trust by proving a full purifier board still fits the smallest shell, which the <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> index presents as the compact extreme.',
            '<strong>What can a small RO SMPS Dibbi actually hold?</strong> It holds a compact reverse osmosis board, a low transformer and a short terminal row, not the larger assembly that needs a 3 amp cabinet. Start with the board length and width, then add the height of the tallest part and the space taken by the connector housing. A dibbi that closes over the board but pinches a lead is the wrong choice, even though the footprint looks correct. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> range makes that step up visible, with the 2.5 amp shell next in line.',
            '<strong>How is the RO SMPS Dibbi opened on a service call?</strong> The lid comes away after its screws are released, and the short body lets the board be lifted without moving the purifier. Finger room is tighter than in a larger cabinet, so the terminal screws are reached from the top rather than the side, and the lead does not need to be pulled out of its entry. A technician who has worked on one dibbi will recognise the routine on the next. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> listing groups the compact shell with the taller RO housings for comparison.',
            'Small builds repeat often, and a dibbi that matches the first lot keeps the assembly bench predictable. The RO SMPS Dibbi is therefore compared on top rated manufacturers and best suppliers with the board, the transformer and the cable entry in view, not with a general idea of a small box. Buyers who settle those details before ordering avoid a cabinet that has to be trimmed or forced at the last stage. A short body that matches the first lot keeps a small purifier build from turning into a fitting exercise on every batch.'
        ),
        'content' => [
            'sub_name' => 'RO SMPS dibbi',
            'specification' => '<p>The RO SMPS Dibbi puts a compact reverse osmosis board into the shortest moulded shell in the range, with a lid that clears the transformer crown. Its internal length, transformer height and lead entry are matched to the populated board before the moulding lot is planned.</p>',
            'features' => $block(
                'A compact housing is tested by the movement of fitting a board into a shallow body. The RO SMPS Dibbi keeps that movement simple: the board lowers onto a flat seat, the transformer sits in its own bay and the lead leaves through a short entry. Buyers who compare top rated manufacturers and best suppliers for the RO SMPS Dibbi should watch those three moments rather than the outer length. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page sets the dibbi at the compact end, which makes the short body easy to compare with the 2.5 amp shell.',
                [
                    'Short body profile' => 'The reduced length lets the cabinet sit behind a filter housing or in a control recess where a deeper shell would foul the plumbing.',
                    'Flat board platform' => 'The base gives the PCB a continuous seat, so a small board with a transformer at one end does not rock while the lid is fixed.',
                    'Compact transformer bay' => 'The internal depth is checked against the transformer crown, keeping the lid from resting on the laminations or a soldered tag.',
                    'Close fitting lid seam' => 'The lid meets the rim along its full length, which limits the dust that reaches the board while the purifier waits for installation.',
                    'Small batch repeatability' => 'The same short body is moulded for each reorder, so the seat and entry stay identical when the purifier model is unchanged.',
                ],
                'A dibbi that fits properly is easy to overlook, which is the point of a compact shell. The RO SMPS Dibbi is checked against top rated manufacturers and best suppliers on the seat, the transformer bay and the lead entry, because a short body leaves little room to correct a mistake. A compact shell should be tested with the populated board, because a bare PCB hides the height that decides the fit.'
            ),
            'why_choose_us' => $block(
                'The temptation with a small cabinet is to scale a larger drawing down and hope the board still fits. The RO SMPS Dibbi is handled the other way round: the populated board is measured first, then the shortest body that will accept it is chosen. That order of work is what separates top rated manufacturers and best suppliers in a compact enquiry. Herritage Moulds will not propose a shell until the pcb outline, the wound component height and the cable exit side have been supplied in writing. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page shows the dibbi among the taller shells, so the loss of internal height is visible before a board is chosen.',
                [
                    'Board measured first' => 'The board outline and the height of the tallest component are recorded before the dibbi is proposed, so the compact size is not a guess.',
                    'Limits stated plainly' => 'Where a board is too tall or too long for the short body, the reply says so and points to the 2.5 amp shell instead of forcing the fit.',
                    'Repeat dibbi lots' => 'A reorder keeps the same mould and entry position, which matters when the purifier is assembled on a fixed bench routine.',
                    'Cartons for small shells' => 'The compact bodies are packed with their lids in a carton that suits shelf storage, reducing scuffs before the assembly stage.',
                    'Answers on the short shell' => 'Questions about finger room, terminal access or cable entry are answered for the dibbi specifically, not for the range in general.',
                ],
                'A small cabinet earns its keep by making a tight installation possible, not by being cheap. Buyers who assess the RO SMPS Dibbi on top rated manufacturers and best suppliers should ask for the internal height and the lead entry position in writing. Both figures belong in the reply, since a short body cannot be corrected with a longer cable or a different lid.'
            ),
            'applications' => $block(
                'The RO SMPS Dibbi is used where the purifier design has already consumed most of the available space. It suits a compact supply that sits behind a filter bowl, beside a mounting bracket or inside a narrow control recess. A service technician also values the short body when a replacement has to go into a unit that was not designed around a large cabinet. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page groups these tight installations with the wider shells, which helps a buyer judge how much room the purifier can spare.',
                [
                    'Tight purifier spaces' => 'The cabinet is chosen when the gap behind the filter housing will not take a deeper body without touching the plumbing.',
                    'Small OEM assemblies' => 'A maker can house a compact supply board in the dibbi where the product envelope leaves little room for a power section.',
                    'Service van stock' => 'A technician can carry several short bodies for repairs, since they take less space in the van than the larger cabinets.',
                    'Dealer replacement units' => 'A dealer can keep the dibbi for purifiers already in the field, matching the original compact shape without a new board layout.',
                    'Prototype compact builds' => 'A new small purifier can test the shell with a populated board before the production quantity is committed.',
                ],
                'What these uses share is a board that must be protected in a space that was not generous to begin with. The dibbi answers that need with a short body, a flat seat and a direct cable entry. The boundary between a dibbi and a 2.5 amp shell is set by transformer height and board length, and it is worth settling before the order.'
            ),
            'contact_us' => '<p>Send the compact board drawing, the transformer crown height and the space available behind the purifier to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>. Herritage Moulds will reply with the RO SMPS Dibbi option, the lead entry position and the carton quantity that suits a small assembly run.</p>',
            'highlights' => [
                'RO SMPS dibbi box',
                'short body RO cabinet',
                'small purifier supply shell',
                'compact RO dibbi housing',
                'moulded dibbi enclosure',
            ],
        ],
        'faqs' => [
            $faq('Where does a compact RO SMPS Dibbi fit in a purifier?', 'It fits behind a filter housing, beside a bracket or inside a narrow control recess where a deeper cabinet would touch the plumbing. The short body is intended for a small reverse osmosis supply board.'),
            $faq('Can the RO SMPS Dibbi be supplied in a repeat order?', 'Repeat orders follow the same short body and lead entry, with the carton quantity agreed against the assembly run. Send the board details and the expected monthly draw so the lot can be scheduled.'),
            $faq('Can the dibbi be altered to take a taller transformer?', 'The internal depth is compared with the transformer crown before the order. Where the short body cannot clear it, the 2.5 amp cabinet is the better option, and that change is confirmed before production.'),
            $faq('Which checks does a RO SMPS Dibbi go through before it is packed?', 'Flatness of the seat, a close lid seam and a clear entry path are confirmed on every compact body before packing. Shell material and colour are written into the quotation, and a sample can be checked against them before packing.'),
            $faq('What is the process for a RO SMPS Dibbi quotation?', 'Send the populated board size and the monthly requirement to herritagemoulds@gmail.com; Herritage Moulds returns a quotation for the compact body with the entry position and carton plan included.'),
        ],
        'meta' => $meta(
            'RO SMPS Dibbi',
            'RO SMPS Dibbi for Compact Purifier Boards',
            'Short moulded RO SMPS dibbi for compact purifier supply boards, with a flat seat, a close lid seam and a direct output lead entry.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => 'Advance Enclosure Solution',
        'slug' => 'advance-enclosure-solution',
        'category' => 'ro-smps-cabinet',
        'image' => 'products/advance-enclosure-solution.webp',
        'source_image' => 'advance-enclosure-solution.png',
        'sub_name' => 'advance enclosure',
        'description' => $para(
            'Advance Enclosure Solution is for the assembly that has outgrown a standard RO shell: a power supply board with a taller transformer, a row of connectors along two edges, or a control section that needs room beside the supply. It is a larger moulded body with a matching lid, and its value comes from the opening plan rather than from extra plastic on every side. For Advance Enclosure Solution, top rated manufacturers and best suppliers are compared on how that plan is agreed, and the <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> range places the enclosure at the larger end.',
            '<strong>What has to be fixed before an Advance Enclosure Solution is ordered?</strong> The board outline is only the beginning: every connector, its height and the direction of its cable have to be marked, along with the space needed to reach a terminal screw. The mounting method and the surface the enclosure will sit on also affect the opening positions. Once those details are drawn, the internal volume and lid clearance can be checked together. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> range gives the project a parent listing while the opening plan is settled.',
            '<strong>Can an Advance Enclosure Solution be adapted to a project rather than a catalogue size?</strong> Where the tool allows, an opening or a cable entry can be positioned for a particular board, and the revised drawing is confirmed before the lot is produced. Not every request is possible without a new tool, and a supplier who says so early is more useful than one who agrees to everything. A sample or a first-off check is the sensible way to prove the change. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> listing shows the standard RO shells from which this larger body departs.',
            'A project enclosure is judged over the life of the product, not on the first delivery alone. The Advance Enclosure Solution keeps its value when the opening plan, the lid and the internal volume are documented, so a second build or a replacement unit follows the same drawing. Buyers who compare the Advance Enclosure Solution on top rated manufacturers and best suppliers should ask for that documentation before the order. Documentation is what turns a one-off enclosure into a repeatable part, and it should travel with the first drawing.'
        ),
        'content' => [
            'sub_name' => 'advance enclosure',
            'specification' => '<p>Advance Enclosure Solution is a larger moulded body with a matching lid, supplied for power supply and control assemblies that need more internal room. The board outline, connector plan and mounting method are agreed before the openings and internal volume are fixed.</p>',
            'features' => $block(
                'An enclosure with spare room can still fail if the cables have nowhere sensible to go. The Advance Enclosure Solution is planned from the connector side outward: each entry is placed for the cable that uses it, and the lid clearance is checked against the tallest part on the board. Buyers weighing top rated manufacturers and best suppliers for the Advance Enclosure Solution should ask for that plan in drawing form. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page shows the larger body against the standard shells, where the extra internal volume is easy to see.',
                [
                    'Larger internal volume' => 'The body gives a power supply or control board room beside the transformer, so a connector row does not have to be crowded against a wall.',
                    'Connector-led openings' => 'Each cable entry is positioned from the connector it serves, which keeps a lead from crossing the board to reach a distant hole.',
                    'Lid clearance for tall parts' => 'The cover depth is checked against the tallest component, leaving space for a service probe and avoiding pressure on a soldered joint.',
                    'Mounting points on the base' => 'The base provides positions for fixing the enclosure without the screw heads intruding into the board space.',
                    'Project batch repeatability' => 'Once the opening plan is fixed, each batch follows the same drawing, so a replacement body matches the unit already in service.',
                ],
                'Room alone does not make a good enclosure; the openings have to suit the assembly that fills it. The Advance Enclosure Solution is checked against top rated manufacturers and best suppliers on the connector plan, the lid clearance and the mounting method, because those decide whether the larger body is useful. A project drawing that shows every connector is worth more than a catalogue page, because it is the only way to place an entry with confidence.'
            ),
            'why_choose_us' => $block(
                'A larger housing is often bought for a project that will run for years, which makes the first drawing more important than the first price. The Advance Enclosure Solution is quoted with the opening plan, the internal volume and the fixing method visible, so the buyer can see what will be repeated. That comparison of top rated manufacturers and best suppliers tells a buyer more about a purifier enclosure than any claim about wall thickness or gloss level. Herritage Moulds keeps the project file with the order. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page places the enclosure above the standard sizes, which makes the step from a compact board to a project board clear.',
                [
                    'Opening plan documented' => 'The position and purpose of each cable entry are recorded, so a later batch or a service replacement does not depend on memory.',
                    'Board before price' => 'The populated board and its connector heights are reviewed first, which prevents a quotation for a body that cannot take the assembly.',
                    'Sample before volume' => 'A first-off or sample check proves the lid, entries and mounting before a full project quantity is moulded.',
                    'Packing for project lots' => 'Bodies and lids are packed together with the rims protected, because a project delivery cannot absorb a damaged cover.',
                    'One contact through the build' => 'The same technical contact follows the drawing from enquiry to dispatch, so a change is not lost between departments.',
                ],
                'The enclosure that suits a project is the one whose drawing can be read a year later. Buyers reviewing the Advance Enclosure Solution against top rated manufacturers and best suppliers should ask for the opening plan, the volume and the packing method in the quotation. A quotation that carries the volume, the entries and the packing leaves the buyer with something to check, not just a price to accept.'
            ),
            'applications' => $block(
                'The Advance Enclosure Solution appears where a standard RO cabinet is too tight for the board or the connectors. That can be a power supply with a tall transformer, a control board with several cable exits, or an electronic assembly that has to be housed beside a supply. It also serves as a replacement body for a project already in the field. The <strong><a href="/category/ro-smps-cabinet">RO SMPS Cabinet</a></strong> page keeps the larger uses next to the compact shells, so a project can be judged against a standard body.',
                [
                    'Power supply assemblies' => 'The body is used where a supply board and its transformer need more room than a standard RO cabinet provides.',
                    'Control board housings' => 'A control section with several connectors can use the enclosure where the cable entries are planned around the board edges.',
                    'Custom electronic builds' => 'A project with a non-standard board can discuss the opening plan before the body is moulded for the build.',
                    'Replacement for damaged units' => 'An enclosure already in service can be replaced from the same drawing, keeping the installed assembly and its wiring unchanged.',
                    'Pilot run enclosures' => 'A pilot build can prove the fit and the cable routes before the project moves to a larger quantity.',
                ],
                'Each of these applications depends on a housing that can be described, not just sized. The connector plan and the mounting method turn a larger box into an enclosure that suits the assembly. Where the board is simple and the connectors few, a standard shell does the job without a project drawing.'
            ),
            'contact_us' => '<p>Send the board outline, the connector plan and the mounting method to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a> for an Advance Enclosure Solution review. Herritage Moulds will reply with the internal volume, the proposed cable entries and the sample or first-off arrangement for the project.</p>',
            'highlights' => [
                'advance enclosure solution',
                'larger moulded project housing',
                'electronic assembly enclosure',
                'custom cable entry planning',
                'power supply project shell',
            ],
        ],
        'faqs' => [
            $faq('Which assemblies are suited to the Advance Enclosure Solution?', 'It suits a power supply or control board that needs more room than a standard RO cabinet, especially where several connectors or a tall transformer must be accommodated. The opening plan follows the actual board edges.'),
            $faq('Can the Advance Enclosure Solution be sent with a project consignment?', 'A project quantity can be packed and dispatched as one consignment once the drawing, quantity and delivery point are agreed. The bodies and lids travel matched, so the site receives a set rather than loose covers.'),
            $faq('Is a different cable entry position possible on a project body?', 'Entries can be repositioned where the tool allows, and the revised drawing is confirmed before production. A request that needs a new tool is identified at quotation stage rather than after the order.'),
            $faq('What is checked on the Advance Enclosure Solution?', 'The body is checked for internal volume, the lid for clearance over the tallest part and each entry for a clear cable path. The moulding compound and colour are declared in the offer.'),
            $faq('How is an Advance Enclosure Solution quotation prepared?', 'The quotation follows a review of the board outline, connector plan and mounting method sent to herritagemoulds@gmail.com, and Herritage Moulds sets out the volume, entries and sample arrangement in writing.'),
        ],
        'meta' => $meta(
            'Advance Enclosure Solution',
            'Advance Enclosure Solution for Large PCB',
            'Larger moulded advance enclosure solution for power supply and control boards, with planned cable entries and clearance for tall components.'
        ),
        'seo' => true,
        'featured' => false,
        'explore' => true,
    ],
    [
        'title' => 'Jhatka Charger Cabinet',
        'slug' => 'jhatka-charger-cabinet',
        'category' => 'agricultural-charger-cabinet',
        'image' => 'products/jhatka-charger-cabinet.webp',
        'source_image' => 'jhatka-charger-cabinet.png',
        'sub_name' => 'Jhatka charger cabinet',
        'description' => $para(
            'A Jhatka charger travels to a field, sits through a dusty afternoon and comes back to a shelf, so its cabinet has to do more than hold a board. The Jhatka Charger Cabinet follows the familiar Jhatka outline, giving the charger board and transformer a closed body with a lid that stays shut in transit. Buyers who know the profile will recognise the shape before they read the label. For the Jhatka Charger Cabinet, top rated manufacturers and best suppliers are weighed on hinge wear and pin corrosion after a season of daily use, a stress the <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> section sets beside the Nexon and round shells.',
            '<strong>What has to fit inside a Jhatka Charger Cabinet?</strong> The charger board, the transformer and the two leads take up most of the space, and the transformer is usually the tallest part. Check which side carries the terminals, because a lid that closes over the board can still press on a terminal tag if the clearance is measured only at the centre. The profile also has to match the charger already in use when the cabinet is bought as a replacement. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> range places the Jhatka shape beside the other field housings.',
            '<strong>How does the Jhatka Charger Cabinet handle dust and transport?</strong> The closed body and the overlapping lid seam keep most dust off the board while the charger is carried or stored, and the cable entries sit close to the lead exits so the wires are not pinched. A screw-fixed lid stays in place over rough ground, which matters more on a farm than on a bench. The shell is not presented as waterproof; it is a practical cover for a field charger. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> listing shows how the Jhatka profile compares with the Nexon and round cabinets.',
            'Repeat orders are common in agricultural supply, and the Jhatka Charger Cabinet is chosen partly because the next lot looks like the last. Anyone assessing the Jhatka Charger Cabinet through top rated manufacturers and best suppliers should request a sample hinge test, a transformer clearance drawing and a carton drop record before confirming a season order. Those answers decide whether a replacement charger reaches the customer looking like the one it replaces. A dealer who can reorder the same outline avoids explaining a changed charger to a farmer who only wanted a replacement.'
        ),
        'content' => [
            'sub_name' => 'Jhatka charger cabinet',
            'specification' => '<p>A Jhatka field charger gets its closed body from the Jhatka Charger Cabinet, a moulded housing whose lid follows the familiar outline. The charger board, transformer height and lead exits are compared with the profile before the body is packed.</p>',
            'features' => $block(
                'A field charger cabinet is handled far more roughly than a purifier shell, so the lid seam, the cable entries and the transformer bay deserve close attention. The Jhatka Charger Cabinet keeps the board on a flat seat while the transformer sits in its own depth, and the lid closes on a continuous rim. A buyer weighing top rated manufacturers and best suppliers for the Jhatka Charger Cabinet gains more from a field trial of the closed housing than from a thickness figure quoted at enquiry. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page places the Jhatka outline among the other field bodies, so the profile can be compared before the charger is opened.',
                [
                    'Jhatka outline match' => 'The body follows the Jhatka charger shape, so a replacement unit keeps the silhouette that customers and dealers already recognise.',
                    'Transformer bay depth' => 'The internal depth is read against the transformer rather than the board, leaving room above the laminations when the lid is closed.',
                    'Transport-safe lid seam' => 'The lid sits on a continuous rim and is held by screws, so it does not lift or rattle while the charger is carried to a field.',
                    'Field cable entries' => 'The lead entries sit close to the terminals, keeping the cable run short and reducing the chance of a wire being trapped under the cover.',
                    'Repeat profile batches' => 'Each reorder uses the same Jhatka outline, which keeps the look and the board position consistent across a season of supply.',
                ],
                'The useful test for a field cabinet is a short walk with the charger in hand, not a look at the outside. The Jhatka Charger Cabinet is judged on the lid seam, the transformer bay and the cable entries, because those are what a farm routine stresses. A short carrying test exposes a lid that lifts or a lead that pulls, and top rated manufacturers and best suppliers of field housings invite exactly that trial before a season order.'
            ),
            'why_choose_us' => $block(
                'An agricultural charger is often bought by a dealer who has to match a shape the customer already owns. The Jhatka Charger Cabinet is therefore treated as a profile order as much as a housing order, and the comparison between top rated manufacturers and best suppliers begins with that outline. Herritage Moulds asks for a sample or a clear photograph of the existing cabinet before confirming the match. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page puts the Jhatka model beside the Nexon and round bodies, so a dealer can match the outline first.',
                [
                    'Profile checked first' => 'The existing Jhatka outline is compared with the available body, so a replacement does not arrive with a different shoulder or lid line.',
                    'Charger board review' => 'The board, transformer and terminal side are checked together, because a profile match alone does not guarantee clearance inside.',
                    'Seasonal repeat lots' => 'A dealer can reorder the same profile through the season, keeping the shelf consistent for farmers who ask for a familiar charger.',
                    'Packing for road travel' => 'The units are packed to protect the lid and rim during transport, since a scuffed field cabinet is harder to sell on the counter.',
                    'Plain answers on the profile' => 'Questions about the Jhatka shape, the lid or the lead exits are answered against the sample rather than a generic product description.',
                ],
                'A familiar outline sells a replacement charger, but only when the inside fits as well as the outside. Buyers reviewing the Jhatka Charger Cabinet against top rated manufacturers and best suppliers should ask for the profile match and the transformer clearance together. The profile match and the internal fit are two separate promises, and the quotation should make both of them clearly.'
            ),
            'applications' => $block(
                'The Jhatka Charger Cabinet is used on agricultural chargers that are carried to a field, connected to a battery or a pump set and then stored until the next visit. It suits a dealer who supplies spare units, a workshop that repairs chargers and a maker who builds the same model each season. In each case the cabinet has to survive handling and keep dust away from the board. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page brings the field uses together, though each one asks for a different balance of dust cover and lid security.',
                [
                    'Farm charger assembly' => 'The cabinet is fitted where a Jhatka charger board and transformer are built into a unit that will be carried outdoors.',
                    'Damaged body exchange' => 'A charger with a cracked shell can go back into service on its original board once a matching Jhatka body is fitted.',
                    'Pre-season production runs' => 'A charger maker can book a run ahead of the sowing season once the outline and the transformer space are settled.',
                    'Rural dealer stock' => 'A dealer can hold the Jhatka cabinet as a spare, matching the chargers already sold in the area.',
                    'New profile trials' => 'A charger variant can be offered in the Jhatka shell for a small field test before the moulding quantity rises.',
                ],
                'What ties these uses together is a charger that leaves the bench and comes back dirty. The Jhatka body protects the board, keeps the lid closed and presents a familiar shape to the customer. When a different outline is needed, the Nexon and round bodies cover the same field duties without the Jhatka shoulder.'
            ),
            'contact_us' => '<p>Send a photograph or sample of the Jhatka profile, the charger board size and the transformer height to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>. Herritage Moulds will confirm the Jhatka Charger Cabinet match, the lid fixing and the packing needed for a dealer or seasonal order.</p>',
            'highlights' => [
                'Jhatka charger cabinet',
                'agricultural Jhatka housing',
                'field charger cabinet',
                'Jhatka profile enclosure',
                'moulded charger body',
            ],
        ],
        'faqs' => [
            $faq('Which agricultural chargers take the Jhatka Charger Cabinet?', 'It is made for a charger that follows the Jhatka profile and carries a charger board plus transformer inside one body. It suits field chargers sold through rural dealers and repaired in local workshops.'),
            $faq('Can a dealer order the Jhatka Charger Cabinet through the season?', 'A dealer can place a seasonal order once the profile and the monthly draw are agreed. Packing and delivery are planned around the selling season so stock arrives before demand builds.'),
            $faq('Can the Jhatka profile be adjusted for a different charger board?', 'The profile is matched first, then the board and transformer are checked for clearance. Small internal differences can be reviewed, while a different outline may need a new tool and is confirmed before production.'),
            $faq('How is the Jhatka Charger Cabinet checked for field use?', 'Each field body is checked at the lid seam, the transformer bay and the cable entries, then closed with its own lid. The shell material and colour are named in the offer so a dealer can hold them against the cabinet being replaced.'),
            $faq('What should a dealer include with a Jhatka Charger Cabinet enquiry?', 'A profile photo or sample, the charger board size and the order quantity are enough for Herritage Moulds to answer from herritagemoulds@gmail.com with the match, packing and delivery plan.'),
        ],
        'meta' => $meta(
            'Jhatka Charger Cabinet',
            'Jhatka Charger Cabinet for Field Chargers',
            'Moulded Jhatka charger cabinet for agricultural field chargers, with the familiar profile, a secure lid and a transformer clearance check.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => 'Agriculture 2No Nexon',
        'slug' => 'agriculture-2no-nexon',
        'category' => 'agricultural-charger-cabinet',
        'image' => 'products/agriculture-2no-nexon.webp',
        'source_image' => 'agriculture-2no-nexon.png',
        'sub_name' => 'Agriculture 2No Nexon cabinet',
        'description' => $para(
            'Agriculture 2No Nexon is the twin-output member of the Nexon charger family, built for a board that feeds two lead sets rather than one. The extra output changes the inside of the cabinet: two cables have to leave without crossing, and the terminal area needs enough room for both connections to be reached. The Nexon outline keeps the unit recognisable beside a single-output charger. For Agriculture 2No Nexon, top rated manufacturers and best suppliers are compared on the separation kept between the two output leads, and the <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> index lists the twin body with the other farm housings.',
            '<strong>How should two output leads be arranged inside an Agriculture 2No Nexon?</strong> Give each lead its own path from the terminal to an entry, and keep the pair apart until they leave the body. Crossing one cable over the other may look tidy on the bench, but it makes a later fault harder to trace and can press the upper lead against the lid. Marking the two runs at the terminal end also helps a technician who opens the charger in the field. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> range shows the twin-output Nexon body beside the single-lead Jhatka and round cabinets.',
            '<strong>Why does the Nexon outline matter on a twin-output charger?</strong> Farmers and dealers recognise the Nexon shape, so a replacement cabinet that keeps the outline avoids a question about whether the charger has been changed. The outline also fixes the lid line and the mounting face, which means an existing bracket or carrying position can still be used. A twin-output unit with a different silhouette may fit the board yet look like a different product. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> listing keeps the Nexon profile visible with the other agricultural housings.',
            'Twin-output builds repeat across a season, and the Agriculture 2No Nexon is ordered for that continuity as much as for the shell itself. A buyer who weighs the Agriculture 2No Nexon through top rated manufacturers and best suppliers ought to see the two lead routes in a moulded sample, not just a sketch, and confirm how cartons are braced for rural transport. Those three answers decide whether the next charger looks and wires like the last. A twin-output order that carries the board drawing and both lead positions avoids a second discussion before the batch.'
        ),
        'content' => [
            'sub_name' => 'Agriculture 2No Nexon cabinet',
            'specification' => '<p>Twin leads leave one Nexon-shaped body in the Agriculture 2No Nexon, a moulded charger housing supplied with a lid that clears both terminals. The board, transformer and both output routes are reviewed together before the internal layout is confirmed.</p>',
            'features' => $block(
                'Two leads turn a simple housing into a small routing problem. The Agriculture 2No Nexon gives each output its own way out of the body, keeps the transformer clear of the lid and leaves the terminal pair reachable from above. The twin output arrangement matters more than overall size when buyers compare top rated manufacturers and best suppliers for the Agriculture 2No Nexon on a working charger. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page places the twin body next to the single-output profiles, which makes the second route easy to see.',
                [
                    'Twin output lead routes' => 'The body allows the two output cables to leave on separate paths, so one lead does not lie across the other or against a terminal tag.',
                    'Nexon profile outline' => 'The moulded shape follows the Nexon charger, keeping the lid line and mounting face familiar when a unit is replaced.',
                    'Twin transformer clearance' => 'Depth is measured to the top of the windings instead of the pcb, and the extra millimetres stop the cover pressing on insulation paper or a taped core.',
                    'Terminal access for two' => 'The opening and internal space leave room to reach both terminal pairs with a screwdriver during assembly or a field check.',
                    'Repeat twin batches' => 'Each reorder uses the same Nexon tool, so the two entries and the seat stay identical across the season.',
                ],
                'A twin-output cabinet is only tidy if both leads have somewhere to go. The Agriculture 2No Nexon is judged on the separate entries, the transformer gap and the terminal access, because those decide whether the assembly can be repeated without a workaround. A trial fit with both leads in place is the quickest way to expose a crossing that looked harmless on paper, and top rated manufacturers and best suppliers of twin housings welcome that test.'
            ),
            'why_choose_us' => $block(
                'A twin-output charger has one more failure point than a single-output unit, and most of it sits where the cables leave the board. The Agriculture 2No Nexon is planned around that point, with the two routes kept apart and the terminal pair left reachable. On a twin layout, judging top rated manufacturers and best suppliers by how the second lead is routed gives a farm buyer a firmer answer than any figure for outer size. Herritage Moulds asks for the board and the lead exits together. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page shows the Nexon body among the agricultural profiles, so the twin layout can be compared with a single-lead shell.',
                [
                    'Twin route reviewed' => 'The two output paths are traced from the terminals to the entries before the body is confirmed, so neither cable has to cross the board.',
                    'Profile matched to sample' => 'The Nexon outline is compared with the charger already in use, keeping the replacement visually consistent for dealers and farmers.',
                    'Repeat output builds' => 'A repeat batch follows the same entry positions, which helps an assembly bench keep the same routine through the season.',
                    'Protective transport packing' => 'The bodies travel with their lids and rims protected, because a marked field cabinet is difficult to sell as a new unit.',
                    'Straight answers on twins' => 'Questions about the second lead, the terminal space or the Nexon profile receive a reply based on the actual charger layout.',
                ],
                'The second output is where a cheap cabinet shows its limits, either as a crossed cable or as a lid that will not sit down. Buyers assessing the Agriculture 2No Nexon on top rated manufacturers and best suppliers should ask for the twin entry plan and the profile match in the same reply. The twin entry plan and the profile match belong in the same reply, because a charger that looks right but wires badly will come back.'
            ),
            'applications' => $block(
                'The Agriculture 2No Nexon is used on chargers that feed two lead sets, such as a unit that serves more than one connection point in a farm setup. It suits a maker building the twin model, a dealer stocking a familiar Nexon shape and a workshop replacing a damaged body. The common requirement is a cabinet that keeps the two outputs apart while preserving the outline. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page keeps the twin-output uses with the other field bodies, but the second lead is what separates them.',
                [
                    'Twin output farm chargers' => 'The body is fitted where a Nexon charger board drives two output leads that must remain separate inside the cabinet.',
                    'Twin body exchange' => 'A charger with a damaged twin cabinet can return to the field on its existing board once the Nexon profile is matched.',
                    'Twin pre-season runs' => 'A maker can book the Nexon body ahead of the sowing season once the board and both lead exits are fixed.',
                    'Twin model spares' => 'A rural dealer can keep the Nexon body for farmers who already run the two-lead charger.',
                    'New Nexon variants' => 'A revised twin-output board can be trialled in the body before a larger production lot is committed.',
                ],
                'Every one of these uses depends on two cables leaving a closed body in an orderly way. With the board and both exits fixed, the Nexon profile, the carton and the batch size fall into place. A single-output body is the simpler choice where the second lead is not needed, and the Jhatka and round profiles cover that case.'
            ),
            'contact_us' => '<p>Send the twin-output board layout, the transformer height and the position of both lead exits to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>. Herritage Moulds will reply with the Agriculture 2No Nexon option, the twin entry arrangement and the packing plan for a seasonal order.</p>',
            'highlights' => [
                'Agriculture 2No Nexon cabinet',
                'twin output Nexon housing',
                'Nexon charger enclosure',
                'two lead charger cabinet',
                'moulded Nexon field body',
            ],
        ],
        'faqs' => [
            $faq('Which charger layout needs the Agriculture 2No Nexon cabinet?', 'It is intended for a Nexon agricultural charger board that drives two output lead sets. The cabinet gives each lead a separate path and keeps the familiar Nexon outline around the assembly.'),
            $faq('Can the twin-output cabinet be ordered for a seasonal batch?', 'A seasonal run is booked from the expected quantity, the carton style and the date the dealer needs stock. The two entry positions stay the same across the batch, so the assembly bench can follow one routine.'),
            $faq('What happens if a revised board needs the second lead to leave elsewhere?', 'The exit positions are reviewed against the twin terminal layout. Where the tool permits a move, the revised routes are drawn and confirmed before the batch, so the cables do not cross inside the body.'),
            $faq('How is the Agriculture 2No Nexon body inspected?', 'The twin entries, the transformer gap and the terminal opening are checked, and the lid is fitted to the body. The offer names the moulding compound and the colour, which lets a dealer compare the new body with the charger already on the shelf.'),
            $faq('What details are needed for an Agriculture 2No Nexon quotation?', 'The board drawing, the two lead positions and the seasonal quantity are what Herritage Moulds needs at herritagemoulds@gmail.com to quote the Nexon body with its entry plan and packing.'),
        ],
        'meta' => $meta(
            'Agriculture 2No Nexon',
            'Agriculture 2No Nexon Twin Output Cabinet',
            'Moulded Agriculture 2No Nexon cabinet for twin-output agricultural chargers, with separate lead routes and the familiar Nexon outline.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => 'Agriculture Round',
        'slug' => 'agriculture-round',
        'category' => 'agricultural-charger-cabinet',
        'image' => 'products/agriculture-round.webp',
        'source_image' => 'agriculture-round.png',
        'sub_name' => 'Agriculture Round cabinet',
        'description' => $para(
            'Agriculture Round is the circular option in the agricultural charger range: a body whose curved wall changes how the board, transformer and leads sit inside. A round shell leaves less corner room than a rectangular cabinet, so the board has to be measured against the curve rather than only by its length and width. The shape also gives the finished charger a look that is easy to pick out on a dealer shelf. For Agriculture Round, top rated manufacturers and best suppliers are judged on how closely a circular mould follows the charger board without wasting internal volume, and the <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> section places the round outline beside the Jhatka and Nexon shapes.',
            '<strong>What fits inside a round Agriculture Round cabinet?</strong> A compact charger board, a low transformer and one or two leads fit comfortably; a wide board with components near its corners does not. The useful measurement is the board width against the flat area inside the curve, not the outside diameter of the shell. Check the transformer height at the centre, where the lid is closest, and confirm the lead exit against the terminal side. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> range makes the round body available beside the straighter field housings.',
            '<strong>How is the round body closed and serviced?</strong> The lid follows the circular rim, so it seats by turning or lowering into the same line rather than aligning four corners. Once the screws are released, the board can be lifted through the opening, and the curved wall gives the fingers a little more room at the edges than a tight rectangular box. A service check does not require the charger to be dismantled beyond the lid. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> listing shows the round cabinet with the rest of the range.',
            'The round shape is not only a matter of appearance: it changes the space available for the board and the way the lid closes. Agriculture Round suits a charger that is already known by that silhouette and a build where the board is compact enough for the curve. Buyers who assess Agriculture Round on top rated manufacturers and best suppliers should ask for the internal flat width, the transformer clearance and the lid alignment. The curve is worth choosing when the product already has that shape and the board fits the flat centre without compromise.'
        ),
        'content' => [
            'sub_name' => 'Agriculture Round cabinet',
            'specification' => '<p>Agriculture Round is a circular moulded charger body with a matching lid, intended for a compact agricultural board. The flat width inside the curve, the transformer height and the lead exit are checked before the body is supplied.</p>',
            'features' => $block(
                'A circular cabinet has to be judged from the inside, because the outside tells a buyer very little about usable space. The Agriculture Round provides a flat platform within the curve, a lid that follows the rim and an exit placed for a short charger lead. Buyers comparing top rated manufacturers and best suppliers for the Agriculture Round should request the internal diameter and a lid seat sample before committing to a moulding batch. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page puts the circular body among the field profiles, where the flat width can be compared with the Jhatka and Nexon shells.',
                [
                    'Circular wall profile' => 'The curved wall gives the charger its recognisable silhouette and keeps the body compact around a small board.',
                    'Board width against curve' => 'The flat area inside the shell is measured against the board, because components placed near the corners of a wide PCB can foul the curve.',
                    'Centred transformer space' => 'The deepest point sits near the middle, so a low transformer is positioned there and checked against the lid before the order.',
                    'Lid alignment on the rim' => 'The cover follows the circular rim, which makes it easier to seat squarely after a service check than a rectangular lid with four corners.',
                    'Circular mould reorders' => 'Every repeat lot comes from the same round tool, so the rim and lead exit do not drift between batches.',
                ],
                'A round cabinet works when the board is compact and the lid follows the rim without force. The Agriculture Round is checked against top rated manufacturers and best suppliers on internal width, transformer depth and lid alignment, since those decide whether the curve helps or hinders the build. A circle hides its usable area from the outside, so the flat width is the figure to ask for before the order.'
            ),
            'why_choose_us' => $block(
                'A buyer chooses a round housing because the product already has that shape, or because the compact body suits a small charger. Either way, the decision should rest on the internal space rather than on the drawing of a circle. The Agriculture Round is quoted with the flat width, the transformer position and the lid line stated, so the buyer can compare it with the board. That is the level at which top rated manufacturers and best suppliers can be judged. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page places the round body beside the Jhatka and Nexon shapes, so the loss of corner space is visible.',
                [
                    'Round outline matched' => 'The circular profile is compared with the charger already in service, so a replacement keeps the shape customers recognise.',
                    'Curve clearance review' => 'The board corners and the transformer are checked against the curved wall before the body is confirmed, not after the first trial fit.',
                    'Repeat circular lots' => 'A reorder uses the same rim and seat, which keeps the lid alignment and the internal space stable for the next batch.',
                    'Protective lid packing' => 'The circular covers are packed with the bodies so the rim is not deformed in transit, which matters when the units go to a dealer.',
                    'Answers about the curve' => 'Questions on usable width, lid seating or lead position are answered for the round body specifically rather than for the range in general.',
                ],
                'The shape of a cabinet should follow the product, not the other way round. Set against top rated manufacturers and best suppliers, the Agriculture Round deserves a question about usable flat area inside the rim and the depth of the lid overlap at the seam. Flat area and lid seating are the two questions that decide whether a round body is practical, and both have a straight answer.'
            ),
            'applications' => $block(
                'Agriculture Round is used where a circular charger body is already part of the product identity or where a compact shell suits a small board. It appears on field chargers sold through rural dealers, on replacement units for existing round models and on trial builds for a new variant. The common point is a board small enough to sit inside the curve without crowding. The <strong><a href="/category/agricultural-charger-cabinet">Agricultural Charger Cabinet</a></strong> page keeps the round uses beside the other field bodies, though the curve changes how much board fits.',
                [
                    'Round charger assembly' => 'The body is fitted where an agricultural charger is built with a circular housing and a compact board.',
                    'Round body renewal' => 'A cracked circular shell can be swapped while the original charger board and wiring stay in place.',
                    'Round model shelf stock' => 'A dealer can keep the circular body for farmers whose charger already has that silhouette.',
                    'OEM round variants' => 'A maker can plan a round-bodied variant once the board width and the lid line are confirmed.',
                    'Circular trial bodies' => 'A new round-front charger can be tried with its board before the moulding order moves beyond a sample.',
                ],
                'The round cabinet suits a small charger that has to look familiar and close reliably after service. Board width and transformer height settle the round body, the carton and the batch size. When the board needs its corners, a straighter Jhatka or Nexon body is the better answer than a larger circle.'
            ),
            'contact_us' => '<p>Send the charger board width, the transformer height and a photograph of the round profile to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>. Herritage Moulds will confirm the Agriculture Round body, the lid alignment and the packing needed for a dealer or seasonal delivery.</p>',
            'highlights' => [
                'Agriculture Round cabinet',
                'circular charger housing',
                'round field charger body',
                'compact round enclosure',
                'moulded round cabinet',
            ],
        ],
        'faqs' => [
            $faq('Which charger suits a circular Agriculture Round body?', 'It suits a compact agricultural charger whose product identity is already round, or a small board that fits the flat area inside the curve. A wide board with corner components is better served by a rectangular profile.'),
            $faq('Can the round cabinet be supplied to a dealer network?', 'For a dealer network, the total quantity, the carton type and the drop points set the delivery plan. The circular lids travel with their bodies so the rims arrive straight and the shape stays presentable on the shelf.'),
            $faq('What is the alternative when a wider board will not sit inside the circle?', 'Because the circular mould fixes the flat width, an adapter with components in its corners rarely suits the round shell and is usually moved to a straight-sided alternative. The limit is explained when the board is reviewed, and a Jhatka or Nexon shell is proposed if the curve leaves too little corner space.'),
            $faq('How is the Agriculture Round rim and lid checked?', 'The rim is inspected for a continuous seat, the lid for alignment on the circle and the exit for a clear lead path. Colour and compound are written into the offer so the new shell can be held against the old one.'),
            $faq('What details does an Agriculture Round quote need from the buyer?', 'Herritage Moulds quotes the round body from the board width, transformer height and quantity sent to herritagemoulds@gmail.com, and the reply includes the lid and packing detail.'),
        ],
        'meta' => $meta(
            'Agriculture Round',
            'Agriculture Round Charger Cabinet',
            'Circular moulded Agriculture Round charger cabinet for compact field boards, with a rim-seated lid and a short lead exit.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => 'CCTV 4 Channel SMPS',
        'slug' => 'cctv-4-channel-smps',
        'category' => 'cctv-channel-smps',
        'image' => 'products/cctv-4-channel-smps.webp',
        'source_image' => 'cctv-4-channel-smps.png',
        'sub_name' => 'CCTV 4 channel SMPS cabinet',
        'description' => $para(
            'A four-camera installation rarely has a dedicated equipment room, so the CCTV 4 Channel SMPS cabinet often ends up on a wall beside the recorder. The body has to keep the supply board and its four output terminals covered while leaving the camera leads easy to trace. Four channels also mean a terminal row long enough to need space at one edge. For the CCTV 4 Channel SMPS, top rated manufacturers and best suppliers are separated by how cleanly four camera cores reach the terminal row, and the <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> section sets that compact body beside the eight-channel version.',
            '<strong>Which part of a CCTV 4 Channel SMPS cabinet decides the fit?</strong> The board length and the terminal row decide more than the channel count, because four outputs can be arranged in a short block or spread along one edge. Add the space needed for four camera leads, the supply entry and the lid clearance, then check the result against the wall position. A cabinet that fits the board but leaves the terminals under the rim will slow every installation. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> section shows the four-way shell and its eight-way counterpart can be studied together before a specification is chosen.',
            '<strong>How does the cabinet help an installer trace a camera fault?</strong> The lid opens over the board and the terminal row, so a channel can be checked without taking the supply off the wall. Keeping each camera lead on its own route from the terminal to the entry makes a fault easier to follow, especially when four cables disappear into a ceiling. The closed body also keeps dust off the board in a shop or office position. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> listing gives the four-channel cabinet a place among the surveillance housings.',
            'A four-channel supply is often the first unit in a small site, and the cabinet has to make that installation straightforward. A reviewer weighing the CCTV 4 Channel SMPS through top rated manufacturers and best suppliers should ask for a terminal-row photograph, a lead-separation sketch and a carton sample used on real site deliveries. The answers matter more than a small difference in price. A four-channel order settled on the terminal row and the lead entries will not need a second visit to correct the housing.'
        ),
        'content' => [
            'sub_name' => 'CCTV 4 channel SMPS cabinet',
            'specification' => '<p>Four camera outputs share one moulded surveillance body in the CCTV 4 Channel SMPS, which is supplied with a lid that clears the terminal row. The board length, terminal row and the routes for four camera leads are checked before the body is dispatched.</p>',
            'features' => $block(
                'A four-channel cabinet is mostly about the terminal edge. The CCTV 4 Channel SMPS leaves that edge reachable, keeps the four camera leads on separate routes and provides a lid that opens without disturbing the wall fixing. Before choosing, buyers comparing top rated manufacturers and best suppliers for the CCTV 4 Channel SMPS should inspect the terminal row, the mains entry and the lid clearance as one assembly. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> page shows the four-channel body beside the larger unit, so the terminal row can be compared before the site visit.',
                [
                    'Four terminal positions' => 'The internal space leaves the output terminal row accessible, so each camera connection can be tightened without removing the board.',
                    'Recorder-side mounting' => 'The compact body suits a wall or panel position near the recorder, where a larger cabinet would intrude on the installation.',
                    'Camera lead separation' => 'The entries allow the four camera cables to leave on distinct routes, which makes a single channel easier to isolate.',
                    'Service lid access' => 'The lid opens over the board and terminals, so a channel check does not require the supply to be taken off its mounting.',
                    'Repeat four channel lots' => 'The same moulded body is used for each reorder, keeping the terminal position and lead entries familiar to the installer.',
                ],
                'Four outputs need order at the terminal edge, not just a box around the board. The CCTV 4 Channel SMPS is judged on terminal access, lead separation and lid clearance, because those decide how quickly an installer can finish the job. An installer can judge the housing in a minute by opening the lid and reaching the last terminal, which is the test top rated manufacturers and best suppliers should be willing to face.'
            ),
            'why_choose_us' => $block(
                'An installer remembers a cabinet that forces the supply off the wall to reach a terminal screw. The CCTV 4 Channel SMPS is planned so that the four connections and the supply entry stay reachable with the body in place. Weighing top rated manufacturers and best suppliers on terminal access reveals more about a surveillance body than the external dimensions printed in a catalogue. Herritage Moulds replies with a cabinet suggestion only after the supply pcb drawing and the screw terminal spacing arrive by email. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> page shows the four-channel body beside the eight-channel unit, which makes the terminal difference clear.',
                [
                    'Terminal row checked' => 'The board is reviewed with the terminal block in position, so the cabinet is not chosen on length and width alone.',
                    'Installer notes in the quote' => 'The quotation states the lead entry arrangement and the lid access, giving the installer a reference before the site visit.',
                    'Repeat installation lots' => 'A repeat order keeps the same terminal position, so a second site can be wired in the same sequence.',
                    'Packing for site delivery' => 'The bodies are packed with their lids and rims protected, because a cabinet that arrives scuffed is hard to present on a finished wall.',
                    'Answers for installers' => 'Questions about cable entries, terminal reach or wall position are answered against the board layout rather than a generic sheet.',
                ],
                'The best four-channel cabinet is the one that lets an installer finish without improvising. Buyers reviewing the CCTV 4 Channel SMPS against top rated manufacturers and best suppliers should ask for the terminal clearance, the lead entries and the packing in one reply. Terminal clearance, lead entries and packing are the three answers that let an installer plan a site without opening the box twice.'
            ),
            'applications' => $block(
                'The CCTV 4 Channel SMPS is used on small surveillance sites where four cameras are served by one supply: a shop, an office, a clinic or a single floor of a larger building. It also appears in service stock for installed units and in installer vans that carry a replacement housing. Once the body is on the wall, the four terminals and the camera cables are the only parts an installer can still reach. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> page keeps the small-site uses beside the eight-channel body, though the terminal row is what changes most.',
                [
                    'Small CCTV installations' => 'The cabinet is fitted where a four-camera supply serves a shop, office or single floor and the unit sits near the recorder.',
                    'Worn housing swaps' => 'A cracked body can be exchanged while the original supply board and the four camera cables stay exactly where the installer left them.',
                    'Installer van stock' => 'An installer can carry the four-channel cabinet as a spare, since it takes little space and matches common small-site supplies.',
                    'Shop and office upgrades' => 'A site adding a camera can keep the same cabinet where the existing supply still has a free output.',
                    'Four camera trial builds' => 'A new surveillance package can test the body with its supply before a larger order is placed.',
                ],
                'A small site still needs a supply that can be serviced without a return visit. The four-channel body keeps the terminals and the camera leads within reach while protecting the board from dust. Four cameras that grow to eight need a longer terminal bank rather than a second small cabinet.'
            ),
            'contact_us' => '<p>Send the four-channel board size, the terminal layout and the site quantity to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>. Herritage Moulds will reply with the CCTV 4 Channel SMPS option, the camera lead entries and a packing plan that suits an installer or a distribution order.</p>',
            'highlights' => [
                'CCTV 4 channel SMPS cabinet',
                'four camera supply housing',
                'small surveillance SMPS box',
                'terminal access CCTV cabinet',
                'moulded four channel body',
            ],
        ],
        'faqs' => [
            $faq('Which sites use the CCTV 4 Channel SMPS cabinet?', 'It suits a shop, office, clinic or single floor where four cameras share one supply and the unit is mounted near the recorder. The body keeps the terminal row reachable for the installer.'),
            $faq('How should a multi-site order for the four-channel body be arranged?', 'Several sites can be covered by one order once the installer gives the total unit count, the drop addresses and the carton protection each location needs. The same terminal position is kept across the batch, so installers meet a familiar layout on each site.'),
            $faq('Can the camera lead entries follow a revised terminal layout?', 'The entries are reviewed against the four terminal positions on the board. A revised terminal layout is reviewed against the existing tool, and any change that is possible is drawn before the batch is moulded.'),
            $faq('What does the final inspection cover on a CCTV 4 Channel SMPS?', 'The terminal opening, the four lead entries and the lid fit are inspected, and the body is trial-closed. Compound and colour are listed in the offer, giving the buyer a direct comparison with the body being replaced.'),
            $faq('What is needed for a CCTV 4 Channel SMPS quotation?', 'For a four-channel quotation, put the board size, the terminal drawing and the unit count in an email to herritagemoulds@gmail.com; Herritage Moulds replies with the body, entry plan and carton detail.'),
        ],
        'meta' => $meta(
            'CCTV 4 Channel SMPS',
            'CCTV 4 Channel SMPS Cabinet',
            'Moulded CCTV 4 channel SMPS cabinet for small surveillance supplies, with a reachable terminal row and separate camera lead entries.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => 'CCTV 8 Channel SMPS',
        'slug' => 'cctv-8-channel-smps',
        'category' => 'cctv-channel-smps',
        'image' => 'products/cctv-8-channel-smps.webp',
        'source_image' => 'cctv-8-channel-smps.png',
        'sub_name' => 'CCTV 8 channel SMPS cabinet',
        'description' => $para(
            'Eight cameras turn a surveillance supply into a cable-management problem as much as an electrical one. The CCTV 8 Channel SMPS cabinet carries a longer board and a terminal bank that fills one side, and the bundle leaving it is thicker than anything a four-channel box handles. The body has to keep the bank reachable while giving eight leads room to leave without pressing on the board. For the CCTV 8 Channel SMPS, top rated manufacturers and best suppliers are judged on how eight screw terminals and a thick camera bundle share the interior, a contrast the <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> index draws against the four-way body.',
            '<strong>How much room does an eight-channel terminal bank need?</strong> The bank itself may be twice the length of a four-channel row, and each screw needs clearance for a driver from above or the side. Add the supply entry and eight camera leads, then allow for the bend each cable needs at the exit. A cabinet that closes over the board but leaves the last terminal under the rim will be opened again on site. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> listings make the jump from four camera outputs to eight obvious in moulded form.',
            '<strong>How should eight camera leads be grouped at the cabinet?</strong> Group them by the direction they leave the site rather than bundling all eight into one tight sleeve. A pair of smaller groups bends more easily, puts less pull on the terminal bank and lets a technician isolate one run without disturbing the others. Leave a little slack inside the body so a cable can be moved aside when a terminal is checked. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> listing places the eight-channel cabinet with the smaller surveillance housing.',
            'A larger camera group is usually installed once and serviced for years, so the cabinet has to stay workable after the wall is closed up. Anyone comparing the CCTV 8 Channel SMPS through top rated manufacturers and best suppliers ought to inspect a sample with eight cores landed, then ask how a multi-site consignment is cushioned. Those details decide whether the next service visit is a short check or a dismantling job. An eight-channel order that names the bank length and the bundle size avoids the usual site surprise at the last terminal.'
        ),
        'content' => [
            'sub_name' => 'CCTV 8 channel SMPS cabinet',
            'specification' => '<p>Eight camera outputs meet a single moulded body in the CCTV 8 Channel SMPS, whose lid is shaped to clear the longer terminal bank. The longer terminal bank, the camera bundle and the clearance above the board are reviewed before the body is supplied.</p>',
            'features' => $block(
                'The terminal bank is the working edge of an eight-channel cabinet. The CCTV 8 Channel SMPS keeps that bank reachable, gives the larger camera bundle a wider exit and holds the supply cable on a separate route. Before fixing on outside size, buyers comparing top rated manufacturers and best suppliers for the CCTV 8 Channel SMPS should watch a technician land eight camera cores on the terminal bank. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> page puts the eight-channel body above the four-channel unit, where the longer bank is easy to compare.',
                [
                    'Eight terminal positions' => 'The internal width follows the longer output bank, so each of the eight connections can be reached with a driver.',
                    'Longer terminal bank' => 'The board seat is arranged so the bank does not sit under the lid rim, which keeps the last channel as accessible as the first.',
                    'Bundle entry width' => 'The camera exit is sized for a group of eight leads, reducing the need to force them through a slot made for a smaller supply.',
                    'Supply and camera separation' => 'The incoming supply has its own route, keeping it away from the camera bundle and making a fault easier to narrow down.',
                    'Repeat eight channel lots' => 'Each reorder follows the same bank position and entry width, so an integrator can wire a second site in the same order.',
                ],
                'An eight-channel cabinet is judged at the bank, not at the lid. The CCTV 8 Channel SMPS is checked on terminal reach, bundle width and supply separation, because a dense installation exposes any shortfall quickly. A dense bank is best judged with eight leads temporarily in place, because that is when a short entry or a hidden screw becomes obvious, and it is the test top rated manufacturers and best suppliers of surveillance bodies ought to accept.'
            ),
            'why_choose_us' => $block(
                'Dense wiring is where a cabinet earns or loses its place on the list an integrator keeps. The CCTV 8 Channel SMPS is planned with the bank and the bundle in view, so the eight leads can be landed without a fight and checked later without dismantling the supply. For a surveillance cabinet, ranking top rated manufacturers and best suppliers by terminal clearance tells an installer more than a wall-size comparison taken from a brochure. Herritage Moulds works from the terminal drawing rather than the channel count alone. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> page sets the eight-channel body beside the smaller housing, so the extra bank length is visible at a glance.',
                [
                    'Bank length reviewed' => 'The terminal block is measured on the board, so the cabinet is not chosen from a nominal eight-channel description.',
                    'Bundle route planned' => 'The camera exit and the internal path are agreed for the size of bundle the site will actually pull.',
                    'Repeat larger site lots' => 'A repeat order keeps the same bank and entry positions, which helps an integrator move a crew from one site to the next.',
                    'Packing for multi-site orders' => 'Bodies and lids are packed to protect the rims across a multi-drop delivery, since a damaged cover holds up an installation.',
                    'Answers on dense wiring' => 'Questions about cable grouping, terminal reach or supply separation are answered against the board rather than a general brochure.',
                ],
                'The eight-channel cabinet should make a dense installation calmer, not more crowded. Buyers assessing the CCTV 8 Channel SMPS on top rated manufacturers and best suppliers should ask for the bank clearance, the bundle exit and the packing plan together. Bank clearance, bundle exit and packing decide whether a multi-site order runs smoothly, and they should be written down before dispatch.'
            ),
            'applications' => $block(
                'The CCTV 8 Channel SMPS is used on sites where eight cameras share one supply: a multi-floor office, a school corridor group, a warehouse or a small campus. It also serves integrators who standardise on one supply size and service stock for installations already running. Mounted on a utility wall, the bank and the cable bundle are the two things a technician still has to reach. The <strong><a href="/category/cctv-channel-smps">CCTV Channel SMPS</a></strong> page keeps the larger uses with the four-channel body, though the bundle at the exit is what really changes.',
                [
                    'Larger surveillance sites' => 'The cabinet is fitted where eight cameras are served by one supply and the unit sits in a utility or ceiling position.',
                    'Multi-floor camera groups' => 'A building with cameras on more than one level can use the eight-channel body where the runs converge at a single supply point.',
                    'Damaged body swaps' => 'A cracked shell can be changed while the supply board and the eight camera cables remain connected at the terminal bank.',
                    'Integrator spare stock' => 'An integrator can hold the eight-channel body as a standard spare, reducing the number of housing variants carried.',
                    'Eight camera expansions' => 'A site adding cameras to an existing supply can keep the cabinet where the board still has capacity.',
                ],
                'These installations share a dense terminal bank and a bundle that has to leave in an orderly way. Board length and cable groups decide the cabinet, the carton and the delivery plan. Where four outputs are enough, the smaller body keeps the installation compact and the terminal row short.'
            ),
            'contact_us' => '<p>Send the eight-channel board size, the terminal bank layout and the number of sites to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>. Herritage Moulds will reply with the CCTV 8 Channel SMPS option, the bundle entry arrangement and a packing plan for a single site or a multi-drop order.</p>',
            'highlights' => [
                'CCTV 8 channel SMPS cabinet',
                'eight camera supply housing',
                'large surveillance SMPS box',
                'terminal bank CCTV cabinet',
                'moulded eight channel body',
            ],
        ],
        'faqs' => [
            $faq('Which installations are right for the CCTV 8 Channel SMPS?', 'It suits a site where eight cameras share one supply, such as a multi-floor office, a school, a warehouse or a small campus. The larger body keeps the terminal bank and the camera bundle workable.'),
            $faq('What is the best way to schedule the eight-channel body for several sites?', 'A multi-drop order starts with the number of sites, the order in which they are wired and the protection each carton needs on the way. The bank and entry positions stay the same, so a crew meets a familiar layout on each site.'),
            $faq('Can the bundle exit be widened for a particular cable group?', 'The exit is reviewed against the number and size of the camera leads expected. Where the tool permits a wider opening, the revised route is drawn and confirmed before the batch is moulded.'),
            $faq('Which checks does an eight-channel cabinet go through before dispatch?', 'The terminal bank opening, the bundle route and the lid clearance are inspected, and a lid is fitted to the body. The offer states the compound and colour, so the new body can be compared with the one already on the wall.'),
            $faq('How can I get a price for the CCTV 8 Channel SMPS?', 'Email the terminal drawing, the expected bundle size and the site count to herritagemoulds@gmail.com, and Herritage Moulds will answer with the eight-channel body and its packing plan.'),
        ],
        'meta' => $meta(
            'CCTV 8 Channel SMPS',
            'CCTV 8 Channel SMPS Cabinet',
            'Moulded CCTV 8 channel SMPS cabinet for eight-camera supplies, with a reachable terminal bank and a wider camera bundle exit.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => 'Screw Box Curve Line',
        'slug' => 'screw-box-curve-line',
        'category' => 'charger-adapter-cabinet',
        'image' => 'products/screw-box-curve-line.webp',
        'source_image' => 'screw-box-curve-line.png',
        'sub_name' => 'Screw Box Curve Line cabinet',
        'description' => $para(
            'Screw Box Curve Line is a curved adapter housing, and the curve is functional before it is decorative: it stiffens the wall, changes where the board can sit and gives the finished adapter a profile that stands apart from a plain rectangular box. The screw-fixed lid closes over a small board, and the shape has to leave enough flat area for the components and the output lead. For Screw Box Curve Line, top rated manufacturers and best suppliers are compared on how a curved shell follows the adapter outline, and the <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> index files the screw-fixed body with its straight-sided relatives.',
            '<strong>What should be checked before choosing a curved Screw Box Curve Line?</strong> The adapter board has to fit the flat part of the base, not the widest point of the curve, and the tallest component has to clear the lid at its lowest point. The output lead needs a straight path to the opening, and the screw positions must stay clear of any component. A curved shell that looks roomy from outside can still pinch a corner. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> page puts the screw-fixed curve next to the keyed regular body, so appearance and access can be weighed together.',
            '<strong>How is a curved screw box serviced?</strong> The lid is released with a screwdriver, and the board can be lifted once the lead is eased out of its opening. The curve gives the wall stiffness, but it also means the lid has to be seated along a shaped rim rather than dropped onto four corners, so the fit is checked before the screws are tightened. A technician who rushes that step can leave a gap at one end. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> listing compares the curve with a straight-walled adapter body, which matters when the board has corner components.',
            'The curved profile is worth having when it suits the product and the board, not when it is chosen for appearance alone. Screw Box Curve Line works for a compact adapter or component unit that needs a closed screw-fixed body and a shape that reads differently on a shelf. Buyers who assess Screw Box Curve Line on top rated manufacturers and best suppliers should ask for the flat board area, the lid seat and the lead opening before ordering. The curve is a design choice first and a fitting question second, and the flat seat is where that choice has to prove itself.'
        ),
        'content' => [
            'sub_name' => 'Screw Box Curve Line cabinet',
            'specification' => '<p>Screw Box Curve Line is a curved moulded adapter body with a screw-fixed lid. The flat base area, component height and output lead direction are compared before the curved shell is supplied.</p>',
            'features' => $block(
                'A curved housing is not simply a rectangular box with rounded sides; the curve takes space from the corners and adds stiffness to the wall. The Screw Box Curve Line uses that trade to hold a small adapter board on a flat base while keeping a distinctive outer line. Anyone ranking top rated manufacturers and best suppliers for the Screw Box Curve Line should put a populated adapter on the seat and test the screw bosses before ordering. On the <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> page, the curved screw body appears next to the regular option, letting a fitter weigh a shaped seat against a plain straight shell.',
                [
                    'Curved wall stiffness' => 'The shaped wall resists flexing better than a thin flat panel, which helps the housing keep its form when the lid screws are tightened.',
                    'Adapter board platform' => 'The base provides a flat seat for the adapter board, leaving the curved portion outside the component area rather than under it.',
                    'Screw fixed lid' => 'The lid is held by screws along the shaped rim, so it stays closed in storage and can be opened for a board check.',
                    'Output lead opening' => 'The cable exit is placed for a short run from the adapter terminal, keeping the lead clear of the curved wall.',
                    'Curved shell reorders' => 'A repeat lot uses the original curve tool, keeping the flat seat and the opening in the same place.',
                ],
                'The curve should help the assembly, not compete with it. The Screw Box Curve Line is judged on flat board area, lid seating and lead exit, because a shaped shell leaves less margin for a misplaced component. A curved housing is easy to draw and harder to fit, so the flat seat is the first figure to check against the board, and the point on which top rated manufacturers and best suppliers of curved shells should be judged.'
            ),
            'why_choose_us' => $block(
                'A curved adapter cabinet is usually chosen for a product that needs to look different, but the choice only works if the inside is practical. The Screw Box Curve Line is quoted with the flat base area and the lid seat described, so the buyer can see where the board will sit. Judged that way, top rated manufacturers and best suppliers of an adapter shell are separated by seat flatness and screw bosses rather than by surface finish alone. Herritage Moulds asks for the adapter board before confirming the shell. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> page places the curved shell beside the regular lockable body, which makes the seat difference easy to judge.',
                [
                    'Curve checked with board' => 'The board footprint is compared with the flat part of the base, so a component near the corner is not left hanging over the curve.',
                    'Lid and screw review' => 'The lid seat and the screw positions are checked against the component height before the order, reducing the chance of a lid that will not close.',
                    'Repeat adapter lots' => 'A reorder uses the same curve and screw points, keeping the finished product and the assembly routine consistent.',
                    'Packing for shaped shells' => 'The curved bodies are packed with the lids so the rim is supported, since a distorted curve is difficult to correct later.',
                    'Curve-specific replies' => 'A question about flat area, lid seating or lead position is answered for this shaped shell, not for a generic adapter box.',
                ],
                'A distinctive housing only sells once when it is difficult to assemble; a practical one sells again. Against top rated manufacturers and best suppliers, the Screw Box Curve Line invites a check on how much straight seat remains for an adapter board and whether its lid closes flush. Appearance may win the first order, but the flat area and the lid seat win the reorder.'
            ),
            'applications' => $block(
                'The Screw Box Curve Line is used on small adapter and component products where a curved shell is part of the design. It suits an adapter board built into a compact housing, a charger accessory with a shaped body and a replacement cover for a product already on the market. Each use needs a flat seat and a lid that closes on the curve. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> page keeps the curved uses beside the regular lockable body, though the curve changes the flat area available.',
                [
                    'Adapter board assembly' => 'The body is used where a small adapter board and its output lead are built into a curved screw-fixed housing.',
                    'Compact charger accessories' => 'A charger accessory with a shaped outline can use the body where the board fits the flat base area.',
                    'Curved shell renewal' => 'A marked or cracked curved body can be exchanged without disturbing the adapter board inside it.',
                    'OEM curved batches' => 'A maker can plan a repeat batch once the board, lid seat and lead exit have been confirmed.',
                    'Profile trial units' => 'A new curved design can be tested with the board before a larger moulding order is placed.',
                ],
                'These products share a small board and a shaped outer line. The cabinet has to keep the board flat, the lid seated and the lead short, or the curve becomes a liability. Where a simpler outline is preferred, the regular lockable body offers straight walls and a keyed lid.'
            ),
            'contact_us' => '<p>Send the adapter board footprint, the component height and the preferred lead direction to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>. Herritage Moulds will confirm the Screw Box Curve Line body, the flat seat area and the packing needed for a shaped shell order.</p>',
            'highlights' => [
                'Screw Box Curve Line cabinet',
                'curved adapter housing',
                'screw fixed curved shell',
                'compact adapter enclosure',
                'moulded curve line box',
            ],
        ],
        'faqs' => [
            $faq('Which products use the Screw Box Curve Line body?', 'It suits a compact adapter board or charger accessory that is built into a curved screw-fixed housing. The flat base area, rather than the outer curve, decides whether the board fits.'),
            $faq('Can the curved cabinet be ordered in production quantities?', 'Production quantities are planned from the monthly draw, the carton type and the delivery date. The curve, screw points and lead exit stay the same across the batch, so the assembly routine does not change.'),
            $faq('What is the alternative when the curve leaves too little flat space?', 'The curve limits how much flat area an adapter board can use, so a layout with bulky corner parts normally ends up in a squared housing instead. That limit is explained at enquiry stage, and the regular cabinet is suggested where the curve cannot take the board.'),
            $faq('How is the Screw Box Curve Line shell inspected?', 'The flat seat, the shaped rim and the lead opening are checked, and the lid is screwed down to test the seam. Compound and colour appear in the offer, so the buyer can set them beside the shell being replaced.'),
            $faq('What information is needed for a Screw Box Curve Line quote?', 'The adapter footprint, the component height and the order quantity are all Herritage Moulds needs at herritagemoulds@gmail.com to quote the curved body, its seat and its packing.'),
        ],
        'meta' => $meta(
            'Screw Box Curve Line',
            'Screw Box Curve Line Adapter Cabinet',
            'Curved moulded Screw Box Curve Line cabinet for compact adapter boards, with a flat seat, screw-fixed lid and short lead opening.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    [
        'title' => 'Lock Regular Cabinet',
        'slug' => 'lock-regular-cabinet',
        'category' => 'charger-adapter-cabinet',
        'image' => 'products/lock-regular-cabinet.webp',
        'source_image' => 'lock-regular-cabinet.png',
        'sub_name' => 'Lock Regular Cabinet',
        'description' => $para(
            'Lock Regular Cabinet adds a controlled opening to a plain adapter housing. The regular profile keeps the unit simple to mount and stack, while the locking lid decides who can reach the board inside. That combination suits an adapter or small component unit that should not be opened casually but still has to be serviced by someone with the key. For Lock Regular Cabinet, top rated manufacturers and best suppliers are compared on key travel, lid fit and the room left around the adapter board, and the <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> index lists the keyed body among the adapter housings.',
            '<strong>When is a locking lid worth specifying?</strong> It is worth considering where an adapter sits in a shared area, a retail counter or a equipment cupboard that other people can reach. The lock discourages casual opening; it is not a substitute for keeping a key with the person responsible for service. The useful check is whether the key can be turned without the lid flexing and whether the board can still be reached once the lid is open. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> page puts the keyed regular body beside the curved screw box, so the different opening methods can be compared.',
            '<strong>How does the lock affect service and lid fit?</strong> The keyed lid has to be opened before the board can be inspected, so the lock position should leave room for the key and the hand that turns it. A lock placed too close to a wall or a cable entry turns a simple check into a struggle. Inside, the board still needs a flat seat and the output lead a clear exit, because the lock does not solve a crowded layout. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> listing shows the lockable model with the other adapter housings.',
            'The lock is only useful when the rest of the cabinet works without it. Lock Regular Cabinet is chosen for an adapter or component unit that needs controlled access and a regular outline, and it is judged on the key clearance, the lid seat and the board space together. Buyers who review Lock Regular Cabinet on top rated manufacturers and best suppliers should ask how the lock sits, how the lid closes and how the unit is packed. A lock that is awkward to reach is worse than no lock, so the key swing has to be part of the first drawing.'
        ),
        'content' => [
            'sub_name' => 'Lock Regular Cabinet',
            'specification' => '<p>Lock Regular Cabinet is a regular moulded adapter body with a locking lid. The lock position, key clearance and board space are checked together before the cabinet is supplied.</p>',
            'features' => $block(
                'A lock changes the way a cabinet is handled, so it has to be designed with the hand and the key in mind. The Lock Regular Cabinet provides a keyed lid on a straight body, keeps the board on a flat seat and leaves the output lead a clear exit. Buyers comparing top rated manufacturers and best suppliers for the Lock Regular Cabinet should check the key swing and the lid seat before the shell size. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> page displays the keyed housing next to the curved screw box, so key position and screw access can be judged on the same screen.',
                [
                    'Locking lid arrangement' => 'The lid carries a keyed closure, so the adapter can be kept closed against casual opening between service visits.',
                    'Regular profile body' => 'The straight outline keeps the unit easy to mount and stack, without the corner space lost by a curved shell.',
                    'Adapter board space' => 'The base gives the adapter board a flat seat while leaving room for the output lead and the lock mechanism.',
                    'Key access clearance' => 'The lock is positioned so a key can be turned without the lid flexing or the hand fouling a cable entry.',
                    'Repeat lock batches' => 'Each reorder follows the same lock position and body shape, so a replacement unit is operated in the same way.',
                ],
                'A lock is a small part of the cabinet but a large part of the routine. The Lock Regular Cabinet is judged on the key clearance, the lid seat and the board space, because a lock that is awkward to use is soon left open. A keyed lid is only useful if the key turns freely after the cabinet is mounted, and that is a question for the drawing, one that separates top rated manufacturers and best suppliers of lockable bodies.'
            ),
            'why_choose_us' => $block(
                'Controlled access is easy to promise and harder to build into a small housing. The Lock Regular Cabinet is planned with the key swing, the lid seat and the lead exit visible in the quotation, so the buyer knows how the unit will be opened and closed. A keyed adapter body is better assessed by putting top rated manufacturers and best suppliers through the lock, lid and board space together instead of reading a lock description. Herritage Moulds asks where the cabinet will be mounted before confirming the position. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> page places the lockable body with the regular adapter shells, so the access difference is easy to see.',
                [
                    'Lock position reviewed' => 'The lock is checked against the mounting face and the cable entry, so the key can be used without moving the cabinet.',
                    'Key access explained' => 'The quotation describes how the lid opens and where the key is turned, which helps the buyer plan who will hold it.',
                    'Repeat secure lots' => 'A reorder keeps the same lock position and lid fit, so a replacement unit does not need a new set of instructions.',
                    'Packing for lock parts' => 'The lids are packed to protect the lock and the rim, because a damaged closure can make the whole cabinet unusable.',
                    'Key access replies' => 'A question about the lock, the lid or the board space is answered for this keyed body, not for a plain adapter box.',
                ],
                'The best locking cabinet is the one that is opened when it should be and closed without a struggle. Buyers assessing the Lock Regular Cabinet on top rated manufacturers and best suppliers should ask for the key clearance, the lid seat and the lock position in one reply. The lock, the lid seat and the board space are decided together, because a change to one alters the room left for the others.'
            ),
            'applications' => $block(
                'Lock Regular Cabinet is used where an adapter or small component unit needs a closed body and a lid that is not opened casually. That can be a counter position, a shared equipment cupboard, a rental unit or a product where the settings should stay as they were left. The regular outline also suits a unit that has to sit flat or stack with others. The <strong><a href="/category/charger-adapter-cabinet">Charger Adapter Cabinet</a></strong> page keeps the controlled-access uses with the curved adapter shell, though the key changes where the unit can sit.',
                [
                    'Controlled access adapters' => 'The cabinet is used where an adapter board should stay closed between service visits and the key is held by a responsible person.',
                    'Shared equipment points' => 'A unit in a shared cupboard or counter area can use the locking lid to discourage casual handling.',
                    'Keyed body renewal' => 'A damaged lockable shell can be exchanged while the adapter board and the existing key routine stay as they were.',
                    'OEM locked variants' => 'A maker can plan a locked version of an adapter product once the lock position and board space are confirmed.',
                    'Keyed model spares' => 'A counter can keep the lockable body for customers whose adapter already uses that casing.',
                ],
                'These uses depend on a cabinet that protects the board and controls the lid without making service difficult. Mounting position and board size settle the lock, the carton and the quantity in one pass. Where a keyed lid is not required, the curved screw-fixed body covers the same board with a simpler opening.'
            ),
            'contact_us' => '<p>Send the adapter board size, the mounting position and the access requirement to <a href="mailto:herritagemoulds@gmail.com">herritagemoulds@gmail.com</a>. Herritage Moulds will confirm the Lock Regular Cabinet option, the lock position and the packing needed for a controlled-access order.</p>',
            'highlights' => [
                'Lock Regular Cabinet',
                'lockable adapter housing',
                'regular profile cabinet',
                'keyed lid enclosure',
                'controlled access cabinet',
            ],
        ],
        'faqs' => [
            $faq('Where is a Lock Regular Cabinet normally used?', 'It suits an adapter or small component unit in a shared cupboard, a counter area or a rental product where the lid should not be opened casually. The key stays with the person responsible for service.'),
            $faq('Can the lockable cabinet be ordered as a repeat item?', 'Repeat orders keep the same lock position and body shape, with the carton and delivery plan agreed in advance. A replacement unit then follows the same opening routine as the first.'),
            $faq('What can be done if the mounting position makes the key awkward to reach?', 'The lock is checked against the mounting face and the cable entry. Where the tool allows a move, the new position is confirmed on a drawing so the key can still be turned in place.'),
            $faq('How is the Lock Regular Cabinet closure tested?', 'The lid is fitted and the lock operated to check the key swing and the seam. The body, the lock type and the colour are named in the offer, so the replacement can be checked against the unit already in use.'),
            $faq('How do I request a Lock Regular Cabinet quotation?', 'The adapter board size, the mounting position and the order quantity go to herritagemoulds@gmail.com, and Herritage Moulds answers with the lockable body, the key clearance and the packing.'),
        ],
        'meta' => $meta(
            'Lock Regular Cabinet',
            'Lock Regular Cabinet for Adapter Units',
            'Lock Regular Cabinet with a keyed lid for adapter and component units, offering controlled access in a straight moulded profile.'
        ),
        'seo' => true,
        'featured' => true,
        'explore' => false,
    ],
    // __END_PRODUCTS__
];

return $products;
