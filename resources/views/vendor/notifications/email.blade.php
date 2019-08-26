@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang('Hola!')
@endif
@endif

{{-- Intro Lines --}}
Estás recibiendo este correo porque hiciste una solicitud de recuperacion de contraseña para tu cuenta.

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
Si no se realiza esta solicitud, no se requiere realizar ninguna otra acción.

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else

@lang('Saludos'),<br>
{{ config('app.name') }}
@endif

@endcomponent
