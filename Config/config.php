<?php

return [
    'name' => 'OvhApi',
    
    'ovh_config' => [
        'applicationKey' => env('OVH_APP_LOCATION_KEY'),
        'applicationSecret' => env('OVH_APP_LOCATION_SECRET'),
        'consumer_key' => env('OVH_CONSUMER_KEY'),
        'end-points' => ['ca' => 'ovh-ca'],
        
        'projects' => [
            'A' => env('OVH_APP_PROJECT_A'),
            ],
        'network_ids' => [
            'A' => [['networkId' => env('OVH_APP_NETWORK_A')]]
        ],
        
        'regions' => ['BHS3' => 'BHS3']
    ]
];

