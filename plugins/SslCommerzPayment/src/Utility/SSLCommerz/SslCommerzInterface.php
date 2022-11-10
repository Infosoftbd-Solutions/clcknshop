<?php

namespace SslCommerzPayment\Utility\SSLCommerz;

interface SslCommerzInterface
{
    public function makePayment(array $data);

    public function setParams($data);

    public function setRequiredInfo(array $data);

    public function setCustomerInfo(array $data);

    public function setShipmentInfo(array $data);

    public function setProductInfo(array $data);

    public function setAdditionalInfo(array $data);

    public function callToApi($data, $header = [], $setLocalhost = false);
}
