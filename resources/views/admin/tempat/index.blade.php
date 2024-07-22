@extends('admin.template.main')

@section('title', 'Data Users')

@push('style')
    {{-- SweetAlert2 --}}
    <link rel="stylesheet" href="plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="ns/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="ns/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="ns/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endpush

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ Auth::user()->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/home') }}">home</a></li>
                        <li class="breadcrumb-item active">Tempat</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>





    <!-- Default box -->
    <div class="card">
        <div class="card-header">
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>

        <div class="card-body">

            <table id="example1" class="table table-bordered table-striped text-center">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nama</th>
                        <th>pengunjung 1 bulan</th>
                        <th>Rata Rata Suhu</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tempat as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>
                                @php
                                    $jumlah = 0;
                                @endphp
                                @if ($user->checkin->isNotEmpty())
                                    @foreach ($user->checkin as $produk)
                                        <?php $jumlah++; ?>
                                    @endforeach
                                    {{ $jumlah }}
                                @else
                                    No data
                                @endif
                            </td>
                            <td>
                                @php
                                    $jumlah = 0;
                                    $suhu = 0;
                                @endphp
                                @if ($user->checkin->isNotEmpty())
                                    @foreach ($user->checkin as $produk)
                                        <?php $jumlah++; ?>
                                        <?php $suhu += $produk->suhu; ?>
                                    @endforeach
                                    @php
                                        $rata = $suhu / $jumlah;
                                        if ($rata < 34) {
                                            $bg = 'bg-success';
                                        } elseif ($rata < 36) {
                                            $bg = 'bg-warning';
                                        } else {
                                            $bg = 'bg-danger';
                                        }
                                    @endphp
                                    <p class='{{ $bg }} btn btn-sm'>{{ $rata }}</p>
                                @else
                                    No data
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#edit">Edit</button>
                                <form action="{{ url("deleteuser/$user->id") }}" method="POST" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn bg-danger delete-data" type="button">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->

    @include('admin.tempat.modal')
@endsection
{{-- content --}}

@push('script')
    {{-- sweetalert2 --}}
    <script src="plugins/sweetalert2/sweetalert2.min.js"></script>
    <!-- DataTables  & Plugins -->
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

    <!-- Page specific script -->
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });

        // script delete start
        $('.delete-data').click(function(e) {
            e.preventDefault()
            const data = $(this).closest('tr').find('td:eq(1)').text()
            Swal.fire({
                    title: 'Data akan hilang!',
                    text: `Apakah penghapusan data ${data} akan dilanjutkan?`,
                    icon: 'warning',
                    showDenyButton: true,
                    confirmButtonText: 'Ya',
                    denyButtonText: 'Tidak',
                    focusConfirm: false
                })
                .then((result) => {
                    if (result.isConfirmed) $(e.target).closest('form').submit()
                    else swal.close()
                })
        });
    </script>
@endpush
