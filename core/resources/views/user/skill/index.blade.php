@extends('user.layout')
@php
$userDefaultLang = \App\Models\User\Language::where([
['user_id',\Illuminate\Support\Facades\Auth::id()],
['is_default',1]
])->first();
$userLanguages = \App\Models\User\Language::where('user_id',\Illuminate\Support\Facades\Auth::id())->get();
@endphp

@includeIf('user.partials.rtl-style')

@section('content')
<div class="page-header">
    <h4 class="page-title">Skills</h4>
    <ul class="breadcrumbs">
        <li class="nav-home">
            <a href="{{route('user-dashboard')}}">
            <i class="flaticon-home"></i>
            </a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Skill Page</a>
        </li>
        <li class="separator">
            <i class="flaticon-right-arrow"></i>
        </li>
        <li class="nav-item">
            <a href="#">Skills</a>
        </li>
    </ul>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card-title d-inline-block">Skills</div>
                    </div>
                    <div class="col-lg-3">
                        @if(!is_null($userDefaultLang))
                        @if (!empty($userLanguages))
                        <select name="userLanguage" class="form-control" onchange="window.location='{{url()->current() . '?language='}}'+this.value">
                            <option value="" selected disabled>Select a Language</option>
                            @foreach ($userLanguages as $lang)
                            <option value="{{$lang->code}}" {{$lang->code == request()->input('language') ? 'selected' : ''}}>{{$lang->name}}</option>
                            @endforeach
                        </select>
                        @endif
                        @endif
                    </div>
                    <div class="col-lg-4 offset-lg-1 mt-2 mt-lg-0">
                        @if(!is_null($userDefaultLang))
                        <a href="#" class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#createModal"><i class="fas fa-plus"></i> Add Skill</a>
                        <button class="btn btn-danger float-right btn-sm mr-2 d-none bulk-delete" data-href="{{route('user.skill.bulk.delete')}}"><i class="flaticon-interface-5"></i> Delete</button>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        @if(is_null($userDefaultLang))
                        <h3 class="text-center">NO LANGUAGE FOUND</h3>
                        @else
                        @if (count($skills) == 0)
                        <h3 class="text-center">NO SKILL FOUND</h3>
                        @else
                        <div class="table-responsive">
                            <table class="table table-striped mt-3" id="basic-datatables">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <input type="checkbox" class="bulk-check" data-val="all">
                                        </th>
                                        <th scope="col">Title</th>
                                        <th scope="col">Language</th>
                                        <th scope="col">Percentage</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($skills as $key => $skill)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="bulk-check" data-val="{{$skill->id}}">
                                        </td>
                                        <td>{{strlen($skill->title) > 30 ? mb_substr($skill->title, 0, 30, 'UTF-8') . '...' : $skill->title}}</td>
                                        <td>{{$skill->language->name}}</td>
                                        <td>{{$skill->percentage}}</td>
                                        <td>
                                            <a class="btn btn-secondary btn-sm" href="{{route('user.skill.edit', $skill->id) . '?language=' . $skill->language->code}}">
                                            <span class="btn-label">
                                            <i class="fas fa-edit"></i>
                                            </span>
                                            Edit
                                            </a>
                                            <form class="deleteform d-inline-block" action="{{route('user.skill.delete')}}" method="post">
                                                @csrf
                                                <input type="hidden" name="skill_id" value="{{$skill->id}}">
                                                <button type="submit" class="btn btn-danger btn-sm deletebtn">
                                                <span class="btn-label">
                                                <i class="fas fa-trash"></i>
                                                </span>
                                                Delete
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @endif
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!-- Create Skill Modal -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Add Skill</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="ajaxForm" enctype="multipart/form-data" class="modal-form" action="{{route('user.skill.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Language **</label>
                        <select id="language" name="user_language_id" class="form-control">
                            <option value="" selected disabled>Select a language</option>
                            @foreach ($userLanguages as $lang)
                            <option value="{{$lang->id}}">{{$lang->name}}</option>
                            @endforeach
                        </select>
                        <p id="erruser_language_id" class="mb-0 text-danger em"></p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Title **</label>
                                <input type="text" class="form-control" name="title" placeholder="Enter title" value="">
                                <p id="errtitle" class="mb-0 text-danger em"></p>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="percentage">Percentage**</label>
                                <input id="percentage" type="number" class="form-control ltr"
                                    name="percentage" value=""
                                    placeholder="Enter skill percentage" min="1" max="100"
                                    onkeyup="if(parseInt(this.value)>100 || parseInt(this.value)<=0 ){this.value =100; return false;}"
                                    >
                                <p id="errpercentage" class="mb-0 text-danger em"></p>
                                <p class="text-warning mb-0"><small>The percentage should between 1 to 100.</small></p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Color **</label>
                                <input type="text" name="color" value="#F78058" class="form-control jscolor ltr" placeholder="Enter Color">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label for="">Serial Number **</label>
                                <input type="number" class="form-control ltr" name="serial_number" value="" placeholder="Enter Serial Number">
                                <p id="errserial_number" class="mb-0 text-danger em"></p>
                                <p class="text-warning mb-0"><small>The higher the serial number is, the later the Skill will be shown.</small></p>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button id="submitBtn" type="button" class="btn btn-primary">Submit</button>
            </div>
        </div>
    </div>
</div>
@endsection
