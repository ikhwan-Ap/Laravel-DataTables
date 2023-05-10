@foreach($users as $user)
<tr>
  <td>{{$user->username}}</td>
  <td>{{$user->email}}</td>
  <td>
    <button type="submit" data-id=' . $hasil->id . ' class="btn btn-danger btnDel" title="DELETE">
        <span class="ion ion-ios-trash">
        </span>
    </button>

    <button type="button" class="btn btn-light btnEdit" data-id="' . $hasil->id . '"  title="EDIT">
        <span class="ion ion-gear-a"></span>
    </button>
  </td>
</tr>
@endforeach