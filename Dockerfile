FROM themadbox/php:7.1

RUN apt-get update -y
RUN apt-get install -y vim wget
RUN cd /tmp && wget https://github.com/DataDog/dd-trace-php/releases/download/0.5.0/datadog-php-tracer_0.5.0-beta_amd64.deb
RUN apt install /tmp/datadog-php-tracer_0.5.0-beta_amd64.deb
RUN cp /etc/php/7.1/cli/conf.d/ddtrace.ini /etc/php/7.1/fpm/conf.d/