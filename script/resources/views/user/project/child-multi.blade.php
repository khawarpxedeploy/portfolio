@php
$i++
@endphp
<option 
@if(in_array($child_category->id,$ids)) selected @endif value="{{ $child_category->id }}" >@for($j=0; $j < $i ;
        $j++) -- @endfor {{ $child_category->name }}</option> @if ($child_category->categories)
        @foreach ($child_category->categories as $key => $childCategory)
        @include('user.category.child-multi', ['child_category' => $childCategory,'key'=>$key])
        @endforeach
        @endif