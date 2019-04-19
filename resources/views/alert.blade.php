@if(session('message')!=null)
<div class="alert alert-info alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <i class="icon fa fa-info"></i> <b>INFORMASI </b> :  {{ session('message')}}
</div>
@endif