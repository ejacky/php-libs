<?php

use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';

$hosts = [
    '10.98.2.118:9200',         // IP + Port
//    '192.168.1.2',              // Just IP
//    'mydomain.server.com:9201', // Domain + Port
//    'mydomain2.server.com',     // Just Domain
//    'https://localhost',        // SSL to localhost
//    'https://192.168.1.3:9200'  // SSL to IP + Port
];

$client = ClientBuilder::create()
    ->setHosts($hosts)
    ->build();

try {
    $searchParams = [
        'index' => 'ip_weak',
        'type' => 'ip_weak',
        'body' => [
//            'query' => [
//                'match' => [
//                    'ipv4_addr' => '10.98.2.27'
//                ]
//            ],
            'aggregations' => [
                'significant_terms' => ['field' => 'source_id']
            ],
        ]

    ];
    print_r($client->search($searchParams));
} catch (Elasticsearch\Common\Exceptions\Curl\CouldNotConnectToHost $e) {
    $previous = $e->getPrevious();
    if ($previous instanceof Elasticsearch\Common\Exceptions\MaxRetriesException) {
        echo "Max retries!";
    }
}