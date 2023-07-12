<x-mail::message>
# Introduction

your password:
<x-mail::button :url="''">
    {{ $password }}
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
