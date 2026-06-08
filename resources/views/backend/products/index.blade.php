@extends('layouts.parent')

@section('title', 'Products')

@section('styles')

    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


@endsection

@section('search')

<form action="{{route('products.search')}}" method="get" class="form-inline ml-3">
    <div class="input-group input-group-sm">
        <input name="search" class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    @endsection

@section('content')



    <div class="card-body">

        <x-alert type="success"/>
       

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
                    @if(auth()->user()->role->name !== 'user')
                    <th>Status</th>
                    <th>Created At</th>
                    <th colspan="2" class="text-center">Actions</th>
                    @endif
                    
                </tr>
            </thead>
            <tbody>

                @forelse ($products as $product)
                    <tr>
                        {{-- {{asset('dist/img/products/'.$product->image)}} --}}
                        <td><img src="{{ asset('dist/img/products/' . $product->image) }}" class="w-100" alt=""></td>
                        <td><a href="{{route('products.show',$product->slug)}}">{{ $product->name }}</a></td>
                        <td>{{ $product->category->name }}</td>
                        <td>{{ $product->subcategory->name }}</td>
                        <td>{{ $product->brand->name }}</td>
                        <td>{{ $product->quantity }}</td>
                        <td>{{ $product->price }} EGP</td>
                        @if(auth()->user()->role->name !== 'user')
                        <td class="text-{{ $product->status == 'active' ? 'success' : 'danger' }}">{{ $product->status }}
                        </td>
                       <td>{{ $product->created_at }}</td>
                       @endif
                       @can('update',$product)
                       <td><a href="{{ route('products.edit', $product->slug) }}" class="btn btn-info">Edit</a></td>
                      
                       @endcan
                       @can('delete',$product)
                           
                       <td>
                           <form action="{{ route('products.destroy', $product->slug) }}" method="post">
                               @csrf
                               @method('delete')
                               <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                        @endcan
                        
                       @if ((auth()->user()->role->name === 'admin') && ($product->user_id !== auth()->user()->id))
                       <td colspan="2"><a href="#" class="btn btn-warning disabled text-bold text-danger">For super-admin</a></td>
                       @endif
                      

                    </tr>

                @empty

                    <tr>
                        <td colspan="11" class="alert alert-warning">No Product Yet!</td>
                    </tr>
                @endforelse



            </tbody>
        </table>
    </div>

    {{ $products->withQueryString() }}

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
