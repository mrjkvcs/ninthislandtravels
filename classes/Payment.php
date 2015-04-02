<?php namespace App;

use Omnipay\Omnipay;

class Payment {

    public $data;
    public $product;
    public $price;
    public $gateway;

    public function __construct($productId)
    {
        $product = \Product::find($productId);

        $this->gateway = Omnipay::create('PayPal_Express');

        $this->gateway->setUsername(PaypalConfig::API_USERNAME);
        $this->gateway->setPassword(PaypalConfig::API_PASSWORD);
        $this->gateway->setSignature(PaypalConfig::API_SIGNATURE);
        $this->gateway->setTestMode(PaypalConfig::SANDBOX_MODE);

        $this->product = $product->name;
        $this->price = $product->price;

        $this->data = [
            'cancelUrl'   => 'http://' . $_SERVER['SERVER_NAME'] . '/cancel.php',
            'returnUrl'   => 'http://' . $_SERVER['SERVER_NAME'] . '/paypal.php',
            'description' => $this->product,
            'amount'      => (float) $this->price,
            'currency'    => 'USD'
        ];
    }

    /**
     * Settings payPal
     *
     * @return mixed
     */
    public function payPal()
    {
        $response = $this->gateway->purchase($this->data)->send();

        $_SESSION['data']['user_id'] = $this->createUser($_SESSION['data'])->id;

        $response->redirect();
    }

    /**
     * @param $data
     * @return static
     */

    public function createUser($data)
    {
        $data['paid'] = null;

        return \User::create($data);
    }

    /**
     * Success payment
     */
    public function success()
    {
        $response = $this->gateway->completePurchase($this->data)->send();

        $data = $response->getData();

        $this->check($data);

        header('Location: http://' . $_SERVER['HTTP_HOST']);
        exit;
    }

    /**
     * @param $data
     */
    protected function insert($data)
    {
        \Payment::create([
            'user_id'          => $_SESSION['data']['user_id'],
            'product_id'       => $_SESSION['data']['product_id'],
            'checkin_at'       => $_SESSION['data']['checkin_at'],
            'transaction_id'   => $data['PAYMENTINFO_0_TRANSACTIONID'],
            'transaction_type' => $data['PAYMENTINFO_0_TRANSACTIONTYPE'],
            'order_time'       => $data['PAYMENTINFO_0_ORDERTIME'],
            'amt'              => $data['PAYMENTINFO_0_AMT'],
            'fee_amt'          => $data['PAYMENTINFO_0_FEEAMT'],
            'payments_status'  => $data['PAYMENTINFO_0_PAYMENTSTATUS'],
            'pending_reason'   => $data['PAYMENTINFO_0_PENDINGREASON'],
            'reason_code'      => $data['PAYMENTINFO_0_REASONCODE'],
            'merchant_id'      => $data['PAYMENTINFO_0_SECUREMERCHANTACCOUNTID'],
            'error_code'       => $data['PAYMENTINFO_0_ERRORCODE'],
            'ack'              => $data['PAYMENTINFO_0_ACK'],
        ]);

        unset($_SESSION['data']);
    }

    /**
     * @param $data
     */
    protected function check($data)
    {
        if ($data['PAYMENTINFO_0_PAYMENTSTATUS'] != 'Completed')
        {
            $_SESSION['unSuccess'] = 1;
        } else
        {
            $_SESSION['success'] = 1;
            $this->update();
            $this->insert($data);
        }
    }

    /**
     *
     */
    protected function update()
    {
        $user = \User::find($_SESSION['data']['user_id']);

        $user->paid = date("Y-m-d");

        $user->save();
    }


}
