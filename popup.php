<form class="box" method="post" action="" enctype="multipart/form-data">
  <div class="box__input">
    <input class="box__file" type="file" name="files[]" id="file" data-multiple-caption="{count} files selected" multiple />
    <label for="file"><strong>Choose a file</strong><span class="box__dragndrop"> or drag it here</span>.</label>
    <button class="box__button" type="submit">Upload</button>
  </div>
  <div class="box__uploading">Uploading&hellip;</div>
  <div class="box__success">Done!</div>
  <div class="box__error">Error! <span></span>.</div>
</form>
<script>
var div = document.createElement('div');
return ('draggable' in div) || ('ondragstart' in div && 'ondrop' in div)
return 'FormData' in window;
<script type="text/javascript" src="./lib/jquery-3.3.1.min.js">
var $form = $('.box');

if (isAdvancedUpload) {
  $form.addClass('has-advanced-upload');
}
if (isAdvancedUpload) {

  var droppedFiles = false;

  $form.on('drag dragstart dragend dragover dragenter dragleave drop', function(e) {
    e.preventDefault();
    e.stopPropagation();
  })
  .on('dragover dragenter', function() {
    $form.addClass('is-dragover');
  })
  .on('dragleave dragend drop', function() {
    $form.removeClass('is-dragover');
  })
  .on('drop', function(e) {
    droppedFiles = e.originalEvent.dataTransfer.files;
  });

}
</script>
