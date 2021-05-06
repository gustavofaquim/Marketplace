<?php

namespace App\Payment\PagSeguro;

class Boleto{


    private $items;
    private $user;
    private $reference;
    private $senderHash;

    public function __construct($items, $user,$reference, $senderHash){
        $this->items = $items;
        $this->user = $user;
        $this->reference = $reference;
        $this->senderHash = $senderHash;
    }


    public function doPayment(){

        //Instantiate a new Boleto Object
        $boleto = new \PagSeguro\Domains\Requests\DirectPayment\Boleto();

        // Set the Payment Mode for this payment request
        $boleto->setMode('DEFAULT');

        /**
         * @todo Change the receiver Email
         */
        
         $boleto->setReceiverEmail(env('PAGSEGURO_EMAIL')); 

        // Set the currency
        $boleto->setCurrency("BRL");

        // Add an item for this payment request
        foreach($this->items as $item){
            $boleto->addItems()->withParameters(
                $item['id'],
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }

        // Set a reference code for this payment request. It is useful to identify this payment
        // in future notifications.
        $boleto->setReference(base64_encode($this->reference));

        //set extra amount
        //$boleto->setExtraAmount(11.5);

        // Set your customer information.
        // If you using SANDBOX you must use an email @sandbox.pagseguro.com.br

        $user = $this->user;
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'c98334096010161335947@sandbox.pagseguro.com.br' : $user->email;

        $boleto->setSender()->setName($user->name);
        $boleto->setSender()->setEmail($email);

        $boleto->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $boleto->setSender()->setDocument()->withParameters(
            'CPF',
            '04973452181'
        );

        $boleto->setSender()->setHash($this->senderHash);

        $boleto->setSender()->setIp('127.0.0.0');

        // Set shipping information for this payment request
        $boleto->setShipping()->setAddress()->withParameters(
            'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114'
        );

        $result = $boleto->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );

        return $result;
    
    }

}