@extends('layouts.dashboard.dashboard')
@section('title', 'Upgrade subscription')
@section('content')
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/paymob-pixel@latest/styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/paymob-pixel@latest/main.css"> -->

    <script src="https://cdn.jsdelivr.net/npm/paymob-pixel@latest/main.js" type="module"></script>
    
    <script type="module">
        new Pixel({
            publicKey: '{{ env('PAYMOB_PUBLIC_KEY') }}',
            clientSecret: '{{ $clientSecret }}',
            paymentMethods: ['card',],
            elementId: 'paymob-elements',
            disablePay: false,
            showSaveCard: true,
            forceSaveCard: true,
            beforePaymentComplete: async (paymentMethod) => {
                console.log('Before payment start');
                return true
            },
            afterPaymentComplete: async (response) => {
                console.log('After Bannas payment');
            }, onPaymentCancel: () => {
                console.log('Payment has been canceled');
            }, cardValidationChanged: (isValid) => {
                console.log("Is valid ? ", isValid)
            }, customStyle: {
                Font_Family: 'Gotham',
                Font_Size_Label: '16',
                Font_Size_Input_Fields: '16',
                Font_Size_Payment_Button: '14',
                Font_Weight_Label: 400,
                Font_Weight_Input_Fields: 200,
                Font_Weight_Payment_Button: 600,
                Color_Container: '#FFF',
                Color_Border_Input_Fields: '#D0D5DD',
                Color_Border_Payment_Button: '#A1B8FF',
                Radius_Border: '8',
                Color_Disabled: '#A1B8FF',
                Color_Error: '#CC1142',
                Color_Primary: '#144DFF',
                Color_Input_Fields: '#FFF',
                Text_Color_For_Label: '#000',
                Text_Color_For_Payment_Button: '#FFF',
                Text_Color_For_Input_Fields: '#000',
                Color_For_Text_Placeholder: '#667085',
                Width_of_Container: '100%',
                Vertical_Padding: '40',
                Vertical_Spacing_between_components: '18',
                Container_Padding: '0'
            },
        });
        const button = document.getElementById('payFromOutsideButton');
        button?.addEventListener
            ('click', function () {
                // Calling pay request
                const event = new Event('payFromOutside');
                window.dispatchEvent(event);
            });
    </script>
    <div class="payment-content">
        <div id="paymob-elements"></div>
    </div>
      <!-- <button id="payFromOutsideButton">Pay From Outside Button</button> -->
       
@endsection