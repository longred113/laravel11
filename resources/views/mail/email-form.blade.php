<x-mail::message>
# Introduction

The body of your message.

<x-mail::button :url="''">
    Button Text
</x-mail::button>
Token: {{$token}}
Thanks,<br>
{{ config('app.name') }}
</x-mail::message>