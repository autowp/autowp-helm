{{- define "imagePullSecret" }}
{{- with .Values.imageCredentials }}
{{- printf "{\"auths\":{\"%s\":{\"username\":\"%s\",\"password\":\"%s\",\"email\":\"%s\",\"auth\":\"%s\"}}}" .registry .username .password .email (printf "%s:%s" .username .password | b64enc) | b64enc }}
{{- end }}
{{- end }}

{{- define "localImagePullSecret" }}
{{- with .Values.localImageCredentials }}
{{- printf "{\"auths\":{\"%s\":{\"username\":\"%s\",\"password\":\"%s\",\"email\":\"%s\",\"auth\":\"%s\"}}}" .registry .username .password .email (printf "%s:%s" .username .password | b64enc) | b64enc }}
{{- end }}
{{- end }}

{{- define "autowp.backend.fullname" -}}
{{- printf "%s-backend" (include "common.names.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.frontend.fullname" -}}
{{- printf "%s-frontend" (include "common.names.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.imagePullSecrets" -}}
{{- include "common.images.pullSecrets" (dict "images" (list .Values.backend.image .Values.backend.nginx.image .Values.frontend.image) "global" .Values.global) -}}
{{- end -}}

{{- define "autowp.backend.image" -}}
{{ include "common.images.image" (dict "imageRoot" .Values.backend.image "global" .Values.global) }}
{{- end -}}

{{- define "autowp.backend.nginx.image" -}}
{{ include "common.images.image" (dict "imageRoot" .Values.backend.nginx.image "global" .Values.global) }}
{{- end -}}

{{- define "autowp.frontend.image" -}}
{{ include "common.images.image" (dict "imageRoot" .Values.frontend.image "global" .Values.global) }}
{{- end -}}

{{- define "autowp.goautowp.fullname" -}}
{{- printf "%s-goautowp" (include "common.names.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.autoban.fullname" -}}
{{- printf "%s-autoban" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.listen-df-amqp.fullname" -}}
{{- printf "%s-listen-df-amqp" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.listen-monitoring-amqp.fullname" -}}
{{- printf "%s-listen-monitoring-amqp" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.scheduler-daily.fullname" -}}
{{- printf "%s-scheduler-daily" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.scheduler-hourly.fullname" -}}
{{- printf "%s-scheduler-hourly" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.scheduler-midnight.fullname" -}}
{{- printf "%s-scheduler-midnight" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.scheduler-generate-brands-cache.fullname" -}}
{{- printf "%s-scheduler-generate-brands-cache" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.serve-private.fullname" -}}
{{- printf "%s-serve-private" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.serve-public.fullname" -}}
{{- printf "%s-serve-public" (include "autowp.goautowp.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.goautowp.image" -}}
{{ include "common.images.image" (dict "imageRoot" .Values.goautowp.image "global" .Values.global) }}
{{- end -}}

{{- define "autowp.static.fullname" -}}
{{- printf "%s-static" (include "common.names.fullname" .) | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.static.image" -}}
{{ include "common.images.image" (dict "imageRoot" .Values.static.image "global" .Values.global) }}
{{- end -}}
