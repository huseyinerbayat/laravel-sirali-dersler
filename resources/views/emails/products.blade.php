<x-mail::message>
# Introduction

{{$product->name}}

<x-mail::button :url="''">
Satın Al
</x-mail::button>


Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
