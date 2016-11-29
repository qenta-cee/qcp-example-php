<?php
//--------------------------------------------------------------------------------//
//                                                                                //
// Wirecard Central Eastern Europe GmbH                                           //
// www.wirecard.at                                                                //
//                                                                                //
// THIS CODE AND INFORMATION ARE PROVIDED "AS IS" WITHOUT WARRANTY OF ANY         //
// KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE            //
// IMPLIED WARRANTIES OF MERCHANTABILITY AND/OR FITNESS FOR A                     //
// PARTICULAR PURPOSE.                                                            //
//                                                                                //
//--------------------------------------------------------------------------------//

// sets your customerId
//   For testing purposes please use "D200001" as value and for production
//   please change to your personal customerId you will receive from Wirecard.
$shop["customerId"] = "D200001";

// sets your shopId which is required, when you are using several
// shops or shop-configurations within the same customerId
$shop["shopId"] = "";

// sets your personal pre-shared key
// PLEASE NEVER SEND THS KEY BY EMAIL OR AS POST-PARAMETER IN A FORM!
//   For testing purposes please use "B8AKTPWBRMNBV455FG6M2DANE99WU2" as value
//   and for production please change to your personal secret you will
//   receive from Wirecard.
$shop["secret"] = "B8AKTPWBRMNBV455FG6M2DANE99WU2";

// sets the list of activated payment types for your shop
//   For testing purposes you are able to use all of these payment types,
//   in production please use only that payment types you ordered via Wirecard.
$paymentTypes["SELECT"] = "Select within Wirecard Payment Page";
$paymentTypes["BANCONTACT_MISTERCASH"] = "Bancontact/Mister Cash";
$paymentTypes["C2P"] = "CLICK2PAY";
$paymentTypes["CCARD"] = "Credit Card";
// $paymentTypes["CCARD-MOTO"] = "Credit Card Mail Order, Telephone Order";
$paymentTypes["EKONTO"] = "eKonto";
$paymentTypes["EPS"] = "EPS";
$paymentTypes["GIROPAY"] = "giropay";
$paymentTypes["IDL"] = "iDEAL";
$paymentTypes["INSTALLMENT"] = "Installment";
$paymentTypes["INVOICE"] = "Invoice";
$paymentTypes["MAESTRO"] = "Maestro SecureCode";
$paymentTypes["MASTERPASS"] = "MasterPass";
$paymentTypes["MONETA"] = "moneta.ru";
$paymentTypes["PAYPAL"] = "PayPal";
$paymentTypes["PBX"] = "Paybox";
$paymentTypes["POLI"] = "POLi payments";
$paymentTypes["PRZELEWY24"] = "Przelewy24";
$paymentTypes["PSC"] = "Paysafecard";
$paymentTypes["QUICK"] = "@Quick";
$paymentTypes["SEPA-DD"] = "SEPA Direct Debit";
$paymentTypes["SKRILLWALLET"] = "Skrill Digital Wallet";
$paymentTypes["SOFORTUEBERWEISUNG"] = "sofort.com";
$paymentTypes["TRUSTLY"] = "Trustly";
