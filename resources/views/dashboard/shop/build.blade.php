<script>
    var uploadedshopsMap = {}
 Dropzone.options.shopsDropzone = {
     url: "{{ route('storeImages') }}",
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
