<x-mail::message>
# Introduction

Hello {{$name}},

Your date of vaccination is {{$scheduled_date}} and your vaccination Centre is {{$vaccineCentre}}


<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
