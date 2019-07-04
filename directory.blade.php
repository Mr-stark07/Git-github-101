@extends('layouts/master')

@section('content')
<link href="/assets/plugins/bootstrap-select2/select2.css" rel="stylesheet" type="text/css" media="screen"/>
<script src="/assets/plugins/bootstrap-select2/select2.min.js" type="text/javascript"></script>
<script src="/assets/js/form_validations.js" type="text/javascript"></script>
<script src="/assets/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/plugins/boostrap-form-wizard/js/jquery.bootstrap.wizard.min.js" type="text/javascript"></script>
<link href="/assets/css/styles.imageuploader.css" rel="stylesheet">
<style>
.container-fluid{
  background: #fff;
  padding:10px 20px;
  min-height: 90vh;
}
.head{
  border-bottom: 1px solid #a5adb6;
}
.head button{
  float:right;
  margin-bottom: 10px;
  background: transparent;
  border-radius: 3px;
  border: 1px solid #a5adb6;
  padding-top: 6px;
  padding-bottom: 5px;
  font-size: 14px;
}

.head input{
  float:right;
  border-right: none;
}

.head .path{
  padding-top: 5px;
}

.body{
  margin: 30px auto;
  text-align: center;
}

.body .folder{
  height: 150px;
  width: 150px;
  padding: 10px;
  margin-left: 40px;
  margin-right: 40px; 
}
.body .folder i{
  line-height: 60px;
}
.body .folder img{
  height: 50%;
  width:50%;
  overflow: hidden;
  border: 2px solid lightgray;
  border-radius: 10px;
}
.folder_name, .media_name{
  display:block;
  color: #6f7b8a;
}
#backbtn, #backbtn2{
  margin-right: 20px;
  padding-left: 15px;
  padding-right: 15px;
  display:none;
}
.deleteFolder{
  position: absolute;
  top: 0px;
  right: 28px;
  color: #E74C3C;
  cursor: pointer;
}
.editFolder{
  position: absolute;
  top: 25px;
  right: 25px;
  color: #51b9f3;
  cursor: pointer;
}
.updateFolder{
  position: absolute;
  bottom: 23px;
  right:-10px;
  color: #6dc782;
  cursor: pointer;
  display:none;
  margin:0px;
  padding:0px;
  z-index: 2;
}
.cancelUpdateFolder{
  position: absolute;
  bottom: 45px;
  right:-8px;
  color: #E74C3C;
  cursor: pointer;
  display:none;
  margin:0px;
  padding:0px;
  z-index: 1;
}
.deleteMedia{
  position: absolute;
  top: -10px;
  right: 27px;
  color: #E74C3C;
  cursor: pointer;
}
.editMedia{
  position: absolute;
  top: 15px;
  right: 23px;
  color: #51b9f3;
  cursor: pointer;
}
.updateMedia{
  position: absolute;
  bottom: 16px;
  right: -10px;
  color: #6dc782;
  cursor: pointer;
  display:none;
  margin:0px;
  padding:0px;
  z-index: 2;
}
.cancelUpdateMedia{
  position: absolute;
  top: 50px;
  right: -8px;
  color: #E74C3C;
  cursor: pointer;
  display:none;
  margin:0px;
  padding:0px;
  z-index: 1;
}

.folder a{
  cursor:pointer;
}
#loader{
  margin-right: 10px;
  padding: 8px 10px;
  float: right;
  font-size: 22px;
  display:none;
}
.folder_name input{
  width:130px; 
  display:none;
}
.media_name input{
  width:130px; 
  display:none;
  margin-top: 2px;
}


.project-head{
	height: 100px;
	width: 100%;
	border-radius: 10px;
	background: linear-gradient(120deg,#eefff4,#f9ffe6);
	margin-bottom: 20px;
}
.project-head .title{
	padding-top: 20px;
	padding-left: 20px;
	font-size: 20px !important;
  letter-spacing: 3px;
	font-weight: 600;
}
.head-text-left{
	text-align:left;
	font-size: 14px !important;
  letter-spacing: 2px;
	font-weight: 400;
	padding-left: 25px;
	padding-top: 0px;
}
.head-text-right-top{
	text-align:right;
	font-size: 14px !important;
  letter-spacing: 2px;
	font-weight: 400;
	padding-right: 20px;
	padding-top: 25px;
}
.head-text-right-bottom{
	text-align:right;
	font-size: 14px !important;
  letter-spacing: 2px;
	font-weight: 400;
	padding-right: 20px;
	padding-top: -10px;
}
</style>

<div class="container-fluid">
  <div class="row head">
    <div class="col-md-6 path">
      {{ucwords($project->project_name??'Project Library')}}<span class="pathVar"></span>
    </div>
    <div class="col-md-6">
      <button data-toggle="modal" data-target="#myModal">Create Folder</button>
      <input type="hidden" name="folder_id" class="folder_id1" value="">
      <button id="backbtn" data-project="" data-folder=""><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
      <button id="backbtn2" onclick="window.location.href='/manageprojectblock/{{$project_id}}'"><i class="fa fa-arrow-left" aria-hidden="true"></i></button>
      <i id="loader" class="fa fa-circle-o-notch fa-spin" aria-hidden="true"></i>
    </div>
  </div>
<div class="row" style="margin-top: 20px;">
	<div class="col-md-12">
		<div class="project-head">
			<div class="row">
				<div class="col-md-6">
					<p class="title">{{ucwords($project->project_name??'Project Name')}}</p>
				</div>
				<div class="col-md-6">
					<p class="head-text-right-top">{{$project->booked_unit??'0'}} Sold</p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<p class="head-text-left">{{$project->location??'Project Location'}}</p>
				</div>
				<div class="col-md-6">
					<p class="head-text-right-bottom">{{$project->available_unit??'0'}} Available</p>
				</div>
			</div>
		</div>
	</div>
</div>
  <div class="row body">
    <div class="col-md-12 folders">
    </div>
  </div>
  <input type="hidden" name="media_library_id" id="media_library_id" value="">
  <div class="row">
    <div class="col-ms-12">
      <div class="uploader__box js-uploader__box l-center-box">
				<form action="" method="POST" id="uploadaction">
					<input type="hidden" name="_token" id = "csrftoken" value="{{csrf_token()}}">
         
					<div class="uploader__contents">
						<label class="button button--secondary" for="fileinput">Select Files</label>
						<input id="fileinput" class="uploader__file-input" type="file" multiple value="Select Files">
					</div>
					<input class="button button--big-bottom" type="submit" value="Upload Selected Files">
				</form>
			</div>
    </div>
  </div>
</div>

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Create New Folder</h4>
      </div>
      <div class="modal-body form-group">
        <input type="text" class="form-control" name="folder_name" id="folder_name" placeholder="Enter name">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" id="create_folder">Create</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script>
var isemptyf = 0;
var isemptym = 0;

openFolder({{$project_id}},{{$folder_id}});

function getFolders(project_id,id){
  $.ajax({
    type: 'post',
    url: '/getFolders',
    data: {id:id,project_id:project_id,_token:'{{csrf_token()}}'},
    success: function(response){
      $('.folders').empty();
      var count = 0;
      $.each(response.folders,function(key,value){
        $('.folders').append('<div class="col-md-3 folder">'
        +'<span class="deleteFolder" onclick="deleteFolder('+value.project_id+','+value.id+',this)">'
          +'<i class="fa fa-trash-o" aria-hidden="true"></i>'
        +'</span>'
        +'<span onclick="editFolder(this)" class="editFolder">'
          +'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
        +'</span>'
        +'<span class="updateFolder" onclick="updateFolder('+value.project_id+','+value.id+',this)">'
          +'<i class="fa fa-check" aria-hidden="true"></i>'
        +'</span>'
        +'<span class="cancelUpdateFolder" onclick="cancelUpdateFolder(this)">'
          +'<i class="fa fa-times" aria-hidden="true"></i>'
        +'</span>'
        +'<a data-prjid="'+value.project_id+'" data-folderid="'+value.id+'" onclick="openFolder('+value.project_id+','+value.id+')">'
          +'<i class="fa fa-folder fa-4x"></i>'
        +'</a>'
        +'<div class="folder_name">'
          +'<span class="folder_text">'+value.folder_name+'</span>'
          +'<input type="text" value="'+value.folder_name+'">'
        +'</div></div>');
        count++;
      });
      if(count == 0){
        isemptyf = 1;
      }else{
        isemptyf = 0;
      }
      $('#backbtn').data('project',project_id);
      $('#backbtn').data('folder',response.parentid);
      getFolderMedia(project_id,id);
      if(id == 0){
        $('#backbtn').hide();
        $('#backbtn2').show();
        $('.pathVar').empty();
      }else{
        $('#backbtn').show();
        $('#backbtn2').hide();
        $('.pathVar').empty();
        $('.pathVar').append(response.path);
      }
    }
  });
}

function getFolderMedia(project_id,id){
  $.ajax({
    type: 'post',
    url: '/getFolderMedia',
    data: {project_id:project_id,id:id,_token:'{{csrf_token()}}'},
    success: function(response){
      var count = 0;
      $.each(response,function(key,value){
        $('.folders').append('<div class="col-md-3 folder">'
        +'<span class="deleteMedia" onclick="deleteMedia('+value.folder_id+','+value.id+',this)">'
          +'<i class="fa fa-trash-o" aria-hidden="true"></i>'
        +'</span>'
        +'<span onclick="editMedia(this)" class="editMedia">'
          +'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
        +'</span>'
        +'<span class="updateMedia" onclick="updateMedia('+value.folder_id+','+value.id+',this)">'
          +'<i class="fa fa-check" aria-hidden="true"></i>'
        +'</span>'
        +'<span class="cancelUpdateMedia" onclick="cancelUpdateMedia(this)">'
          +'<i class="fa fa-times" aria-hidden="true"></i>'
        +'</span>'
        +'<a href="'+value.media_name+'" target="_blank">'
          +'<img src="'+value.media_name+'" alt="undefined">'
        +'</a>'
        +'<div class="media_name">'
          +'<span class="media_text">'+value.media_title+'</span>'
          +'<input type="text" value="'+value.media_title+'">'
        +'</div></div>');
        count++;
      });
      if(count == 0){
        isemptym = 1;
      }else{
        isemptym = 0;
      }
      if(isemptyf == 1 && isemptym == 1){
        $('.folders').append('<p style="padding:40px;" id="emptytext">Folder is empty</p>');
        isemptyf = 0; isemptym = 0;
      }else{
        $('#emptytext').hide();
      }
      $('#loader').hide();
    }
  });
}

function openFolder(project_id,folder_id){
    $('#loader').show();
    getFolders(project_id,folder_id);
    $('.folder_id1').val(folder_id);
    $('#media_library_id').val(folder_id);
}

function deleteFolder(project,folder,element){
  $('#loader').show();
  $.ajax({
    type: 'post',
    url: '/deleteFolder',
    data: {folder:folder,project:project,_token:'{{csrf_token()}}'},
    success: function(response){
      $(element).parent().remove();
      $('#loader').hide();
    }
  });
}

function deleteMedia(folderid,mediaid,element){
  $('#loader').show();
  $.ajax({
    type: 'post',
    url: '/deleteMedia',
    data: {folderid:folderid,mediaid:mediaid,_token:'{{csrf_token()}}'},
    success: function(response){
      $(element).parent().remove();
      $('#loader').hide();
    }
  });
}

function updateFolder(project,folder,element){
  var folderName = $(element).parent().find('div').find('input').val();
  if($.trim(folderName) != ""){
    $('#loader').show();
    $.ajax({
      type: 'post',
      url: '/editFolder',
      data: {folder:folder,project:project,folderName:folderName,_token:'{{csrf_token()}}'},
      success: function(response){
        $('#loader').hide();
        $(element).parent().find('div').find('input').hide();
        $(element).parent().find('div').find('span').text(folderName);
        $(element).parent().find('div').find('span').show();
        $(element).parent().find('.updateFolder').hide();
        $(element).parent().find('.cancelUpdateFolder').hide();
      }
    });
  }else{
    alertify.error('Folder name is required.');
  }
 
}

function updateMedia(folderid,mediaid,element){
  var mediaName = $(element).parent().find('div').find('input').val();
  if($.trim(mediaName) != ''){
    $('#loader').show();
    $.ajax({
      type: 'post',
      url: '/editMedia',
      data: {folderid:folderid,mediaid:mediaid,mediaName:mediaName,_token:'{{csrf_token()}}'},
      success: function(response){
        $('#loader').hide();
        $(element).parent().find('div').find('input').hide();
        $(element).parent().find('div').find('span').text(mediaName);
        $(element).parent().find('div').find('span').show();
        $(element).parent().find('.updateMedia').hide();
        $(element).parent().find('.cancelUpdateMedia').hide();
      }
    });
  }else{
    alertify.error('Media title is required.');
  }
 
}

$(function(){
  $('#create_folder').on('click',function(){
    $('#loader').show();
    var folderName = $('#folder_name').val();
    var parent = $('.folder_id1').val();
    var project = '{{$project_id}}';
    if($.trim(folderName) == ''){
      alertify.error('Folder name can\'t be empty.');
    }else{
      $.ajax({
        type: 'post',
        url: '/createFolder',
        data: {folderName:folderName,parent:parent,project:project,_token:'{{csrf_token()}}'},
        success: function(response){
          $('.folders').append('<div class="col-md-3 folder">'
          +'<span class="deleteFolder" onclick="deleteFolder('+response.project_id+','+response.id+',this)">'
            +'<i class="fa fa-trash-o" aria-hidden="true"></i>'
          +'</span>'
          +'<span onclick="editFolder(this)" class="editFolder">'
            +'<i class="fa fa-pencil-square-o" aria-hidden="true"></i>'
          +'</span>'
          +'<span class="updateFolder" onclick="updateFolder('+response.project_id+','+response.id+',this)">'
            +'<i class="fa fa-check" aria-hidden="true"></i>'
          +'</span>'
          +'<span class="cancelUpdateFolder" onclick="cancelUpdateFolder(this)">'
            +'<i class="fa fa-times" aria-hidden="true"></i>'
          +'</span>'
          +'<a data-prjid="'+response.project_id+'" data-folderid="'+response.id+'" onclick="openFolder('+response.project_id+','+response.id+')">'
            +'<i class="fa fa-folder fa-4x"></i>'
          +'</a>'
          +'<div class="folder_name">'
            +'<span class="folder_text">'+response.name+'</span>'
            +'<input type="text" value="'+response.name+'">'
          +'</div></div>');
          $('#folder_name').val('');
          $('#emptytext').hide();
          $('#myModal').modal('hide');
          $('#loader').hide();
        }
      });
    }
  });

  $('#backbtn').on('click',function(){
    var project = $(this).data('project');
    var folder = $(this).data('folder');
    openFolder(project,folder);
    $('.folder_id1').val(folder);
  });


});

function editFolder(element){
  $(element).parent().find('div').find('span').hide();
  $(element).parent().find('div').find('input').show();
  $(element).parent().find('.updateFolder').show();
  $(element).parent().find('.cancelUpdateFolder').show();
}

function editMedia(element){
  $(element).parent().find('div').find('span').hide();
  $(element).parent().find('div').find('input').show();
  $(element).parent().find('.updateMedia').show();
  $(element).parent().find('.cancelUpdateMedia').show();
}

function cancelUpdateFolder(element){
  var name = $(element).parent().find('div').find('span').text();
  $(element).parent().find('div').find('span').show();
  $(element).parent().find('div').find('input').hide();
  $(element).parent().find('div').find('input').val(name);
  $(element).parent().find('.updateFolder').hide();
  $(element).parent().find('.cancelUpdateFolder').hide();
}

function cancelUpdateMedia(element){
  var name = $(element).parent().find('div').find('span').text();
  $(element).parent().find('div').find('span').show();
  $(element).parent().find('div').find('input').hide();
  $(element).parent().find('div').find('input').val(name);
  $(element).parent().find('.updateMedia').hide();
  $(element).parent().find('.cancelUpdateMedia').hide();
}

</script>

<script src="/assets/js/uploader-custom.js" type="text/javascript"></script>
<script>
  $(function(){
  var options = {ajaxUrl: '/uploadFolderMedia/{{$project_id}}'};
    $('.js-uploader__box').uploader(options);
  });
</script>
@stop
