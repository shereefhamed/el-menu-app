<style>
    .d-flex {
        display: flex;
        gap: 16px;
        align-items: center;
    }

    .text-body-secondary {
        color: rgba(33, 37, 41, 0.75);
    }

    .table {
        width: 100%;
        vertical-align: top;
        border-collapse: collapse;
    }
</style>
<h1>New Order {{ $order->orderId() }}</h1>
<p>You have recived the following order from {{ $order->user->name }}</p>
<table class="table align-middle">
    <thead>
        <tr>
            <th>Item</th>
            <th>Qty</th>
            <th>Price</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($order->orderItems as $orderItem)
            <tr>
                <td>
                    <div class="d-flex">
                        <img src="{{ $orderItem->menuItem->thumbnail() }}" alt="" style="width: 60px;">
                        <div>
                            <h6>{{ $orderItem->item_name }}</h6>
                            @if ($orderItem->attribute)
                                <small class="text-body-secondary">{{ $orderItem->attribute['name'] }}</small>
                                <br>
                            @endif
                            @if ($orderItem->addons)
                                @foreach ($orderItem->addons as $addon)
                                    <small class="text-body-secondary">{{ $addon['name'] }} |</small>
                                @endforeach
                                <br>
                            @endif
                            @if ($orderItem->notes)

                                <small class="text-body-secondary">{{ __('Notes:') }}
                                    {{ $orderItem->notes }}</small>
                            @endif
                        </div>
                    </div>
                </td>
                <td>{{ $orderItem->quantity }}</td>
                <td>{{ $orderItem->unit_price }}</td>
                <td>{{ $orderItem->total }}</td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td>Service fee</td>
            <td>{{ $order->service_fee }}</td>
        </tr>
        <tr>
            <td>Delivey fee</td>
            <td>{{ $order->delivery_fee }}</td>
        </tr>
        <tr>
            <td>Total</td>
            <td>{{ $order->total }}</td>
        </tr>
    </tfoot>
</table>