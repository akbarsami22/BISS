@extends('common.common')

@section('section')
<section class="vh-100 d-flex align-items-center" style="background-color: #f0f2f5;">
    <div class="container d-flex justify-content-center">
        <div class="row justify-content-center w-100">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg" style="border-radius: 15px;">
                    <div class="card-body p-4">
                        <h3 class="text-center mb-4">Register</h3>

                        <form id="registerForm" method="post">

                            <!-- CSRF Token -->
                            @csrf
                            <!-- Name input -->
                            <div class="form-group mb-3">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" id="name" name="name" class="form-control form-control-lg" placeholder="Name" >
                                <p></p>
                            </div>

                            <!-- Email input -->
                            <div class="form-group mb-3">
                                <label class="form-label" for="email">Email</label>
                                <input type="email" id="email" name="email" class="form-control form-control-lg" placeholder="Email" >
                                <p></p>
                            </div>

                            <!-- Password input -->
                            <div class="form-group mb-4">
                                <label class="form-label" for="password">Password</label>
                                <input type="password" id="password" name="password" class="form-control form-control-lg" placeholder="Password" >
                                <p></p>
                            </div>

                            <!-- Confirm Password input -->
                            <div class="form-group mb-4">
                                <label class="form-label" for="confirm_password">Confirm Password</label>
                                <input type="password" id="confirm_password" name="confirm_password" class="form-control form-control-lg" placeholder="Confirm Password" >
                                <p></p>
                            </div>

                            <!-- Submit button -->
                            <button class="btn btn-primary w-100 btn-lg" type="submit">Register</button>
                        </form>
                            <!-- Register link -->
                            <div class="text-center mt-3">
                                <p class="mb-0">Already have an account? <a href="{{route('login')}}" class="text-primary">login</a></p>
                            </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection

@section('custom_js')
<script type="text/javascript">
    $("#registerForm").submit(function(event){
        event.preventDefault();

        $("button[type='submit']").prop('disabled',true)

$.ajax({
    url: '{{ route("register_process") }}',
    type: 'post',
    data: $(this).serializeArray(),
    dataType: 'json',
    success: function(response){

        $("button[type='submit']").prop('disabled',false)

        if(response.status == false){
            var errors = response.errors;

            if(errors.name){
                $("#name").siblings('p').addClass('invalid-feedback').html(errors.name);
                $("#name").addClass('is-invalid');
            } else {
                $("#name").siblings('p').removeClass('invalid-feedback').html('');
                $("#name").removeClass('is-invalid');
            }

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
            if(errors.confirm_password){
                $("#confirm_password").siblings('p').addClass('invalid-feedback').html(errors.confirm_password);
                $("#confirm_password").addClass('is-invalid');
            } else {
                $("#confirm_password").siblings('p').removeClass('invalid-feedback').html('');
                $("#confirm_password").removeClass('is-invalid');
            }
        }else{
            window.location.href="{{route('login')}}"
        }
        },
        error: function(jQXHR, exception){
            console.log('something went wrong');
        }
    });
    });
</script>
@endsection

