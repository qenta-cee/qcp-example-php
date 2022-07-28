<?php
/**
 * QPay Checkout Page Demo
 * - Terms of use can be found under
 * https://guides.qenta.com/
 * - License can be found under:
 * https://github.com/qenta-cee/qcp-example-php/blob/master/LICENSE.
 */
$api['endpoint'] = getenv('QCP_ENDPOINT') ?: 'https://api.qenta.com/page/init.php';
$common['baseUrl'] = getenv('QCP_BASEURL') ?: getBaseUrl();
$shop['orderNumber'] = getenv('QCP_ORDER_NUMBER') ?: substr_replace(substr(str_shuffle(time()), 0, 10), '-', 7, 0);

// sets your customerId
//   For testing purposes please use "D20git l0001" as value and for production
//   please change to your personal customerId you will receive from QENTA.
$shop['customerId'] = getenv('QCP_CUSTOMER_ID') ?: 'D200001';

// sets your shopId which is required, when you are using several
// shops or shop-configurations within the same customerId
$shop['shopId'] = getenv('QCP_SHOP_ID') ?: '';
$withBasket = getenv('QCP_INCLUDE_BASKET') ?: true;
// sets your personal pre-shared key
// PLEASE NEVER SEND THS KEY BY EMAIL OR AS POST-PARAMETER IN A FORM!
//   For testing purposes please use "B8AKTPWBRMNBV455FG6M2DANE99WU2" as value
//   and for production please change to your personal secret you will
//   receive from QENTA.
$shop['secret'] = getenv('QCP_SHOP_SECRET') ?: 'B8AKTPWBRMNBV455FG6M2DANE99WU2';

// sets the list of activated payment types for your shop
//   For testing purposes you are able to use all of these payment types,
//   in production please use only that payment types you ordered via QENTA.
$paymentTypes['SELECT'] = 'Choose later on Payment Page';
// $paymentTypes['AFTERPAY'] = 'AfterPay';
$paymentTypes['CCARD'] = 'Credit Card';
// $paymentTypes["CCARD-MOTO"] = "Credit Card Mail Order, Telephone Order";
$paymentTypes['EPS'] = 'EPS';
$paymentTypes['INSTALLMENT'] = 'Installment';
$paymentTypes['INVOICE'] = 'Invoice';
$paymentTypes['PAYPAL'] = 'PayPal';
$paymentTypes['PRZELEWY24'] = 'Przelewy24';
$paymentTypes['PSC'] = 'Paysafecard';
// $paymentTypes['CRYPTO'] = 'Salamantex';
$paymentTypes['SEPA-DD'] = 'SEPA Direct Debit';
$paymentTypes['SOFORTUEBERWEISUNG'] = 'SOFORT';
$paymentTypes['AFTERPAY'] = 'AFTERPAY';
$paymentTypes['CRYPTO'] = 'CRYPTO';
$paymentTypes['CVSPHARMACY']    = 'CVSPHARMACY';
$paymentTypes['DOLLARGENERAL']  = 'DOLLARGENERAL';
$paymentTypes['CIRCLEK']        = 'CIRCLEK';
$paymentTypes['OPENBUCKSCARD']  = 'OPENBUCKSCARD';
$paymentTypes['PAGOEFECTIVO']   = 'PAGOEFECTIVO';
$paymentTypes['SAFETYPAY']      = 'SAFETYPAY';
