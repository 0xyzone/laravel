@component('mail::message')
## New order received!

# Order #{{ $orderNumber }}
@component('mail::panel')
Order Placed by: **{{ $user }}**
Customer Name: **{{ $name }}** <br>
Phone Number: **{{ $phone }}** <br>
Address: **{{ $address }}** <br>
Product: **{{ $product }}** <br>
Total Price: **{{ $total_price }}** <br>
@endcomponent

@component('mail::button', ['url' => route('orders') .'/'. $orderNumber])
    Show
@endcomponent
@endcomponent
