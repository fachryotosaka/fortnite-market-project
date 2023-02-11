@extends('layouts.dashboard-main')
@section('content')


<div class="main-panel">
    <div class="content-wrapper">
      <div class="page-header">
        <h3 class="page-title"> Form elements </h3>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Forms</a></li>
            <li class="breadcrumb-item active" aria-current="page">Form elements</li>
          </ol>
        </nav>
      </div>
      <div class="row">
        <div class="col-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Create Data </h4>
              <p class="card-description"> Basic form elements </p>

              <form class="forms-sample" action="{{ route('store-shop') }}" method="POST">
                @csrf

                <div class="form-group">
                  <label for="exampleInputName1">Name </label>
                  <input type="text" class="form-control" id="exampleInputName1" name="name" placeholder="Name">
                </div>


                <div class="form-group">
                    <label for="exampleSelectGender">Category</label>
                    <select name="category_id" class="form-control">
                      @foreach($categories as $id => $name)
                      <option value="{{ $name->id }}">{{ $name->name }}</option>
                  @endforeach
                  </select>
                  </div>

                <div class="form-group">
                  <label for="exampleInputName1">Price</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="price" placeholder="Price">
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Description</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="descs" placeholder="Price">
                </div>




                <div class="form-group">
                    <label for="shops">Image</label>
                    <div class="needsclick dropzone" id="shops-dropzone"></div>
                    </div>




                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                <button class="btn btn-light">Cancel</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>


@endsection
@push('style-alt')
<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
@endpush
@push('js-alt')
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>



<script>
    var uploadedShopsMap = {}
 Dropzone.options.shopsDropzone = {
     url: "{{ route('storeImages-shop') }}",
     maxFilesize: 10, // MB
     maxFiles: 4,
     acceptedFiles: '.jpeg,.jpg,.png,.gif',
     addRemoveLinks: true,
     headers: {
       'X-CSRF-TOKEN': "{{ csrf_token() }}"
     },
     success: function (file, response) {
       $('form').append('<input type="hidden" name="shops[]" value="' + response.name + '">')
       uploadedshopsMap[file.name] = response.name
     },
     removedfile: function (file) {
       file.previewElement.remove()
       var name = ''
       if (typeof file.file_name !== 'undefined') {
         name = file.file_name
       } else {
         name = uploadedshopsMap[file.name]
       }
       $('form').find('input[name="shops[]"][value="' + name + '"]').remove()
     },
     init: function () {

 @if(isset($shop) && $shop->shop)
       var files =
         {!! json_encode($shop->shop) !!}
           for (var i in files) {
           var file = files[i]
           this.options.addedfile.call(this, file)
           this.options.thumbnail.call(this, file, file.original_url)
           file.previewElement.classList.add('dz-complete')
           $('form').append('<input type="hidden" name="shops[]" value="' + file.file_name + '">')
         }
 @endif
     },
      error: function (file, response) {
          if ($.type(response) === 'string') {
              var message = response //dropzone sends it's own error messages in string
          } else {
              var message = response.errors.file
          }
          file.previewElement.classList.add('dz-error')
          _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
          _results = []
          for (_i = 0, _len = _ref.length; _i < _len; _i++) {
              node = _ref[_i]
              _results.push(node.textContent = message)
          }
          return _results
      }
 }
 </script>



@endpush

