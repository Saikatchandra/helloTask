@extends('layouts.app')
@section('header.css')
  <link href="{{('/assets/datatables/datatables/dataTables.bootstrap4.min.css')}}" rel='stylesheet' type="text/css" />
  <link href="{{('/assets/datatables/datatables/buttons.bootstrap4.min.css')}}" rel='stylesheet' type="text/css" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" rel='stylesheet' type="text/css" />
  <!-- <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.dataTables.min.css" rel='stylesheet' type="text/css" /> -->
@endsection
@section('content')
<div class="container">

                <section id="configuration">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">All Employee</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                        <li><a href="{{ route('employee.create') }}" class="btn btn-info"><i class="ft-plus"></i>Create New</a></li>
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
{{--                                            <li><a data-action="close"><i class="ft-x"></i></a></li>--}}
                                        </ul>
                                    </div>
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table table-responsive">
                                            <table id="employeeTable"
                                                   class="table table-striped table-bordered nowrap">
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


</div>
@endsection
@section('footer.js')
<script src="{{asset('/assets/datatables/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('/assets/datatables/datatables/dataTables.bootstrap4.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/js/all.min.js"></script>
 <script>
    $(document).ready(function () {
            $('#employeeTable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ url('company-list') }}",
                columns: [
                    // {title: 'Category ID', data: 'categoryId', name: 'categoryId', className: "text-center", orderable: true, searchable: true},
                    {title: 'Image', data: 'image', name: 'image', className: "text-center", orderable: false, searchable: false},
                    {title: 'Company Name', data: 'name', name: 'name', className: "text-center", orderable: true, searchable: true},
                    // {title: 'Status', data: 'homeShow', name: 'homeShow', className: "text-center", orderable: true, searchable: true},
                    // { title:'Parent', data: 'parentName', name: 'parent',className: "text-center", orderable: true, searchable:true},
                    // {title: 'Created', data: 'created_at', name: 'created_at', className: "text-center", orderable: true, searchable: true},
                    // {title: 'Updated', data: 'updated_at', name: 'updated_at', className: "text-center", orderable: true, searchable: true},
                    {title: 'Action', className: "text-center", data: function (data) {
                            return '<a title="edit" class="btn btn-warning btn-sm" data-panel-id="' + data.id + '" onclick="editCompany(this)"><i class="fa fa-edit"></i></a>'+
                                ' <a title="delete" class="btn btn-danger btn-sm" data-panel-id="' + data.id + '" onclick="deleteCompany(this)"><i class="fa-solid fa-trash"></i></a>'
                                ;
                        },
                        orderable: false, searchable: false
                    }
                ]
            });
        });

        function editCompany(x) {
            btn = $(x).data('panel-id');
            var url = '{{route("company.edit", ":id") }}';
            var newUrl = url.replace(':id', btn);
            window.location.href = newUrl;
        }
        function deleteCompany(x) {
            companyId = $(x).data('panel-id');
            // alert(companyId);    
            if(!confirm("Delete This company?")){
                return false;
            }
            $.ajax({
                type: 'POST',
                url: '{!! route("company.delete") !!}',
                cache: false,
                data: {_token: "{{csrf_token()}}",'companyId': companyId},
                success: function (data) {
                    $('#employeeTable').DataTable().clear().draw();
                }
            });
        }
        
    </script>
@endsection
