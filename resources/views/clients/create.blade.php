<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Clients</title>
</head>
<body>
<h1>Create New Client</h1>

<form action="{{ route('clients.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <label for="name">Client Name</label>
    <input type="text" name="name" id="name" required>
    <br>

    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" required>
    <br>

    <label for="client_logo">Client Logo (optional)</label>
    <input type="file" name="client_logo" id="client_logo">
    <br>

    <label for="is_project">Is Project</label>
    <input type="checkbox" name="is_project" id="is_project">
    <br>

    <label for="self_capture">Self Capture</label>
    <input type="checkbox" name="self_capture" id="self_capture" checked>
    <br>

    <label for="client_prefix">Client Prefix</label>
    <input type="text" name="client_prefix" id="client_prefix">
    <br>

    <label for="address">Address</label>
    <textarea name="address" id="address"></textarea>
    <br>

    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number" id="phone_number">
    <br>

    <label for="city">City</label>
    <input type="text" name="city" id="city">
    <br>

    <button type="submit">Create Client</button>
</form>
</body>
</html>
c. Tampilan Form Edit Client
Buat file form untuk mengedit client di resources/views/clients/edit.blade.php:

blade
Salin kode
<!-- resources/views/clients/edit.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Edit Client</title>
</head>
<body>
<h1>Edit Client</h1>

<form action="{{ route('clients.update', $client->slug) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <label for="name">Client Name</label>
    <input type="text" name="name" id="name" value="{{ $client->name }}" required>
    <br>

    <label for="slug">Slug</label>
    <input type="text" name="slug" id="slug" value="{{ $client->slug }}" required>
    <br>

    <label for="client_logo">Client Logo (optional)</label>
    <input type="file" name="client_logo" id="client_logo">
    <br>

    <label for="is_project">Is Project</label>
    <input type="checkbox" name="is_project" id="is_project" {{ $client->is_project == '1' ? 'checked' : '' }}>
    <br>

    <label for="self_capture">Self Capture</label>
    <input type="checkbox" name="self_capture" id="self_capture" {{ $client->self_capture == '1' ? 'checked' : '' }}>
    <br>

    <label for="client_prefix">Client Prefix</label>
    <input type="text" name="client_prefix" id="client_prefix" value="{{ $client->client_prefix }}">
    <br>

    <label for="address">Address</label>
    <textarea name="address" id="address">{{ $client->address }}</textarea>
    <br>

    <label for="phone_number">Phone Number</label>
    <input type="text" name="phone_number" id="phone_number" value="{{ $client->phone_number }}">
    <br>

    <label for="city">City</label>
    <input type="text" name="city" id="city" value="{{ $client->city }}">
    <br>

    <button type="submit">Update Client</button>
</form>
</body>
</html>