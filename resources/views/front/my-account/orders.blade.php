<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>Restaurant</th>
            <th>Status</th>
            <th>{{ __('Total') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td><a href="{{ route('orders.show', ['order' => $order]) }}">{{ $order->orderId() }}</a></td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
                <td>{{ $order->restaurant->name }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>