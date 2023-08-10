@extends('master')

@section('konten')
<script>
       
      $(function(){
          $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
           $('#example').DataTable({
              "processing": true,
              "serverSide": true,
              "data": {
                    "_token": "{{ csrf_token() }}"
                },
              "ajax":{
                       "url": "{{route('organizer-data')}}",
                       "dataType": "json",
                       "type": "POST"
                     },
              "columns": [
                  { "data": "organizerName" },
                  { "data": "imageLocation" }
              ]  
 
          });
        });
 
     
 
</script>

<a href="{{route('create-organizer')}}" class="btn btn-primary">Add</a>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Organizer Name</th>
                <th>Image Location</th>
            </tr>
        </thead>
    </table>
@endsection
