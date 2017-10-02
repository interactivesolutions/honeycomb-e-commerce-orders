<?php
return [
    'page_title'                  => 'Užsakymai',
    'order_state_id'              => 'Užsakymo būsena',
    'order_payment_status_id'     => 'Užsakymo apmokėjimo statusas',
    'user_id'                     => 'Vartotojas',
    'reference'                   => 'Užsakymo kodas',
    'payment'                     => 'Mokėjimo būdas',
    'total_price'                 => 'Viso kaina',
    'total_price_before_tax'      => 'Viso kaina be mokesčių',
    'total_price_tax_amount'      => 'Viso kainos mokesčių kiekis',
    'total_discounts'             => 'Viso nuolaidų',
    'total_discounts_before_tax'  => 'Viso nuolaidų be mokesčių',
    'total_discounts_tax_amount'  => 'Viso nuolaidų mokesčių kiekis',
    'total_paid'                  => 'Viso sumokėta',
    'total_paid_before_tax'       => 'Viso sumokėta be mokesčių',
    'total_paid_tax_amount'       => 'Viso sumokėta mokesčių kiekis',
    'order_note'                  => 'Papildoma užsakymo informacija',
    'order_history_note'          => 'Užsakymo pastabos / komentaras',
    'total_unit_price'            => 'Viso vieneto kaina',
    'total_unit_price_before_tax' => 'Viso vieneto kaina be mokesčių',
    'total_unit_price_tax_amount' => 'Viso vieneto kaina mokesčių kiekis',

    'order'          => 'Užsakymas',
    'order_date'     => 'Užsakymo data',
    'state'          => 'Būsena',
    'payment_status' => 'Apmokėjimo statusas',
    'view_content'   => 'Žiūrėti informaciją',

    'tabs' => [
        'status' => 'Statusas',
        'info'   => 'Informacija',
    ],

    'errors' => [
        'order_canceled'                        => 'Užsakymas jau atšauktas. Daugiau nieko negalite padaryti.',
        'payment_accepted_and_order_state_null' => 'Po sėkmingo apmokėjimo užsakymo būsena turi būti nepasirinkta. (užsakymo būseną nustatys sistema)',

        'not_ready_for_processing'                => '"Užsakymą vykdymui" galima pasirinkti tik tada, kai užsakymo statusas yra  "paruoštas vykdymui"',
        'not_ready_for_shipment_after_processing' => '"Paruošta siuntimui" galima pasirinkti tik tada, kai užsakymo statusas yra "vykdomas"',
        'not_ready_for_shipment'                  => '"Užsakymas išsiųtas" galima pasirinkti tik tada, kai užsakymo statusas yra "Paruošta išsiųsti"',
        'not_ready_for_delivered'                 => '"Užsakymas pristatytas" galima pasirinkti tik tada, kai užsakymo statusas yra "išsiųstas"',
        'waiting_for_stock_only_cancel'           => 'Kai užsakymo būsena yra "Laukiama prekių papildymo" užsakymą galima tik atšaukti.',
    ],
];