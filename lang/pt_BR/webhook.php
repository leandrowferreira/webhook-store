<?php

return [
    'title' => 'Webhook Store',
    'subtitle' => 'Sistema de captura de webhooks para desenvolvimento',
    'navigation' => [
        'dashboard' => 'Dashboard',
        'webhooks' => 'Webhooks',
        'home' => 'Início',
    ],
    'dashboard' => [
        'title' => 'Dashboard de Webhooks',
        'description' => 'Monitore e gerencie todas as requisições webhook recebidas',
        'empty' => [
            'title' => 'Nenhum webhook',
            'description' => 'Comece enviando uma requisição webhook para',
            'get_started' => 'Para começar, envie uma requisição webhook para',
        ],
    ],
    'table' => [
        'headers' => [
            'id' => 'ID',
            'method' => 'Método',
            'url' => 'URL',
            'timestamp' => 'Data/Hora',
            'content_type' => 'Tipo de Conteúdo',
            'body' => 'Corpo',
            'actions' => 'Ações',
        ],
        'actions' => [
            'view_details' => 'Ver Detalhes',
            'back' => 'Voltar',
        ],
    ],
    'pagination' => [
        'items_per_page' => 'Itens por página:',
        'showing' => 'Mostrando',
        'to' => 'a',
        'of' => 'de',
        'results' => 'resultados',
        'previous' => 'Anterior',
        'next' => 'Próxima',
    ],
    'details' => [
        'title' => 'Detalhes do Webhook',
        'subtitle' => 'Informações completas da requisição',
        'sections' => [
            'basic_info' => 'Informações Básicas',
            'headers' => 'Cabeçalhos HTTP',
            'query_parameters' => 'Parâmetros de Query',
            'body' => 'Corpo da Requisição',
        ],
        'fields' => [
            'id' => 'ID',
            'method' => 'Método HTTP',
            'url' => 'URL Completa',
            'clean_url' => 'URL Limpa',
            'timestamp' => 'Data/Hora',
            'content_type' => 'Tipo de Conteúdo',
            'user_agent' => 'User Agent',
            'ip_address' => 'Endereço IP',
            'origin' => 'Origem',
            'content_length' => 'Tamanho do Conteúdo',
            'no_headers' => 'Nenhum cabeçalho adicional',
            'no_query_params' => 'Nenhum parâmetro de query',
            'no_body' => 'Nenhum corpo de requisição',
            'bytes' => 'bytes',
        ],
    ],
    'footer' => [
        'developed_with' => 'Desenvolvido com',
        'by' => 'por',
    ],
    'common' => [
        'unknown' => 'Desconhecido',
        'none' => 'Nenhum',
        'empty' => 'Vazio',
    ],
];
