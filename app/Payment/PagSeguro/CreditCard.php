<?php 

namespace App\Payment\PagSeguro;


class CreditCard{
    
    private $items;
    private $user;
    private $cardInfo;
    private $reference;

    public function __construct($items, $user, $cardInfo, $reference){
        $this->items = $items;
        $this->user = $user;
        $this->cardInfo = $cardInfo;
        $this->reference = $reference;
    }

    public function doPayment(){
        
        $creditCard = new \PagSeguro\Domains\Requests\DirectPayment\CreditCard();

       
        $creditCard->setReceiverEmail(env('PAGSEGURO_EMAIL'));
        $creditCard->setReference(base64_encode($this->reference));
        $creditCard->setCurrency("BRL");

        
        foreach($this->items as $item){
            $creditCard->addItems()->withParameters(
                $item['id'],
                $item['name'],
                $item['amount'],
                $item['price']
            );
        }

        
        
        $user = $this->user;
        $email = env('PAGSEGURO_ENV') == 'sandbox' ? 'c98334096010161335947@sandbox.pagseguro.com.br' : $user->email;


        $creditCard->setSender()->setName($user->name);
        $creditCard->setSender()->setEmail($email);
        
        $creditCard->setSender()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setSender()->setDocument()->withParameters(
            'CPF',
            '04973452181'
        );

        $creditCard->setSender()->setHash($this->cardInfo['hash']);

        $creditCard->setSender()->setIp('127.0.0.0');

        $cont = 0;
        
        
        foreach($user->addresses as $addresses){
            $address = [
                'street' => $addresses->street,
                'number' => $addresses->number,
                'district' => $addresses->district,
                'zip_code' => $addresses->zip_code,
                'city' => $addresses->city,
                'complement' => $addresses->complement
            ];
        };
        
        
        $creditCard->setShipping()->setAddress()->withParameters(
            $address['street'],
            $address['number'],
            $address['district'],
            $address['zip_code'],
            $address['city'],
            'GO',
            'BRA',
            $address['complement'],
            

            /* 'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114' */
        );

        
        $creditCard->setBilling()->setAddress()->withParameters(
            $address['street'],
            $address['number'],
            $address['district'],
            $address['zip_code'],
            $address['city'],
            'GO',
            'BRA',
            $address['complement'],
            
            
            /*'Av. Brig. Faria Lima',
            '1384',
            'Jardim Paulistano',
            '01452002',
            'São Paulo',
            'SP',
            'BRA',
            'apto. 114' */
        );

      
        $creditCard->setToken($this->cardInfo['card_token']);

        
        list($quantity, $installmentAmount) = explode('|', $this->cardInfo['installment']);
        
        $installmentAmount = number_format($installmentAmount, 2, '.', ''); 

        //dd($installmentAmount);
        $creditCard->setInstallment()->withParameters($quantity, $installmentAmount, 2);
        //Instância paramentro  nointerestInstallment colocando a quantidade de parcelas nele.
        $creditCard->setHolder()->setBirthdate('01/10/1979');
        $creditCard->setHolder()->setName($this->cardInfo['card_name']); 
        $creditCard->setHolder()->setPhone()->withParameters(
            11,
            56273440
        );

        $creditCard->setHolder()->setDocument()->withParameters(
            'CPF',
            #'04973452181'
            $this->cardInfo['card_cpf']
        );
        
       //dd($creditCard);
       
        $creditCard->setMode('DEFAULT');


        $result = $creditCard->register(
            \PagSeguro\Configuration\Configure::getAccountCredentials()
        );
        
        return $result;

    }
}