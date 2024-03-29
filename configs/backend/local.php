<?php

namespace Application;

return [
    'db'                       => [
        'host'     => {{ .Values.mysql.host | quote }},
        'dbname'   => {{ .Values.mysql.database | quote }},
        'username' => {{ .Values.mysql.username | quote }},
        'password' => {{ .Values.mysql.password | quote }},
    ],
    'caches' => [
        'fastCache' => [
            'options'  => [
                'server'   => [
                    'host' => {{ printf "%s-master" (include "common.names.fullname" .Subcharts.redis) | quote }},
                ],
            ],
        ],
        'longCache' => [
            'options'  => [
                'server'   => [
                    'host' => {{ printf "%s-master" (include "common.names.fullname" .Subcharts.redis) | quote }},
                ],
            ],
        ],
    ],
    'imageStorage'             => [
        's3'          => [
            'endpoint'    => [
                {{- range .Values.s3.endpoints }}
                    {{- if .visible }}
                    {{ printf "https://%s" .hostname | quote}},
                    {{- end }}
                {{- end }}
            ],
            'credentials' => [
                'key'    => {{ .Values.s3.key | quote }},
                'secret' => {{ .Values.s3.secret | quote }},
            ],
        ],
    ],
    'fileStorage'              => [
        's3'          => [
            'endpoint'    => [
                {{- range .Values.s3.endpoints }}
                {{- if .visible }}
                    {{ printf "https://%s" .hostname | quote}},
                {{- end }}
                {{- end }}
            ],
            'credentials' => [
                'key'    => {{ .Values.s3.key | quote }},
                'secret' => {{ .Values.s3.secret | quote }},
            ],
        ],
    ],
    'mosts_min_vehicles_count' => {{ .Values.mostsMinVehiclesCount }},
    'force_https'              => false,
    'users'                    => [
        'salt'      => {{ .Values.usersSalt | quote }},
        'emailSalt' => {{ .Values.emailSalt | quote }},
    ],
    'hosts'              => [
        'en'    => [
            'hostname' => 'en.wheelsage.org',
            'aliases'  => [
                'wheelsage.org',
                'www.wheelsage.org',
            ],
        ],
        'zh'    => [
            'hostname' => 'zh.wheelsage.org',
            'aliases'  => [],
        ],
        'ru'    => [
            'hostname' => 'www.autowp.ru',
            'aliases'  => [],
        ],
        'pt-br' => [
            'hostname' => 'br.wheelsage.org',
            'aliases'  => [],
        ],
        'fr'    => [
            'hostname' => 'fr.wheelsage.org',
            'aliases'  => [],
        ],
        'be'    => [
            'hostname' => 'be.wheelsage.org',
            'aliases'  => [],
        ],
        'uk'    => [
            'hostname' => 'uk.wheelsage.org',
            'aliases'  => [],
        ],
        'es'    => [
            'hostname' => 'es.wheelsage.org',
            'aliases'  => [],
        ],
        'it'    => [
            'hostname' => 'it.wheelsage.org',
            'aliases'  => [],
        ],
        'he'    => [
            'hostname' => 'he.wheelsage.org',
            'aliases'  => [],
        ],
    ],
    'sentry'                   => [
        'dsn'         => {{ .Values.backend.sentry.dsn | quote }},
        'environment' => 'production',
    ],
    'recaptcha'                => [
        'publicKey'  => {{ .Values.reCaptcha.publicKey | quote }},
        'privateKey' => {{ .Values.reCaptcha.privateKey | quote }},
    ],
    'captcha'                  => true,
    'vk'                       => [
        'token'    => {{ .Values.vk.token | quote }},
        'owner_id' => {{ .Values.vk.ownerId | quote }},
    ],
    'facebook'           => [
        'app_id'            => {{ .Values.facebook.clientId | quote }},
        'app_secret'        => {{ .Values.facebook.clientSecret | quote }},
        'page_access_token' => {{ .Values.facebook.pageAccessToken | quote}},
    ],
    'twitter'            => [
        'username'     => {{ .Values.twitter.username | quote}},
        'oauthOptions' => [
            'consumerKey'    => {{ .Values.twitter.key | quote}},
            'consumerSecret' => {{ .Values.twitter.secret | quote}},
        ],
        'token'        => [
            'oauth_token'        => {{ .Values.twitter.oauthToken | quote}},
            'oauth_token_secret' => {{ .Values.twitter.oauthSecret | quote}},
        ],
    ],
    'telegram'           => [
        'accessToken' => {{ .Values.telegram.accessToken | quote }},
        'token'       => {{ .Values.telegram.webhookToken | quote }},
        'webhook'     => {{ (printf "https://www.autowp.ru/api/telegram/webhook/token/%s" .Values.telegram.webhookToken) | quote }},
    ],
    'mail'                     => [
        'transport' => [
            'type'    => 'smtp',
            'options' => [
                'host'              => {{ .Values.smtp.hostname | quote }},
                'connection_class'  => 'login',
                'connection_config' => [
                    'username' => {{ .Values.smtp.username | quote }},
                    'password' => {{ .Values.smtp.password | quote }},
                    'ssl'      => 'tls',
                ],
            ],
        ],
    ],
    'rabbitmq'        => [
        'host'     => {{ include "common.names.fullname" .Subcharts.rabbitmq | quote }},
    ],
    'traffic'                  => [
        'url' => 'http://{{ include "autowp.goautowp.serve-private.fullname" . }}:8081',
    ],
    'feedback'                 => [
        'to' => {{ .Values.feedback.to | quote }},
    ],
    'keycloak'                 => [
        'url'   => "https://auth.wheelsage.org",
        'realm' => "autowp",
    ],
];
