<table>
    <style>
        tr {
            font-size: smaller;
        }
    </style>
    <thead>
        <tr>
            <th style="text-align: center;">{{__('SL')}}</th>
            <th style="text-align: center;">{{__('Plan Name')}}</th>
            <th style="text-align: center;">{{__('Plan duration')}}</th>
            <th style="text-align: center;">{{__('Gateway Name')}}</th>
            <th style="text-align: center;">{{__('User Name')}}</th>
            <th style="text-align: center;">{{__('Amount')}}</th>
            <th style="text-align: center;">{{__('Exp Date')}}</th>
            <th style="text-align: center;">{{__('Payment Status')}}</th>
            <th style="text-align: center;">{{__('Payment ID')}}</th>
            <th style="text-align: center;">{{__('Status')}}</th>
            <th style="text-align: center;">{{__('Created Date')}}</th>
            <th style="text-align: center;">{{__('Created Time')}}</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $key=> $value)
        <tr>
            <td style="text-align: center;">{{ $key+1 }}</td>
            <td style="text-align: center;">{{ $value->plan->name ?? null }}</td>
            <td style="text-align: center;">{{ $value->plan->duration ?? null }}</td>
            <td style="text-align: center;">{{ $value->getway->name ?? null }}</td>
            <td style="text-align: center;">{{ $value->user->name ?? null }}</td>
            <td style="text-align: center;">{{ $value->price ?? null }}</td>
            <td style="text-align: center;">{{ $value->will_expire ?? null }}</td>
            <td style="text-align: center;">{{ $value->trx ?? null }}</td>
            <td style="text-align: center;">
                @if($value->status ==1)
                <span style="color: green">{{ __('Active') }}</span>
                @elseif($value->status ==2)
                <span style="color: green">{{ __('Pending') }}</span>
                @elseif($value->status ==3)
                <span style="color: red">{{ __('Expired') }}</span>
                @else
                <span style="color: red">{{ __('Inactive') }}</span>
                @endif
            </td>
            <td style="text-align: center;">{{ $value->created_at->format('d.m.Y') ?? null }}</td>
            <td style="text-align: center;">{{ $value->created_at->diffForHumans() ?? null }}</td>
        </tr>
        @endforeach
    </tbody>
</table>