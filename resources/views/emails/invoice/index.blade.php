@component('mail::message')
# Order Item

This is an invoice for the goods you purchased.

@component('mail::panel')
    Please Check Your Order
@endcomponent

## Detail:

@component('mail::table')
| Item       | Status         | Price  |
| ------------- |:-------------:| --------:|
    | {{ $mail[0]->product->name }}   | {{ $mail[0]->status }}      | ${{ $mail[0]->total_amount }}      |

@endcomponent


@component('mail::subcopy')
    Please Finish Your Order.
@endcomponent


Thanks,<br>
@endcomponent
