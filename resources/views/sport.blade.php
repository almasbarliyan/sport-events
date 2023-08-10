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
                       "url": "{{route('sport-data')}}",
                       "dataType": "json",
                       "type": "POST"
                     },
              "columns": [
                  { "data": "eventDate" },
                  { "data": "eventName" },
                  { "data": "eventType" },
                  {
                        data: null,
                        className: "dt-center editor-delete",
                        orderable: false,
                        mRender: function (data, type, row) {
                            return '<a class="table-edit" onClick="edit(\''+data.id+'\')">EDIT</a> | <a class="table-delete" onClick="deleted(\''+data.id+'\')">DELETE</a>'
                        }                    }
              ]  
 
          });
        });
 
    function edit(id) {
        var url = '{{ route("edit-sport", ":slug") }}';
        url = url.replace(':slug', id);
        window.location.href = url;
    }
    function deleted(id) {
        var result = confirm("Want to delete?");
        if (result) {
            var url = "{{ route('delete-sport', ':id') }}";
            url = url.replace(':id', id);
            var token = $("meta[name='csrf-token']").attr("content");
            console.log("it Works");
            $.ajax({
                type: "post",
                url: url,
                dataType: "json",
                data: {'_method':'DELETE', '_token': token},
                success: function (){
                    alert("Delete Success");
                }
            });
        }
//        var url = '{{ route("edit-sport", ":slug") }}';
//        url = url.replace(':slug', id);
//        window.location.href = url;
    }
</script>
<h4>List Sport Events</h4>
<a href="{{route('create-sport')}}" class="btn btn-primary">Add</a>
    <table id="example" class="display" style="width:100%">
        <thead>
            <tr>
                <th>Event Date</th>
                <th>Event Name</th>
                <th>Event Type</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>
@endsection
