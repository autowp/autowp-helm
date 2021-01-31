<?php

namespace Application;

return [
    'db'                       => [
        'dbname'   => 'autowp',
        'username' => {{ .Values.mysql.username | quote }},
        'password' => {{ .Values.mysql.password | quote }},
    ],
    'caches' => [
        'fastCache' => [
            'adapter' => [
                'options'  => [
                    'servers'   => [
                        'main' => [
                            'host' => {{ include "autowp.memcached.fullname" . | quote }},
                        ],
                    ],
                ],
            ],
        ],
        'longCache' => [
            'adapter' => [
                'options'  => [
                    'servers'   => [
                        'main' => [
                            'host' => {{ include "autowp.memcached.fullname" . | quote }},
                        ],
                    ],
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
    'mosts_min_vehicles_count' => 200,
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
        ],
        'ru'    => [
            'hostname' => 'www.autowp.ru',
        ],
        'pt-br' => [
            'hostname' => 'br.wheelsage.org',
        ],
        'fr'    => [
            'hostname' => 'fr.wheelsage.org',
        ],
        'be'    => [
            'hostname' => 'be.wheelsage.org',
        ],
        'uk'    => [
            'hostname' => 'uk.wheelsage.org',
        ],
    ],
    'authSecret' => {{ .Values.auth.secret | quote}},
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
    'yandex'                   => [
        'secret' => {{ .Values.yandexMoney.secret | quote }},
        'price'  => {{ .Values.yandexMoney.price }},
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
        'host'     => {{ include "autowp.rabbitmq.fullname" . | quote }},
    ],
    'traffic'                  => [
        'url' => 'http://goautowp-serve-private:8081',
    ],
    'feedback'                 => [
        'to' => {{ .Values.feedback.to | quote }},
    ],
];
