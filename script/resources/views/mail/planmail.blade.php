@component('mail::message')
{{ __('# New Message') }}

{{ __('Name:') }} {{ $data['name'] }}<br>

{{ __('Message: ') }}{{ $data['message'] }}

{{ __('Thanks,') }}<br>
{{ config('app.name') }}
@endcomponent