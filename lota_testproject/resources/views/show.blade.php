@extends('app')

@section('content')
<h1 class="page-header text-center">Laravel Jquery Ajax CRUD </h1>
<div class="row">
    <div class="col-md-10 col-md-offset-1 title">
        <h2>Students Table
            <button type="button" id="add" data-bs-toggle="modal" data-bs-target="#addnew" class="btn btn-primary pull-right">New Student</button>
        </h2>
    </div>
</div>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <table class="table table-bordered table-responsive table-striped">
            <thead>
                <th>Name</th>
                <th>Email</th>
                <th>Action</th>
            </thead>
            <tbody id="studentBody">
            </tbody>

        </table>
    </div>
</div>
@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function(){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            showStudent();

            $('#addForm').on('submit', function(e){
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.ajax({
                    type: 'POST',
                    url: url,
                    data: form,
                    dataType: 'json',
                    success: function(){
                        $('#addnew').modal('hide');
                        $('#addForm')[0].reset();
                        showStudent();
                    }
                });
            });

            $(document).on('click', '.edit', function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var name = $(this).data('first');
                var email = $(this).data('last');
                $('#editmodal').modal('show');
                $('#name').val(name);
                $('#email').val(email);
                $('#studenid').val(id);
            });

            $(document).on('click', '.delete', function(event){
                event.preventDefault();
                var id = $(this).data('id');
                $('#deletemodal').modal('show');
                $('#deletestudent').val(id);
            });

            $('#editForm').on('submit', function(e){
                e.preventDefault();
                var form = $(this).serialize();
                var url = $(this).attr('action');
                $.post(url,form,function(data){
                    $('#editmodal').modal('hide');
                    showStudent();
                })
            });

            $('#deletestudent').click(function(){
                var id = $(this).val();
                $.post("{{ URL::to('delete') }}",{id:id}, function(){
                    $('#deletemodal').modal('hide');
                    showStudent();
                })
            });

        });

        function showStudent(){
            $.get("{{ URL::to('show') }}", function(data){
                $('#studentBody').empty().html(data);
            })
        }

    </script>
@endsection
