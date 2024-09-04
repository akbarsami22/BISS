@extends('common.common')

@section('section')
<section class="container mt-5" style="min-height: 600px; padding: 20px;">
    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-8">
            <div class="card shadow-lg rounded-3 border-light p-4">
                <div class="card-body">
                    <h3 class="card-title text-center mb-4">Book Details</h3>

                    @if (Session::has('success'))
                        <div class="alert alert-success mb-4">
                            {{ Session::get('success') }}
                        </div>
                    @endif
                    @if (Session::has('errors'))
                        <div class="alert alert-danger mb-4">
                            {{ Session::get('errors') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover table-bordered mb-4">
                            <thead class="table-primary">
                                <tr>
                                    <th>ID</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Publisher</th>
                                    <th>Year</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($books->isNotEmpty())
                                    @foreach ($books as $book)
                                    <tr>
                                        <td>{{ $book->id }}</td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->publisher }}</td>
                                        <td>{{ $book->Year_published }}</td>
                                        <td class="text-center">
                                            <div class="d-inline-flex align-items-center">
                                                <a href="{{ route('edit_book', $book->id) }}" class="btn btn-warning btn-sm me-2" title="Edit">
                                                    <i class="bi bi-pencil"></i>
                                                </a>
                                                <a href="#" onclick="deleteBook({{ $book->id }})" class="btn btn-danger btn-sm" title="Delete">
                                                    <i class="bi bi-trash"></i>
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                @else
                                <tr>
                                    <td colspan="6" class="text-center">No Book Found</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>

                    <div class="d-flex justify-content-center mt-4">
                        {{ $books->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('custom_js')
<script>
    function deleteBook(id) {
        var url = '{{ route("delete_book", "ID") }}';
        var newUrl = url.replace("ID", id);

        if (confirm("Are you sure you want to delete?")) {
            $.ajax({
                url: newUrl,
                type: 'delete',
                data: {},
                dataType: 'json',
                success: function(response) {
                    if (response.status) {
                        window.location.href = "{{ route('books') }}";
                    }
                }
            });
        }
    }
</script>
@endsection
