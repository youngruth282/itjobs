@foreach($jobs as $value)
  <tr>
    <td nowrap><small>{{ $value->app_no }}<br>{{ $value->user_name }}</small></td>
    <td nowrap>{{ $value->dept_name }}</td>
    <td>{{ $value->app_item }}</td>
    <td><?php echo nl2br($value->app_content); ?></td>
    <td>{{ $value->app_crewname }}</td>
    <td>{{ $value->app_progress }}</td>
    <td>{{ $value->app_duedate }}</td>
    <td>{{ $value->app_memo }}</td>
    @if (Request::is('jobs'))
    <td>
    @if ($value->app_status!='Y')
      <a class="btn btn-info" href="{{ route('jobs.edit',$value->id) }}">修改</a>
    @endif
    </td>
    @endif

  </tr>
@endforeach
