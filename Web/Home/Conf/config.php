<?php
return array(
	'TMPL_TEMPLATE_SUFFIX' => '.php',
    'URL_ROUTER_ON'  => true,
    'URL_MAP_RULES' => [
        'star' => 'Star/index',
    ],
    'URL_ROUTE_RULES' => [
        'designer/:id|base64_decode'   => 'Index/designer',
        'casedetail/:id|base64_decode' => 'Index/caseDetail',
        'craftview/:type'              => 'Index/craftview',
        'caselist/:type'               => 'Index/caseList',
        'article/:id|base64_decode'    => 'Index/article',
    ],
);