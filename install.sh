#!/bin/bash

set -e

kubectl -n autowp apply -f volumes.yaml

helm -n autowp upgrade --install --create-namespace autowp . -f values.production.yaml
