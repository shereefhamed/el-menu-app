<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Date</th>
            <th>Status</th>
            <th>{{ __('Total') }}</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
            <tr>
                <td>{{ $order->orderId() }}</td>
                <td>{{ $order->created_at->format('d M Y') }}</td>
                <td>{{ $order->status }}</td>
                <td>{{ $order->total }}</td>
            </tr>
        @endforeach
    </tbody>
</table>