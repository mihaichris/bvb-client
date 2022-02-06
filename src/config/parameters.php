<?php

use DI\Container;

return [
    'bvb.baseUrl' => 'https://bvb.ro',
    'bvb.instrumentPath' => '/FinancialInstruments/Details/FinancialInstrumentsDetails.aspx?s=',
    'bvb.instrumentUrl' => function (Container $container) {
        return $container->get('bvb.baseUrl') . $container->get('bvb.instrumentPath');
    },
    'bvb.api.baseUrl' => 'https://wapi.bvb.ro',
    'bvb.api.ticker.historyUrl' => function (Container $container) {
        return $container->get('bvb.api.baseUrl') .
            '/api/history?symbol=%s&dt=INTRA&p=intraday_1&ajust=1&from=%d&to=%d';
    },
    'http.client.defaultParameters' => function (Container $container) {
        return ['headers' => ['Referer' => $container->get('bvb.baseUrl')]];
    },
];
