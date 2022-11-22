

<script src="{{url('panel/plugins/jquery/jquery.min.js')}}"></script>




<script src="{{url('panel/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{url('panel/dist/js/adminlte.min.js')}}"></script>



<link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet"/>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script src="{{url('https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js')}}"></script>
<script src="{{url('panel/plugins/datatables/dataTables.bootstrap4.js')}}"></script>



<link href="{{url('panel/plugins/select2/select2.min.css')}}" rel="stylesheet" />


<script src="{{url('panel/plugins/tinymce/tinymce.min.js')}}"></script>
<script src="{{url('panel/plugins/select2/select2.full.min.js')}}"></script>



<script type="text/javascript">




    $('#tb_chapters').DataTable({
        order: [[0, "desc"]],

        processing: true,
        serverSide: true,
        ajax: "{{ route('chapters.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'created_at', name: 'created_at'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        "language": {
            url: "{{url('panel/plugins/datatables/fa.json')}}"
        }


    });


    $('#tb_pages').DataTable({
        order: [[0, "desc"]],

        processing: true,
        serverSide: true,
        ajax: "{{ route('pages.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'book', name: 'book'},
            {data: 'chapter', name: 'chapter'},
            {data: 'status', name: 'status'},

            {data: 'created_at', name: 'created_at'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                orderable: false,
                searchable: false
            },
        ],
        "language": {
            url: "{{url('panel/plugins/datatables/fa.json')}}"
        }


    });




$(document).ready(function() {
    $('.select2').select2();
    tinymce.init({
        selector: 'textarea.default-editor',
        directionality : 'rtl',
    });

});
    $('#tb_shelves').DataTable({
        order: [[0, "desc"]],

        processing: true,
        serverSide: true,
        ajax: "{{ route('shelves.list') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'name', name: 'name'},
            {data: 'books', name: 'books'},
            {data: 'created_by', name: 'created_by'},
            {data: 'created_at', name: 'created_at'},
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ],
        "language": {
            url: "{{url('panel/plugins/datatables/fa.json')}}"
        }


    });






function slug_status(){
    let checkbox = document.getElementById("auto-slug");
    let toggle = document.getElementById("slug");

    if (checkbox.checked){
        toggle.readOnly = true;
        document.getElementById("slug").value = "";

    }else{
        toggle.readOnly = false;

    }

}


        $(document).ready(function () {
            $('#tb_users').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('users.list') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'is_active', name: 'is_active'},
                    {data: 'email', name: 'email'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'role', name: 'role'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "language": {
                    url: "{{url('panel/plugins/datatables/fa.json')}}"
                }


            });


            $('#tb_roles').DataTable({
                order: [[0, "desc"]],
                responsive: true,

                processing: true,
                serverSide: true,
                ajax: "{{ route('roles.list') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'count_user', name: 'count_user'},
                    {data: 'updated_at', name: 'updated_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "language": {
                    url: "{{url('panel/plugins/datatables/fa.json')}}"
                }

            });


            $('#tb_audit').DataTable({
                order: [[0, "desc"]],
                responsive: true,

                processing: true,
                serverSide: true,
                ajax: "{{ route('audit.list') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'user_id', name: 'user_id'},
                    {data: 'event', name: 'event'},
                    {data: 'created_at', name: 'created_at'}

                ],
                "language": {
                    url: "{{url('panel/plugins/datatables/fa.json')}}"
                }

            });

            $('#tb_books').DataTable({
                order: [[0, "desc"]],

                processing: true,
                serverSide: true,
                ajax: "{{ route('books.list') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'view', name: 'view'},
                    {data: 'created_at', name: 'created_at'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ],
                "language": {
                    url: "{{url('panel/plugins/datatables/fa.json')}}"
                }

            });
    });

</script>

<Style>
    .loader {
        background: #fff;
        position: fixed;
        top: 0px;
        bottom: 0px;
        right: 0px;
        left: 0px;
        opacity: 0.6;
        z-index: 100;
        display: none;
    }
</Style>









@if($errors->any())
    <h4>{{$errors->first()}}</h4>
@endif


@if (Session::get('notification'))
    <h5>
        کد خطا :  {{session('notification')}}
    </h5>
@endif
{{--
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $item)
        <li>{{ $item}}</li>
    @endforeach
  </ul>
</div>

@endif


@if (session('warning'))
<div class="alert alert-danger">
   کد خطا :  {{session('warning')}}
</div>
@endif

--}}

<script>
/*
$(document).ready(function () {
    $(".form_ajaxi2").on('submit', function (e) {
        e.preventDefault();
        var frm = new FormData(this);
        frm.append('title','sdsdsss');
        $.ajax({
            url: $(this).attr("action"),
            data:frm,
            type: $(this).attr("method"),
            dataType:"json",
            processData: false,
            contentType: false,
            headers:{
                "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr('content')
            },
            success: function (result) {
              alert(result);

            }

        });




    });
});

*/


    $(function () {


        $('.form_ajaxi').submit(function (event) {
            $(".loader").show();

            event.preventDefault();
            var frm = new FormData(this);

            $.ajax({
                url: $(this).attr("action"),
                type: $(this).attr("method"),
                data: frm,
                processData: false,
                contentType: false,
                headers:{
                    "X-CSRF-TOKEN": $("meta[name=csrf-token]").attr('content')
                },
                success: function (result) {
                    //$('.form_ajaxi').trigger("reset");
                    if (result.success) {

                        toastr.success(result.success);

                        if (result.url == 'reload'){
                            location.reload();
                        }
                        else if (result.url) {
                            setTimeout(function(){
                                window.location = result.url;
                            }, 1500);
                        }


                    }
                    else if (result.error) {
                        toastr.error(result.error);
                    }
                    else{
                        alert(result);
                    }

                    $(".loader").hide();

                }

            });

        });
    });

    toastr.options = {
        "rtl": true,
        "closeButton": true,
        "debug": true,
        "newestOnTop": true,
        "progressBar": true,
        "positionClass": "toast-bottom-left",
        "preventDuplicates": true,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }

</script>

