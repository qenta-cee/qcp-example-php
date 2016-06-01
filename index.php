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

require_once("includes/config.inc.php");
require_once("includes/function.inc.php");

// sets request parameters regarding the shop
$requestParameters["customerId"] = $shop["customerId"];
$requestParameters["shopId"] = $shop["shopId"];

// sets request parameters regarding the order
$requestParameters["amount"] = "99.99";
$requestParameters["currency"] = "EUR";
$requestParameters["orderDescription"] = "Jane Doe (33562), Order: 5343643-034";
$requestParameters["customerStatement"] = "Your Shopname: Order: 5343643-034";
$requestParameters["orderReference"] = "5343643-034";

// sets request parameters regarding the handling of the transaction
$requestParameters["duplicateRequestCheck"] = "no";
// $requestParameters["autoDeposit"] = "yes";
// $requestParameters["maxRetries"] = "3";

// sets request parameters regarding the URLs
$requestParameters["successUrl"] = getBaseUrl() . "return.php#success";
$requestParameters["cancelUrl"] = getBaseUrl() . "return.php#cancel";
$requestParameters["failureUrl"] = getBaseUrl() . "return.php#failure";
$requestParameters["pendingUrl"] = getBaseUrl() . "return.php#pending";
$requestParameters["serviceUrl"] = getBaseUrl() . "service.html";

// sets request parameters regarding confirmations of orders
$requestParameters["confirmUrl"] = getBaseUrl() . "confirm.php";
// $requestParameters["confirmMail"] = "set.your@mail-address.com"; // not used because of using confirmUrl

// sets request parameters regarding the user interface
$requestParameters["language"] = "en";
$requestParameters["displayText"] = "Thank you very much for your order.";
$requestParameters["imageUrl"] = getBaseUrl() . "ui/logo.png";
// $requestParameters["layout"] = "smartphone"; // "desktop", "tablet" or "smartphone" are valid values
// $requestParameters["paymentTypeSortOrder"] = "CCARD,ELV,EPS,SOFORTUEBERWEISUNG,INVOICE,INSTALLMENT,PAYPAL";

// sets your custom request parameters
$requestParameters["shopname_customParameter1"] = "your first custom parameter";
$requestParameters["shopname_customParameter2"] = "your second custom parameter";

// Sets always at last the request paramters regarding security,
// because these uses values of the above defined request parameters.
$requestParameters["requestFingerprintOrder"] = getRequestFingerprintOrder($requestParameters);
$requestParameters["requestFingerprint"] = getRequestFingerprint($requestParameters, $shop["secret"]);
?>
<html>
<head>
    <title>Wirecard Checkout Page Demo</title>
    <link rel="stylesheet" type="text/css" href="ui/styles.css">
</head>
<body>
<h1>Wirecard Checkout Page Demo</h1>

<form action="https://checkout.wirecard.com/page/init.php" method="post" name="form">
    <?php
    // adds the request parameters as hidden form fields to this form
    foreach ($requestParameters as $key => $value) {
        echo "\n<input type='hidden' name='$key' value='$value' />\n";
    }
    ?>
    <input type="hidden" name="windowName" value=""/>
    <script>document.form.windowName.value = window.name;</script>
    <table border="1" bordercolor="lightgray" cellpadding="10" cellspacing="0">
        <tr>
            <td align="right"><b>Order description</b></td>
            <td><?php echo $requestParameters["orderDescription"] ?></td>
        </tr>
        <tr>
            <td align="right"><b>Amount</b></td>
            <td><?php echo $requestParameters["amount"] ?>&nbsp;<?php echo $requestParameters["currency"] ?></td>
        </tr>
        <tr>
            <td align="right"><b>Payment type</b></td>
            <td>
                <select name="paymenttype">
                    <?php
                    // adds the list of activated payment types as options to the drop-down field
                    foreach ($paymentTypes as $key => $value) {
                        echo "<option value='$key'>$value</option>\n";
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td colspan="2" align="right"><input type="submit" value="Checkout"/></td>
        </tr>
    </table>
</form>
<p>
    This is a simple checkout page for demonstration purposes only.
    It displays the order description, amount, currency, a selection for a payment type
    and offers a "Checkout" button for the consumer to start the checkout process via Wirecard.
</p>

<p>
    To integrate the Wirecard Checkout Page to your web shop, please read the
    <a href="https://integration.wirecard.at/" target="_blank">Online Guide</a> very carefully
    and set the parameters according to your requirements and your configuration
    settings obtained from Wirecard. Additionally there you can find a list of demo data,
    which can be used for testing this example with demo credit cards and other payment types
    without doing a real purchase.
</p>

<p>
    If you have any questions or troubles regarding the integration please do not
    hesitate to contact our support teams.
</p>

<p>
    Please consider that this checkout page example is configured for demonstration purposes only,
    so there are no real purchases done and also the demo transactions are not displayed
    within the Wirecard Payment Center. To change to a production environment you have to
    change the customerId and the secret according to the values obtained from Wirecard.
</p>

<p>
    To start a checkout please press the button "Checkout". By default you will see a list of
    all supported payment types by Wirecard Checkout Page. Otherwise you are also able
    to select one of the payment types in the drop-down list and then press the "Checkout"
    button to go directly to a specific payment type.
</p>
</body>
</html>
