@php
    $info = $commons['contact']['additional_info'] ?? [];
    $site = $commons['site']['content'] ?? [];
    $phone = $info['mobile_numbers'][0]['number'] ?? '+919891076555';
    $page = $cleanUrl->page ?? 'home';
    $detailTitle = $detailTitle ?: null;
    $pageLabel = $page === 'index' ? 'home' : str_replace('-', ' ', $page);
    $detailLabel = $detailTitle ? ' - ' . $detailTitle : '';
    $message = $site['whatsapp_message']
        ?? 'Hi, I came across your website and have a few enquiries regarding page : {page}{detail}. I would like to get some more information. Could you please assist me with the details?';
    $message = str_replace(['{page}', '{detail}'], [$pageLabel, $detailLabel], $message);
    $message .= "\n\nPage URL: " . url()->current();
    $whatsappUrl = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $phone) . '?text=' . rawurlencode($message);
@endphp

<!-- fixed cta start -->
<div class="fixed-cta">

    <!-- whatsapp start -->
    <a href="{{ $whatsappUrl }}"
       target="_blank"
       rel="noopener noreferrer"
       class="fixed-cta-item fixed-whatsapp"
       aria-label="WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
        <span>WhatsApp</span>
    </a>
    <!-- whatsapp end -->

    <!-- call start -->
    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $phone) }}"
       class="fixed-cta-item fixed-call"
       aria-label="Call">
        <i class="fa-solid fa-phone"></i>
        <span>Call Us</span>
    </a>
    <!-- call end -->

</div>
<!-- fixed cta end -->
