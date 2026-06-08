@extends('layouts.parent')

@section('title', 'Trashed Products')

@section('styles')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


@endsection

@section('content')



    <div class="card-body">
        <table id="example1" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Subcategory</th>
                    <th>Brand</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="2" class="text-center">Actions</th>
                </tr>
            </thead>
            <tbody>

                @forelse ($products as $product)
                    <tr>
                        <td><img src="{{ asset('dist/img/products/' . $product->image) }}" class="w-100" alt=""></td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subcategory->name }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }} EGP</td>
                        <td class="text-{{ $product->status == 'active' ? 'success' : 'danger' }}">{{ $product->status }}
                        </td>
                        <td>{{ $product->created_at }}</td>
                        <td>
                            <form action="{{ route('products.restore', $product->slug) }}" method="post">
                                @csrf
                                @method('put')
                                <button type="submit" class="btn btn-success">Restore</button>
                            </form>
                        </td>
                        @can('forceDelete',$product)
                            
                        <td>
                            <form action="{{ route('products.force-delete', $product->slug) }}" method="post">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn text-bold" style="background-color: darkred;">Delete</button>
                            </form>
                        </td>
                        @endcan
                    </tr>

                @empty

                    <tr>
                        <td colspan="11" class="alert alert-warning text-center text-danger text-bold">There is No Deleted Product !</td>
                    </tr>
                @endforelse


            </tbody>
        </table>
    </div>

@endsection

@section('scripts')

    <!-- DataTables  & Plugins -->
    <script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
    <script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

        });
    </script>


@endsection
