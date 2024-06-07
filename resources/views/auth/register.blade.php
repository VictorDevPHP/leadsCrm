<div class="flex justify-center items-center mb-4">
    <img id="preview" src="https://via.placeholder.com/150" alt="Registro" class="avatar">
</div>
<form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="bg-1F2937 p-10 rounded-lg w-full max-w-lg mx-auto mt-10">
    @csrf
    <script src="https://cdn.tailwindcss.com"></script>
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="hidden" name="profile" value="{{ $profile }}">
    <input type="hidden" name="customer_id" value="{{ $customer_id }}">
    <div class="mb-6">
        <label for="photo" class="block text-C9CDD4 text-sm font-bold mb-2">Photo</label>
        <input id="photo" type="file" name="photo" onchange="previewFile()">
    </div>
    <div class="mb-6">
        <label for="name" class="block text-C9CDD4 text-sm font-bold mb-2">Name</label>
        <input id="name" type="text" name="name" required autofocus
            class="w-full px-3 py-2 rounded-md bg-111827 text-C9CDD4">
    </div>

    <div class="mb-6">
        <label for="email" class="block text-C9CDD4 text-sm font-bold mb-2">Email</label>
        <input id="email" type="email" name="email" value="{{ $email }}" readonly
            class="w-full px-3 py-2 rounded-md bg-111827 text-C9CDD4">
    </div>

    <div class="mb-6">
        <label for="password" class="block text-C9CDD4 text-sm font-bold mb-2">Password</label>
        <input id="password" type="password" name="password" required
            class="w-full px-3 py-2 rounded-md bg-111827 text-C9CDD4">
    </div>

    <div class="mb-6">
        <label for="password_confirmation" class="block text-C9CDD4 text-sm font-bold mb-2">Confirm Password</label>
        <input id="password_confirmation" type="password" name="password_confirmation" required
            class="w-full px-3 py-2 rounded-md bg-111827 text-C9CDD4">
    </div>
    @error('password')
        <span class="text-red-500 text-xs mt-2">{{ $message }}</span>
    @enderror
    <div class="flex items-center justify-between">
        <button type="submit" class="w-full py-2 px-4 bg-white text-1F2937 font-bold rounded-md">Register</button>
    </div>
    <script>
        function previewFile() {
            const preview = document.getElementById('preview');
            const file = document.getElementById('photo').files[0];
            const reader = new FileReader();

            reader.addEventListener("load", function() {
                preview.src = reader.result;
            }, false);

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
    <style>
        .avatar {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
        }

        body {
            background-color: #111827;
        }

        form {
            background-color: #1F2937;
        }

        form label {
            color: #C9CDD4;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            background-color: #111827;
            color: #C9CDD4;
        }

        form button {
            background-color: #FFFFFF;
            color: #1F2937;
        }
    </style>
</form>
