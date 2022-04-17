@if(file_exists('uploads/'.tenant('user_id').'additional.css'))
<link rel="stylesheet" type="text/css" href="{{ asset('uploads/'.tenant('user_id').'additional.css') }}">
@endif