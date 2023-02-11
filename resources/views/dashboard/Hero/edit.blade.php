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
              <h4 class="card-title">Create Data Book</h4>
              <p class="card-description"> Basic form elements </p>

              <form class="forms-sample" action="/dashboard-update/{{ $heros->id }}" method="POST">
                @csrf
                @method('put')

                <div class="form-group">
                  <label for="exampleInputName1">Sub</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="sub" placeholder="Name" value="{{ old('sub', $heros->sub) }}">
                </div>

                <div class="form-group">
                  <label for="exampleInputName1">Header 1</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="header1" placeholder="Name" value="{{ old('header1', $heros->header1) }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Header 2</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="header2" placeholder="Name" value="{{ old('header2', $heros->header2) }}">
                </div>
                <div class="form-group">
                  <label for="exampleInputName1">Header 3</label>
                  <input type="text" class="form-control" id="exampleInputName1" name="header3" placeholder="Name" value="{{ old('header3', $heros->header3) }}">
                </div>

                <div class="form-group">
                    <label for="exampleTextarea1">Desc</label>
                    <textarea class="form-control" id="exampleTextarea1" name="desc" rows="4">{{ old('desc', $heros->desc) }}</textarea>
                  </div>


                  <div class="form-group">
                    <label for="backgroundone">Gallery</label>
                    <div class="needsclick dropzone" id="backgroundone-dropzone"></div>
                    </div>

                <div class="form-group">
                    <label for="backgroundtwo">Gallery 1</label>
                    <div class="needsclick dropzone" id="backgroundtwo-dropzone"></div>
                    </div>

                <div class="form-group">
                    <label for="charone">Gallery 2</label>
                    <div class="needsclick dropzone" id="charone-dropzone"></div>
                    </div>

                <div class="form-group">
                    <label for="chartwo">Gallery 3</label>
                    <div class="needsclick dropzone" id="chartwo-dropzone"></div>
                    </div>

                <div class="form-group">
                    <label for="body">Gallery 4</label>
                    <div class="needsclick dropzone" id="body-dropzone"></div>
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
    var uploadedBackgroundoneMap = {}
 Dropzone.options.backgroundoneDropzone = {
     url: "{{ route('storeImages') }}",
     maxFilesize: 10, // MB
     maxFiles: 4,
     acceptedFiles: '.jpeg,.jpg,.png,.gif',
     addRemoveLinks: true,
     headers: {
       'X-CSRF-TOKEN': "{{ csrf_token() }}"
     },
     success: function (file, response) {
       $('form').append('<input type="hidden" name="backgroundone[]" value="' + response.name + '">')
       uploadedbackgroundoneMap[file.name] = response.name
     },
     removedfile: function (file) {
       file.previewElement.remove()
       var name = ''
       if (typeof file.file_name !== 'undefined') {
         name = file.file_name
       } else {
         name = uploadedbackgroundoneMap[file.name]
       }
       $('form').find('input[name="backgroundone[]"][value="' + name + '"]').remove()
     },
     init: function () {

 @if(isset($heros) && $heros->getMedia('backgroundone'))
       var files =
         {!! json_encode($heros->getMedia('backgroundone')) !!}
           for (var i in files) {
           var file = files[i]
           this.options.addedfile.call(this, file)
           this.options.thumbnail.call(this, file, file.original_url)
           file.previewElement.classList.add('dz-complete')
           $('form').append('<input type="hidden" name="backgroundone[]" value="' + file.file_name + '">')
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

<script>
    var uploadedBackgroundtwoMap = {}
 Dropzone.options.backgroundtwoDropzone = {
     url: "{{ route('storeImages') }}",
     maxFilesize: 10, // MB
     maxFiles: 4,
     acceptedFiles: '.jpeg,.jpg,.png,.gif',
     addRemoveLinks: true,
     headers: {
       'X-CSRF-TOKEN': "{{ csrf_token() }}"
     },
     success: function (file, response) {
       $('form').append('<input type="hidden" name="backgroundtwo[]" value="' + response.name + '">')
       uploadedbackgroundtwoMap[file.name] = response.name
     },
     removedfile: function (file) {
       file.previewElement.remove()
       var name = ''
       if (typeof file.file_name !== 'undefined') {
         name = file.file_name
       } else {
         name = uploadedbackgroundtwoMap[file.name]
       }
       $('form').find('input[name="backgroundtwo[]"][value="' + name + '"]').remove()
     },
     init: function () {

 @if(isset($heros) && $heros->getMedia('backgroundtwo'))
       var files =
         {!! json_encode($heros->getMedia('backgroundtwo')) !!}
           for (var i in files) {
           var file = files[i]
           this.options.addedfile.call(this, file)
           this.options.thumbnail.call(this, file, file.original_url)
           file.previewElement.classList.add('dz-complete')
           $('form').append('<input type="hidden" name="backgroundtwo[]" value="' + file.file_name + '">')
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

<script>
    var uploadedCharoneMap = {}
 Dropzone.options.charoneDropzone = {
     url: "{{ route('storeImages') }}",
     maxFilesize: 10, // MB
     maxFiles: 4,
     acceptedFiles: '.jpeg,.jpg,.png,.gif',
     addRemoveLinks: true,
     headers: {
       'X-CSRF-TOKEN': "{{ csrf_token() }}"
     },
     success: function (file, response) {
       $('form').append('<input type="hidden" name="charone[]" value="' + response.name + '">')
       uploadedcharoneMap[file.name] = response.name
     },
     removedfile: function (file) {
       file.previewElement.remove()
       var name = ''
       if (typeof file.file_name !== 'undefined') {
         name = file.file_name
       } else {
         name = uploadedcharoneMap[file.name]
       }
       $('form').find('input[name="charone[]"][value="' + name + '"]').remove()
     },
     init: function () {

 @if(isset($heros) && $heros->getMedia('charone'))
       var files =
         {!! json_encode($heros->getMedia('charone')) !!}
           for (var i in files) {
           var file = files[i]
           this.options.addedfile.call(this, file)
           this.options.thumbnail.call(this, file, file.original_url)
           file.previewElement.classList.add('dz-complete')
           $('form').append('<input type="hidden" name="charone[]" value="' + file.file_name + '">')
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

<script>
    var uploadedChartwoMap = {}
 Dropzone.options.chartwoDropzone = {
     url: "{{ route('storeImages') }}",
     maxFilesize: 10, // MB
     maxFiles: 4,
     acceptedFiles: '.jpeg,.jpg,.png,.gif',
     addRemoveLinks: true,
     headers: {
       'X-CSRF-TOKEN': "{{ csrf_token() }}"
     },
     success: function (file, response) {
       $('form').append('<input type="hidden" name="chartwo[]" value="' + response.name + '">')
       uploadedchartwoMap[file.name] = response.name
     },
     removedfile: function (file) {
       file.previewElement.remove()
       var name = ''
       if (typeof file.file_name !== 'undefined') {
         name = file.file_name
       } else {
         name = uploadedchartwoMap[file.name]
       }
       $('form').find('input[name="chartwo[]"][value="' + name + '"]').remove()
     },
     init: function () {

 @if(isset($heros) && $heros->getMedia('chartwo'))
       var files =
         {!! json_encode($heros->getMedia('chartwo')) !!}
           for (var i in files) {
           var file = files[i]
           this.options.addedfile.call(this, file)
           this.options.thumbnail.call(this, file, file.original_url)
           file.previewElement.classList.add('dz-complete')
           $('form').append('<input type="hidden" name="chartwo[]" value="' + file.file_name + '">')
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

<script>
    var uploadedBodyMap = {}
 Dropzone.options.bodyDropzone = {
     url: "{{ route('storeImages') }}",
     maxFilesize: 10, // MB
     maxFiles: 4,
     acceptedFiles: '.jpeg,.jpg,.png,.gif',
     addRemoveLinks: true,
     headers: {
       'X-CSRF-TOKEN': "{{ csrf_token() }}"
     },
     success: function (file, response) {
       $('form').append('<input type="hidden" name="body[]" value="' + response.name + '">')
       uploadedbodyMap[file.name] = response.name
     },
     removedfile: function (file) {
       file.previewElement.remove()
       var name = ''
       if (typeof file.file_name !== 'undefined') {
         name = file.file_name
       } else {
         name = uploadedbodyMap[file.name]
       }
       $('form').find('input[name="body[]"][value="' + name + '"]').remove()
     },
     init: function () {

 @if(isset($heros) && $heros->getMedia('body'))
       var files =
         {!! json_encode($heros->getMedia('body')) !!}
           for (var i in files) {
           var file = files[i]
           this.options.addedfile.call(this, file)
           this.options.thumbnail.call(this, file, file.original_url)
           file.previewElement.classList.add('dz-complete')
           $('form').append('<input type="hidden" name="body[]" value="' + file.file_name + '">')
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
