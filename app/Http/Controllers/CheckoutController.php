<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Payment\PagSeguro\CreditCard;
use App\Payment\PagSeguro\Boleto;
use App\Payment\PagSeguro\Notification;
use \App\Models\Store;
use \App\Events\UserOrderedItems;
use \App\Models\UserOrder;

class CheckoutController extends Controller
{
    public function index(){

        try{
            if(!auth()->check()){
                return redirect()->route('login');
            }
    
            //Não tendo nada no carrinho não é permitido acessar o pagina de compra
            if(!session()->has('cart')){
                return redirect()->route('home');
            }
    
            $this->makePagSeguroSession();
            //var_dump(session()->get("pagseguro_session_code"));
    
    
            $cartItems = array_map(function($line){
                $price = number_format($line['price'], 2, '.', '');
                $price = $line['amount'] * $price;
                $total = number_format($price, 2,'.','');
                return $total;
            }, session()->get('cart'));


            
            $cartItems = array_sum($cartItems);
            $cartItems = number_format($cartItems,2,'.','');
           

            //return view('checkout_mercado', ['cartItems'=> $cartItems]);
            return view('checkout', ['cartItems'=> $cartItems]);

        }catch(\Exception $e){
            session()->forget('pagseguro_session_code');
            redirect()->route('checkout.index');
        }
    }

    
    // Mercado Pago
    public function index_mercado(){
        return view('checkout_mercado');
    }



    public function mercado_process(Request $request){
        
        require '../vendor/autoload.php';
        
        $data = $request->all();
        $user = auth()->user();
        $cartItems = session()->get('cart');
        $stores = array_unique(array_column($cartItems, 'store_id'));
        $reference = uniqid(rand(), false);
        
        \MercadoPago\SDK::setAccessToken("TEST-7977807413081421-062317-ae988d2221aafc58cd5fa9c1cb858f63-780153727");
        
        
        /*//Produtos
        $item = new \MercadoPago\Item();
        $item->id = "1234";
        $item->title = "Heavy Duty Plastic Table";
        $item->description = "Table is made of heavy duty white plastic and is 96 inches wide and 29 inches tall";
        $item->category_id = "home";      //https://api.mercadopago.com/item_categories#json
        $item->quantity = 7;
        $item->currency_id = "BRL";
        $item->unit_price = 75.56; */
        

       
        //Comprador
        $payer = new \MercadoPago\Payer();
        
        //$payer->name = $data['payer']['name'];
        $payer->email = $data['payer']['email'];
       
        //$payer->date_created = "2018-06-02T12:58:41.425-04:00";
        /*$payer->phone = array(
            "area_code" => "11",
            "number" => "4444-4444"
        );*/
        
        $payer->identification = array(
           "type" => $data['payer']['identification']['type'],
           "number" => $data['payer']['identification']['number']
       );
            
        /*$payer->address = array(
            "street_name" => "Street",
            "street_number" => 123,
            "zip_code" => "06233200"
        );*/



        //Pagamento
        $payment = new \MercadoPago\Payment();
        $payment->transaction_amount = (float) $data['transaction_amount'];
        $payment->token = $data['token'];
        $payment->description = $data['description'];
        $payment->installments = (int)$data['installments'];
        $payment->payment_method_id = $data['payment_method_id'];
        $payment->issuer_id = (int)$data['issuer_id'];
        
        
         
        $payment->payer = $payer;
        //$payment->item = $item; //Depois mudar para um array
        
        $payment->save();
       
        $response = array(
            'status' => $payment->status,
            'status_detail' => $payment->status_detail,
            'id' => $payment->id
        );
        
        //    echo json_encode($response);
        
        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $response['id'],
            'pagseguro_status' => 1,
            'items' => serialize($cartItems),  
        ];



        $userOrder = $user->orders()->create($userOrder);  
            
        $userOrder->stores()->sync($stores); //Melhorar isso aqui, vários pedidos no lugar de um só
            

        event(new UserOrderedItems($userOrder));

        //Notificar loja de novo pedido
        $store = (new Store())->notifyStoreOwners($stores);

        $dataJson = [
            'status' => true,
            'message' => 'Pedido efetuado com sucesso!',
            'order' => $reference
        ];

        /*return response()->json([
            'data'=> $dataJson           
        ]);*/

        //return redi view('thanks', ['order' => $reference]);
        return redirect()->route('checkout.thanks');
        //return view('thanks');
    }

    // Fim Mercado Pago


    public function proccess(Request $request){

        try{
            
            $dataPost = $request->all();
            $user = auth()->user();
            $cartItems = session()->get('cart');
            $stores = array_unique(array_column($cartItems, 'store_id'));
            //$data = date('YmdHis');
            $reference = uniqid(rand(), false);
            

            $payment = $dataPost['paymentType'] == 'BOLETO' 
                ? new Boleto($cartItems, $user, $reference, $dataPost['hash'])
                : new CreditCard($cartItems, $user, $dataPost, $reference);

            
            $result = $payment->doPayment();
            
            
            $userOrder = [
                'reference' => $reference,
                'pagseguro_code' => $result->getCode(),
                'pagseguro_status' => $result->getStatus(),
                'items' => serialize($cartItems),
                //'type' => $dataPost['paymentType'],
                //'link_boleto' => $dataPost['paymentType'] == 'BOLETO' ? $result->getPaymentLink() : null   
            ];

            
            $userOrder = $user->orders()->create($userOrder);  
            
            $userOrder->stores()->sync($stores); //Melhorar isso aqui, vários pedidos no lugar de um só
            

            event(new UserOrderedItems($userOrder));

            //Notificar loja de novo pedido
            $store = (new Store())->notifyStoreOwners($stores);

        
            //error_log
            session()->forget('cart'); //Remove elementos da sessão
            session()->forget('pagseguro_session_code'); //Remove elementos da sessão

            $dataJson = [
                'status' => true,
                'message' => 'Pedido efetuado com sucesso!',
                'order' => $reference
            ];

            if($dataPost['paymentType'] == "BOLETO"){
                $dataJson['link_boleto'] = $result->getPaymentLink();
            }


             //Disparar um evento e entender como ele é escutado...
            //UserOrderedItems::dispatch($cartItems);

            return response()->json([
                    'data'=> $dataJson           
            ]); 

        }catch (\Exception $e) {
    		$message = env('APP_DEBUG') ? $e->getMessage() : 'Erro ao processar pedido!';

		    return response()->json([
			    'data' => [
				    'status' => false,
				    'message' => $message
			    ]
		    ], 401);
	    }
    }



    /*public function proccess(Request $request){

            
        $dataPost = $request->all();
        $user = auth()->user();
        $cartItems = session()->get('cart');
        $stores = array_unique(array_column($cartItems, 'store_id'));
        //$data = date('YmdHis');
        $reference = uniqid(rand(), false);
            

        $payment = $dataPost['paymentType'] == 'BOLETO' 
            ? new Boleto($cartItems, $user, $reference, $dataPost['hash'])
            : new CreditCard($cartItems, $user, $dataPost, $reference);

        $result = $payment->doPayment();
            
        $userOrder = [
            'reference' => $reference,
            'pagseguro_code' => $result->getCode(),
            'pagseguro_status' => $result->getStatus(),
            'items' => serialize($cartItems),
            'type' => $dataPost['paymentType'],
            'link_boleto' => $dataPost['paymentType'] == 'BOLETO' 
                ? $result->getPaymentLink() : null   
        ];


        $userOrder = $user->orders()->create($userOrder); 
        $userOrder->stores()->sync($stores);
            

        //Notificar loja de novo pedido
        $store = (new Store())->notifyStoreOwners($stores);


            //error_log
        session()->forget('cart'); //Remove elementos da sessão
        session()->forget('pagseguro_session_code'); //Remove elementos da sessão

        $dataJson = [
            'status' => true,
            'message' => 'Pedido efetuado com sucesso!',
            'order' => $reference
        ];

        if($dataPost['paymentType'] == "BOLETO"){
            $dataJson['link_boleto'] = $result->getPaymentLink();
        }

        return response()->json([
            'data'=> $dataJson           
        ]); 

    }*/



    public function thanks(){
        return view('thanks');
    }

    public function notification(){
       try{
        $notification = new Notification();

        $notification = $notification->getTransaction();

        //Atualizar o pedido do usuário
        $reference = base64_decode($notification->getReference());
        $userOrder = UserOrder::whereReference($reference);
        $userOrder->update([
            'pagseguro_status' => $notification->getStatus()
        ]);

        //comentarios sobre o pedido

        if($notification->getStatus() == 3){
            //Liberar o pedido... atualizar o estados do pedido
            //Notificar o usuário que o pedido foi pago...
            //Notificar a loja
        }

        return response()->json([], 204);
       } catch(\Exception $e){
           $message = env('APP_DEBUG') ? $e->getMessage() : '';
            return response()->json(['error' => $message], 500);
       }
    }

    private function makePagSeguroSession(){
        
        if(!session()->has('pagseguro_session_code')){
            $sessionCode = \PagSeguro\Services\Session::create(
                \PagSeguro\Configuration\Configure::getAccountCredentials()
            );

            session()->put('pagseguro_session_code', $sessionCode->getResult());
        }

    } 
}
