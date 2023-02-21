$(document).ready(function(){
    $("#datatable").DataTable({
        processing:true,
        info:true,
        ajax:"{{ route('get.users') }}",
        "pageLength":5,
        "aLengthMenu":[[5,10,25,50,-1],[5,10,25,50,"All"]],
        columns:[
            {data:'id',name:'id'},
            // DataTables  database initialization options
            // {data:"DT_RowIndex",name:"DT_RowIndex"},
            {data:"userImage", name:"Image"},
            {data:'fullname',name:'fullname'},
            {data:'email',name:'email'},
            {data:'status',name:'status'},
            {data:'role',name:'role'},
            {data:"created_at", name:"created_at"},
            {data:'actions',name:"actions",orderable:false,searchable:false}
        ]
    }),$("#datatable-buttons").DataTable({lengthChange:!1,buttons:["copy","excel","pdf","colvis"]}).buttons().container().appendTo("#datatable-buttons_wrapper .col-md-6:eq(0)"),$(".dataTables_length select").addClass("form-select form-select-sm")
});