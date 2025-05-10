<?php
$companies = \App\Models\Company::pluck('company_name', 'id')->toArray();
$projects = \App\Models\Project::pluck('name', 'id')->toArray();
$employees = \App\Models\Employee::pluck('employee_name', 'id')->toArray();
return [
    [
        'name' => 'company_id',
        'type' => 'select',
        'label' => 'Company',
        'options' => $companies,
    ],
    [
        'name' => 'project_id',
        'type' => 'select',
        'label' => 'Project',
        'options' => [],
    ],
    [
        'name' => 'employees',
        'type' => 'select-multiple',
        'label' => 'Employee',
        'options' => [],
    ],
    [
        'name' => 'name',
        'type' => 'text',
        'label' => 'Location name',
    ],
    [
        'name' => 'latitude',
        'type' => 'number',
        'step' => 'any',
        'label' => 'Latitude',
    ],
    [
        'name' => 'longitude',
        'type' => 'number',
        'step' => 'any',
        'label' => 'Longitude',
    ],
    [
        'name' => 'radius',
        'type' => 'number',
        'step' => 'any',
        'label' => 'Radius',
    ],
];
