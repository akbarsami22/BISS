@extends('common.common')

@section('section')
<section class="vh-100 d-flex align-items-center" style="background-color: #f0f2f5;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card shadow-lg" style="border-radius: 15px;">
                    <div class="card-body p-5">
                        <h3 class="text-center mb-5">Login</h3>
                        @if (Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                        @endif
                        @if (Session::has('errors'))
                        <div class="alert alert-danger">
                            {{Session::get('errors')}}
                        </div>
                        @endif

                        <div id="loginError" class="text-danger" style="display: none;"></div>


                        <form id="loginForm" method="post">
                            <!-- Email input -->
                            <div class="mb-4">
                                <label class="form-label fw-bold" for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control form-control-lg" placeholder="Email">
                                <p></p>
                            </div>

                            <!-- Password input -->
                            <div class="mb-4">
                                <label class="form-label fw-bold" for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control form-control-lg" placeholder="Password">
                                <p></p>
                            </div>

                            <!-- Submit button -->
                            <button class="btn btn-primary w-100 btn-lg" type="submit">Login</button>

                            <!-- Register link -->
                            <div class="text-center mt-4">
                                <p class="mb-0">Don't have an account? <a href="{{route('register')}}" class="text-primary">sign up</a></p>
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
    $("#loginForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled',true)

$.ajax({
    url: '{{ route("login_process") }}',
    type: 'post',
    data: $(this).serializeArray(),
    dataType: 'json',
    success: function(response){

        $("button[type='submit']").prop('disabled',false)

        var errors = response.errors;

        if(response.status){
            window.location.href = response.redirect;
        }else{
            if(errors.email){
                $("#email").siblings('p').addClass('invalid-feedback').html(errors.email);
                $("#email").addClass('is-invalid');
            } else {
                $("#email").siblings('p').removeClass('invalid-feedback').html('');
                $("#email").removeClass('is-invalid');
            }
            if(errors.password){
                $("#password").siblings('p').addClass('invalid-feedback').html(errors.password);
                $("#password").addClass('is-invalid');
            } else {
                $("#password").siblings('p').removeClass('invalid-feedback').html('');
                $("#password").removeClass('is-invalid');
            }

            if(errors.credentials){
                window.location.reload();
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
