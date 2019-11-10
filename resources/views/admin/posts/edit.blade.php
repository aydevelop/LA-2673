@extends('layouts.admin')

@section('content')
    @component('admin.includes.title')
        Edit post
    @endcomponent

    @if(!empty($post))
        <form  style="text-align:right" method="POST" action="{{ url('admin/posts/'.$post->id) }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-secondary">
                Delete post
            </button>
        </form>

        <form method="POST" action="{{ URL("/admin/posts/".$post->id) }}" enctype="multipart/form-data" >
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-sm-3 col-md-6 col-lg-3">
                    <div class="form-group">
                        <label for="filename">Movie picture</label>
                        <div>
                            <img src="{{ asset('img/posts/'.$post->photo['filename']) }}" 
                            id="profile-img-tag" width="295px" />
                        </div>
                        <input class="m-1" type="file" name="file" id="profile-img">
                    </div>
                </div>

                <div class="col-sm-9 col-md-9 col-lg-9">
                    <div class="form-group">
                        
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input value="{{ $post->name }}" type="text" class="form-control" name="name" placeholder="Enter a user name">
                        </div>

                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control" name="category_id" >
                                <option value="">Select a category</option>
                                @foreach($categories as $category)
                                    <option
                                    {{ $post->category_id == $category->id ? 'selected':'' }}
                                    value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="review">Review</label>
                            <textarea id="" class="form-control" 
                            rows="5" name="review">
                                {{ $post->review }}
                            </textarea> 
                        </div>

                        <button type="submit" class="btn btn-primary mt-4">
                            Edit post
                        </button>
                    </div>
                </div>
            </div>

            <div>
                <div class="mt-4">
                    @component('admin.includes.formErrors')
                    @endcomponent
                </div>
            </div>
        </form>
    @else
        <div>
            Nothing here
        </div>
    @endif

    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <script>

        var options = {
            filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
            filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{ csrf_token() }}',
            filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
            filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{ csrf_token() }}'
        };
        $('textarea').ckeditor(options);

        function readURL(input){
            if(input.files && input.files[0]){
                var fr = new FileReader();
                fr.onload = function(e){
                    $('#profile-img-tag').attr('src', e.target.result);
                }
                fr.readAsDataURL(input.files[0]);
            }
        }

        $('#profile-img').change(function(){
            readURL(this);
        });

    </script>

@endsection