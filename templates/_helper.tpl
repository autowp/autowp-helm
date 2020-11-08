{{- define "autowp.memcached.fullname" -}}
{{- printf "%s-%s" .Release.Name "memcached" | trunc 63 | trimSuffix "-" -}}
{{- end -}}

{{- define "autowp.rabbitmq.fullname" -}}
{{- printf "%s-%s" .Release.Name "rabbitmq" | trunc 63 | trimSuffix "-" -}}
{{- end -}}
