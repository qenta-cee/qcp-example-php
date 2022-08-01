# QPay Checkout Page integration example

[![License](https://img.shields.io/badge/license-GPLv3-blue.svg)](https://raw.githubusercontent.com/qenta-cee/qcp-example-php/master/LICENSE)
[![PHP v7.4](https://img.shields.io/badge/php-v7.4-green.svg)](https://www.php.net)

This example demonstrates the usage of QPAY Checkout Page and provides a basis for integration into PHP-based systems.

Our [Online Guides](https://guides.qenta.com/ "Online Guides") provide an in depth description of the [QPAY Checkout Page](https://guides.qenta.com/products/page/ "QPAY Checkout Page").

## Installation

Copy the example code to a web server which supports PHP. Ensure that the web server is accessible from the Internet via port 80 (for http communication) or port 443 (for https communication). The web server needs a fully qualified domain name for receiving data from Qenta (e.g. payment confirmations).

### Docker 
Required: Docker _and_ [docker-compose](https://docs.docker.com/compose/install/)

Recommended: [ngrok](https://ngrok.com)

######  Demo Configuration
Run ```docker-compose up``` to start the `qcp-example-php`  Application locally with our demo configuration.

######  Test Configuration
The Repository features a `.env.example` File with our test configuration. The `qcp-example-php` Application can be started with our test configuration by running ```docker-compose --env-file .env.example up```.

######  Custom Configuration
In order to use the `qcp-example-php` Application with your own Qenta Configuration you need to run ```cp .env.example .env``` and change the corresponding values in the `.env` File with the values representing your Qenta Configuration. Afterwards a simple ```docker-compose up``` will start the `qcp-example-php` App with your Configuration.


The webserver is accessible at `http://localhost:8000`.

To receive a payment confirmation you need a FQDN. We recommend to use [ngrok](https://ngrok.com).
Run `ngrok http http://localhost:8000` to get an externally reachable URL.

## Support and additional information

If you have any questions or troubles to get this example up and running in your web server environment, please do not hesitate to contact our [support teams](https://guides.qenta.com/contact "support teams").

## Relevant files

### Configuration

*File: [includes/config.inc.php](includes/config.inc.php)*

The necessary configuration values are defined in a configuration file. This file is included in the other PHP files which depend on these values.

Creating a separate file for these variables enables the use of the values when starting the payment process and also when retrieving and verifying the result of the payment process. Additionally we strongly encourage you to move this configuration file containing the secret to a folder on your web server where it cannot be accessed from outside!

After closing the contract change the specific parameters you received from our support teams in the configuration file. 

**Keep the file(s) where your secret is defined in a folder which cannot be accessed from users visiting your web server.**


### Payment process initiation

*File: [index.php](index.php)*

The required and optional request parameters used for the specific payment process are defined in a different file. Please have a look at [Request Parameters](https://guides.qenta.com/parameters/frontend/request-parameters/) for more details on the parameters which can be defined. These parameters are then used as hidden fields in the HTML-form which is presented to the consumer of your online shop. 

Your consumer may then select one of the offered payment methods and start the payment process by submitting the values to QPay Checkout Page. If all required parameters are set and the fingerprint is verified, the payment process is started and your consumer is guided through the process.


### Receiving and storing the payment process result

*File: [return.php](return.php)*

The PHP file for receiving and storing the result of the payment process for your online shop is called by QPay Checkout Page. We strongly recommend that you use the possibility to set the optional request parameter `confirmUrl` so that you are able to store the result independently of the behavior of your consumer during the redirect to the `successUrl`, `cancelUrl`, `pendingUrl` or `failureUrl`.

*File: [confirm.php](confirm.php)*

The `confirmUrl` is called by QENTA informing your online shop about the result of the payment process.

This file consists of the following functional steps:
* Including the previously created and already used configuration file.
* Executing the function `handleCheckoutResult`. This function
  * Checks the availability of the return parameter `paymentState`.
  * Validates the response parameters with the function `areReturnParametersValid`, if the resulting state is "SUCCESS" or "PENDING",  which
    * creates a fingerprint based on the parameter order as given in the return parameter `responseFingerprintOrder` and the values of all mentioned values in it.
    * compares the value of the return parameter `responseFingerprint` and the computed fingerprint.
  * Writes the results and the response parameter and their values into the file *confirmation.log*.


### Additional files

You may also use the additional files in the example package for testing purposes and replace them later with your specific content:

File name | Description
--- | ---
[ui/logo.png](ui/logo.png)     | Your logo of your online shop which will be displayed on the QPay Checkout Page.
[service.html](service.html)    | This HTML page is shown to your consumer, if your consumer clicks on your logo within QPay Checkout Page.
