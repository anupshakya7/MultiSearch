<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Search Filter</title>
</head>

<body>

    <div class="container">
        <div class="card p-3 mt-3">
            <form action="{{route('search')}}" method="GET">
                <div class="row">
                    <div class="col-sm-3">
                        <?php
                            //$country = App\Models\Country::all();
                            $country = Illuminate\Support\Facades\DB::table('countries')->select('id','name')->get();
                        ?>
                        <label for="country">Country</label>
                        <select class="form-select" id="country" name="country">
                            <option value="">Select Country</option>
                            @foreach($country as $countries)
                            <option value="{{$countries->id}}">{{$countries->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            $institute = App\Models\Institute::all();
                        ?>
                        <label for="institute">Institute</label>
                        <select class="form-select" id="institute" name="institute">
                            <option value="">Select Institute</option>
                            @foreach($institute as $institutes)
                            <option value="{{$institutes->id}}">{{$institutes->university}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            $level = App\Models\StudyLevel::all();
                        ?>
                        <label for="country">Study Level</label>
                        <select class="form-select" id="level" name="level">
                            <option value="">Select Study Level</option>
                            @foreach($level as $levels)
                            <option value="{{$levels->id}}">{{$levels->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-sm-3">
                        <?php
                            $course = App\Models\Course::all();
                        ?>
                        <label for="country">Course</label>
                        <select class="form-select" id="course" name="course">
                            <option value="">Select Course</option>
                            @foreach($course as $courses)
                            <option value="{{$courses->id}}">{{$courses->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary mt-2 w-100">Submit</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
        integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
        crossorigin="anonymous" referrerpolicy="no-referrer">
    </script>
    <script>
        $(document).ready(function(){
            $('#country').change(function(){
                let country_id = $('#country').val();
                if(country_id != null){
                    $.ajax({
                        url:'/dropdown/country/'+country_id,
                        type:'GET',
                        dataType:'json',
                        success: function(response){
                            if(response.status == 200){
                                console.log(response);
                                $('#institute').html('');
                                $('#level').html('');
                                $('#course').html('');
                                $('#institute').append('<option value="">Select Institute</option>');
                                $('#level').append('<option value="">Select Study Level</option>');
                                $('#course').append('<option value="">Select Course</option>');
                                $.each(response.institute,function(key,item){
                                    $('#institute').append('<option value="'+item.id+'">'+item.university+'</option>')
                                });
                                $.each(response.study_level,function(key,item){
                                    $('#level').append('<option value="'+item.id+'">'+item.name+'</option>')
                                });
                                $.each(response.course,function(key,item){
                                    $('#course').append('<option value="'+item.id+'">'+item.name+'</option>')
                                });
                            }
                        },
                    })
                }
            });

            $('#institute').change(function(){
                let institute_id = $('#institute').val();
                let country = $('#country').val();
                let course = $('#course').val();
                let level = $('#level').val();
                if(institute_id != null){
                    $.ajax({
                        url:'/dropdown/institute/'+institute_id,
                        type:'GET',
                        dataType:'json',
                        success: function(response){
                            if(response.status == 200){
                                console.log(response);
                                $('#country').val(response.country.id);
                                $('#course').html('');
                                $('#level').html('');
                                $('#course').append('<option value="">Select Course</option>');
                                $('#level').append('<option value="">Select Study Level</option>');
                                $.each(response.course,function(key,item){
                                    $('#course').append('<option value="'+item.id+'">'+item.name+'</option>')
                                });
                                $.each(response.study_level,function(key,item){
                                    $('#level').append('<option value="'+item.id+'">'+item.name+'</option>')
                                });
                            }
                        },
                    })
                }
            });
            
        })
    </script>
</body>

</html>