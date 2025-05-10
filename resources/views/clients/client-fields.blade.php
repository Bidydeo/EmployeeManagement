<?php
$companies = \App\Models\Company::pluck('company_name', 'id')->toArray();
return [
    [
        'name' => 'name',
        'type' => 'text',
        'label' => 'Client Name',
    ],
    [
        'name' => 'email',
        'type' => 'text',
        'label' => 'Client Email',
    ],
    [
        'name' => 'country',
        'type' => 'text',
        'label' => 'Client country',
    ],
    [
        'name' => 'companies',
        'type' => 'select-multiple',
        'label' => 'Company',
        'options' => $companies,
    ],
];
