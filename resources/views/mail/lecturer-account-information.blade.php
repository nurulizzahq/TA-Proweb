<x-mail::message>
    # Informasi Akun

    Email: {{ $email }}
    Password: {{ $password }}

    Silahkan login sesuai dengan informasi diatas,
    setelah itu kami sarankan untuk mengganti password.

    Thanks,
    {{ config('app.name') }}
</x-mail::message>
