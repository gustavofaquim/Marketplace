<h1>Olá, {{$user->name}}, tudo bem? </h1>

<h3>Obrigado por se registrar</h3>

<p>Faça excelentes compras em nossas lojas! <br>
    Seu e-mail de cadastro é <strong>{{$user->email}}</strong>
</p>

<hr>
Email enviada em {{date('d/m/y H:i:s')}}.