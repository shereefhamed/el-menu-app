<style>
    body {
        font-family: Arial, Helvetica, sans-serif;
    }
</style>
<div class="logo">
    <img src="{{ $message->embed(public_path('images/el-menu.png')) }}" alt="">
    <h3>Hi Admin</h3>
    <p>You have a new message from contact us form</p>
    <table>
        <tbody>
            <tr>
                <th>Name:</th>
                <td>{{ $name }}</td>
            </tr>
            <tr>
                <th>Phone:</th>
                <td>{{ $phone }}</td>
            </tr>
            <tr>
                <th>Message:</th>
                <td>{{ $messageBody }}</td>
            </tr>
        </tbody>
    </table>
</div>