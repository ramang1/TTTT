@extends('layouts.app')
@include('inboxes.table')
@section('content')
<section class="content-header">
    <h1>
        Inbox
    </h1>
</section>
<div class="content">
    <div class="box box-primary">
        <div class="box-body">
            <div class="row" style="padding-left: 20px">
                @include('inboxes.show_fields')
            </div>
        </div>
    </div>
    <div class="box box-primary">
        <section class="content-header">
            <h3 class="box-title">Lịch sử xử lý</h3>
        </section>
        <table class="table table-striped table-bordered" id="dataTableBuilder" width="100%">
            <thead>
                <tr>
                    <th title="Action">Action</th>
                    <th title="User Id">User Id</th>
                    <th title="Note">Note</th>
                    <th title="Description">Description</th>
                </tr>
            </thead>
        </table>

    </div>
</div>
@endsection
@push('scripts')
<script>
  
    var table = $('#dataTableBuilder').DataTable({
        dom: "lfrtip",
        lengthChange: false,
        serverSide: true,
        processing: true,
        ajax: {
            url: "/inboxes/actions/{{$inbox->id}}",
            type: "GET"
        },
        columns: [{
            name: "action",
            data: "action_type",
            title: "Action",
            orderable: true,
            searchable: true
        }, {
            name: "note",
            data: "note",
            title: "Note",
            orderable: true,
            searchable: true
        }, {
            name: "description",
            data: "description",
            title: "Description",
            orderable: true,
            searchable: true
        }, {
            "defaultContent": "",
            data: "created_at",
            name: "created_at",
            title: "Created at",
            render: null,
            orderable: true,
            searchable: true,
            width: "120px"
        }],
        stateSave: true,
        order: [
            [2, "desc"]
        ]
    });
</script>
@endpush