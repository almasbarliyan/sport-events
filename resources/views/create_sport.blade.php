@extends('master')

@section('konten')

@if(Session::has('success'))
<div class="alert alert-success">
    {{ Session::get('success') }}
    @php
        Session::forget('success');
    @endphp
</div>
@endif
@if(Session::has('failed'))
<div class="alert alert-danger">
    {{ Session::get('failed') }}
    @php
        Session::forget('failed');
    @endphp
</div>
@endif

@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
    </ul>
</div>
@endif

@if (Session::has('error_validate'))
<div class="alert alert-danger">
    <ul>
        @foreach (Session::get('error_validate') as $error)
            @if(count($error) > 0)
                @foreach($error as $err)
                    <li>{{ $err }}</li>
                @endforeach
            @endif
        @endforeach
    </ul>
</div>
@endif
<form action="{{ route('store-sport') }}" method="post">
@csrf
<input type="hidden" name="id" value="{{isset($result) ? $result['id'] : ''}}">
    <div class="form-group">
        <label>Event Date</label>
        <input type="date" name="eventDate" class="form-control" placeholder="Event date" required="" value="{{ isset($result) ? $result['eventDate'] : old('eventDate') }}">
    </div>
    <div class="form-group">
        <label>Event Type</label>
        <input type="text" name="eventType" class="form-control" placeholder="Event Type" required="" value="{{ isset($result) ? $result['eventType'] : old('eventType') }}">
    </div>
    <div class="form-group">
        <label>Event Name</label>
        <input type="text" name="eventName" class="form-control" placeholder="Event Name" required="" value="{{ isset($result) ? $result['eventName'] : old('eventName') }}">
    </div>
    <div class="form-group">
        <label>Organizer</label>
        <select class="form-control" name="organizerId">
            @foreach($organizer->data as $organizer)
                <option value="{{$organizer->id}}">{{$organizer->organizerName}}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary btn-block">Submit</button>
</form>
@endsection