@if(file_exists('uploads/'.tenant('user_id').'additional.js'))
<script type="text/javascript" src="{{ asset('uploads/'.tenant('user_id').'additional.js') }}"></script>
@endif