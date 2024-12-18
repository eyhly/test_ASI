<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
</head>
<body>
    <h1>Clients</h1>
    <a href="{{ route('clients.create') }}">Create New Client</a>

    <ul>
        @foreach($clients as $client)
            <li>
                <h2>{{ $client->name }}</h2>
                <p>Slug: {{ $client->slug }}</p>
                <p>Phone: {{ $client->phone_number }}</p>
                <p>City: {{ $client->city }}</p>
                <p>
                    <img src="{{ Storage::disk('s3')->url($client->client_logo) }}" alt="{{ $client->name }}" width="100" height="100">
                </p>
                <a href="{{ route('clients.edit', $client->slug) }}">Edit</a> |
                <form action="{{ route('clients.destroy', $client->slug) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</body>
</html>