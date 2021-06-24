// Step #3

const cardForm = mp.cardForm({
    amount: cartItens,
    autoMount: true,
    form: {
      id: "form-checkout",
      cardholderName: {
        id: "form-checkout__cardholderName",
        placeholder: "Titular do cartão",
      },
      cardholderEmail: {
        id: "form-checkout__cardholderEmail",
        placeholder: "E-mail",
      },
      cardNumber: {
        id: "form-checkout__cardNumber",
        placeholder: "Número do cartão",
      },
      cardExpirationMonth: {
        id: "form-checkout__cardExpirationMonth",
        placeholder: "Mês de vencimento",
      },
      cardExpirationYear: {
        id: "form-checkout__cardExpirationYear",
        placeholder: "Ano de vencimento",
      },
      securityCode: {
        id: "form-checkout__securityCode",
        placeholder: "Código de segurança",
      },
      installments: {
        id: "form-checkout__installments",
        placeholder: "Parcelas",
      },
      identificationType: {
        id: "form-checkout__identificationType",
        placeholder: "Tipo de documento",
      },
      identificationNumber: {
        id: "form-checkout__identificationNumber",
        placeholder: "Número do documento",
      },
      issuer: {
        id: "form-checkout__issuer",
        placeholder: "Banco emissor",
      },
    },
    callbacks: {
      onFormMounted: error => {
        if (error) return console.warn("Form Mounted handling error: ", error);
        console.log("Form mounted");
        
      },
      onFormUnmounted: error => {
        if (error) return console.warn('Form Unmounted handling error: ', error)
        console.log('Form unmounted')
      },
      onIdentificationTypesReceived: (error, identificationTypes) => {
          if (error) return console.warn('identificationTypes handling error: ', error)
          console.log('Identification types available: ', identificationTypes)
      },
      onPaymentMethodsReceived: (error, paymentMethods) => {
          if (error) return console.warn('paymentMethods handling error: ', error)
          console.log('Payment Methods available: ', paymentMethods)
      },
      onIssuersReceived: (error, issuers) => {
          if (error) return console.warn('issuers handling error: ', error)
          console.log('Issuers available: ', issuers)
      },
      onInstallmentsReceived: (error, installments) => {
          if (error) return console.warn('installments handling error: ', error)
          console.log('Installments available: ', installments)
      },
      onCardTokenReceived: (error, token) => {
          if (error) return console.warn('Token handling error: ', error)
          console.log('Token available: ', token)
      },
      onSubmit: event => {
        event.preventDefault();
  
        const {
          paymentMethodId: payment_method_id,
          issuerId: issuer_id,
          cardholderEmail: email,
          amount,
          token,
          installments,
          identificationNumber,
          identificationType,
        } = cardForm.getCardFormData();
        
       
       
        fetch("/checkout/process_payment", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
          },
          body: JSON.stringify({
            token,
            issuer_id,
            payment_method_id,
            transaction_amount: Number(amount),
            installments: Number(installments),
            description: "Descrição do produto",
            payer: {
              email,
              identification: {
                type: identificationType,
                number: identificationNumber,
              },
            },
          }),
        });
      },
      onFetching: (resource) => {
        console.log("Fetching resource: ", resource);
        
  
        // Animate progress bar
        const progressBar = document.querySelector(".progress-bar");
        progressBar.removeAttribute("value");
  
        return () => {
          progressBar.setAttribute("value", "0");
        };
      },
    },
  });