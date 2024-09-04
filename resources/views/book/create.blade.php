@extends('common.common')

@section('section')
<section class="vh-100 d-flex align-items-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-11 col-lg-9">
                <div class="card shadow-sm">
                    <div class="card-body p-5">
                        <h3 class="card-title text-center mb-5">Add Book</h3>
                        <form id="bookForm" method="post">
                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold">Title</label>
                                <input type="text" class="form-control form-control-lg" id="title" name="title" placeholder="Book Title">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="author" class="form-label fw-bold">Author</label>
                                <input type="text" class="form-control form-control-lg" id="author" name="author" placeholder="Author's Name">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="publisher" class="form-label fw-bold">Publisher</label>
                                <input type="text" class="form-control form-control-lg" id="publisher" name="publisher" placeholder="Publisher's Name">
                                <p></p>
                            </div>
                            <div class="mb-4">
                                <label for="year" class="form-label fw-bold">Year Published</label>
                                <input type="number" class="form-control form-control-lg" id="year" name="year" placeholder="Year of Publication">
                                <p></p>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection


@section('custom_js')
<script type="text/javascript">
    $("#bookForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled',true)

$.ajax({
    url: '{{ route("add_book_process") }}',
    type: 'post',
    data: $(this).serializeArray(),
    dataType: 'json',
    success: function(response){

        $("button[type='submit']").prop('disabled',false)

        if(response.status){

            window.location.href="{{route('books')}}";

        }else{

            var errors = response.errors;

        if(errors.title){
            $("#title").siblings('p').addClass('invalid-feedback').html(errors.title);
            $("#title").addClass('is-invalid');
        } else {
            $("#title").siblings('p').removeClass('invalid-feedback').html('');
            $("#title").removeClass('is-invalid');
        }

        if(errors.author){
            $("#author").siblings('p').addClass('invalid-feedback').html(errors.author);
            $("#author").addClass('is-invalid');
        } else {
            $("#author").siblings('p').removeClass('invalid-feedback').html('');
            $("#author").removeClass('is-invalid');
        }

        if(errors.publisher){
            $("#publisher").siblings('p').addClass('invalid-feedback').html(errors.publisher);
            $("#publisher").addClass('is-invalid');
        } else {
            $("#publisher").siblings('p').removeClass('invalid-feedback').html('');
            $("#publisher").removeClass('is-invalid');
        }
        if(errors.year){
            $("#year").siblings('p').addClass('invalid-feedback').html(errors.year);
            $("#year").addClass('is-invalid');
        } else {
            $("#year").siblings('p').removeClass('invalid-feedback').html('');
            $("#year").removeClass('is-invalid');
        }
                }
                },
                error: function(jQXHR, exception){
                    console.log('something went wrong');
                }
    });
    });
</script>
@endsection


