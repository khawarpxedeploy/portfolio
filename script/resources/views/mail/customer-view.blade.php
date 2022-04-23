@component('mail::message')

{!! $data['message'] !!}

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent
