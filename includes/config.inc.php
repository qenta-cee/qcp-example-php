<?php
/**
 * QPay Checkout Page Demo
 * - Terms of use can be found under
 * https://guides.qenta.com/prerequisites
 * - License can be found under:
 * https://github.com/qenta-cee/qcp-example-php/blob/master/LICENSE.
 */
$api['endpoint'] = getenv("ENDPOINT") ?: "https://api.qenta.com/page/init.php";
$common['baseUrl'] = getBaseUrl();
$shop['orderNumber'] = substr_replace(substr(str_shuffle(time()), 0, 10), '-', 7, 0);

// sets your customerId
//   For testing purposes please use "D200001" as value and for production
//   please change to your personal customerId you will receive from QENTA.
$shop['customerId'] = getenv("CUSTOMER_ID") ?: "D200001";

// sets your shopId which is required, when you are using several
// shops or shop-configurations within the same customerId
$shop['shopId'] = getenv("SHOP_ID") ?: "";

// sets your personal pre-shared key
// PLEASE NEVER SEND THS KEY BY EMAIL OR AS POST-PARAMETER IN A FORM!
//   For testing purposes please use "B8AKTPWBRMNBV455FG6M2DANE99WU2" as value
//   and for production please change to your personal secret you will
//   receive from QENTA.
$shop['secret'] = getenv("SECRET") ?: "B8AKTPWBRMNBV455FG6M2DANE99WU2";


// sets the list of activated payment types for your shop
//   For testing purposes you are able to use all of these payment types,
//   in production please use only that payment types you ordered via QENTA.
$paymentTypes['SELECT'] = 'Select within QPay Payment Page';
$paymentTypes['BANCONTACT_MISTERCASH'] = 'Bancontact/Mister Cash';
$paymentTypes['C2P'] = 'CLICK2PAY';
$paymentTypes['CCARD'] = 'Credit Card';
// $paymentTypes["CCARD-MOTO"] = "Credit Card Mail Order, Telephone Order";
$paymentTypes['EKONTO'] = 'eKonto';
$paymentTypes['EPS'] = 'EPS';
$paymentTypes['GIROPAY'] = 'giropay';
$paymentTypes['IDL'] = 'iDEAL';
$paymentTypes['INSTALLMENT'] = 'Installment';
$paymentTypes['INVOICE'] = 'Invoice';
$paymentTypes['MAESTRO'] = 'Maestro SecureCode';
$paymentTypes['MASTERPASS'] = 'Masterpass';
$paymentTypes['MONETA'] = 'moneta.ru';
$paymentTypes['PAYPAL'] = 'PayPal';
$paymentTypes['PBX'] = 'Paybox';
$paymentTypes['POLI'] = 'POLi payments';
$paymentTypes['PRZELEWY24'] = 'Przelewy24';
$paymentTypes['PSC'] = 'Paysafecard';
$paymentTypes['QUICK'] = '@Quick';
$paymentTypes['SEPA-DD'] = 'SEPA Direct Debit';
$paymentTypes['SKRILLWALLET'] = 'Skrill Digital Wallet';
$paymentTypes['SOFORTUEBERWEISUNG'] = 'SOFORT';
$paymentTypes['TRUSTLY'] = 'Trustly';
