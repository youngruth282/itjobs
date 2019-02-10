<!-- Modal -->
<div class="modal fade modal-md" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document">
  <div class="modal-content">
    <div class="modal-header"><h4 class="modal-title" id="myModalLabel"> 删除 </h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
  <!--    <h4 class="modal-title" id="myModalLabel"> 删除 </h4>  -->
    </div>
    <div class="modal-body">
     <p>確定要删除嗎? </p>
    </div>
    <div class="modal-footer">
      {!! Form::open(['method' => 'DELETE','route' => ['jobs.destroy', $job->id],'style'=>'display:inline']) !!}
      <a href="#" class="btn btn-secondary" data-dismiss="modal">取消</a>
      <input type=hidden name="del_id" id="del_id" value="{{ $job->id}}">
      {!! Form::submit('確認', ['class' => 'btn btn-danger']) !!}
      {!! Form::close() !!}
    </div>
  </div>
</div>
</div>

<!--<script type="text/javascript">
     function del_user(uid)
     {
       $("#del_id").val(uid);
       $("#myModal").modal('show');
     }
</script>-->
