<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
<style>
.margin-5{
  margin: 5px 5px 5px 5px;
}
</style>
</head>
<body>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="{{url('/')}}">Hub Management</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
      <ul class="navbar-nav">
        <li class="nav-item active">
          <a class="nav-link" href="{{url('/')}}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('/driver')}}">Driver List</a>
        </li>
      </ul>
    </div>
  </nav>
<div class="container-fluid">
  <!-- Button trigger modal -->
  <br>
  @if (\Session::has('success'))
  <div class="alert alert-success">
    <p>{!! \Session::get('success') !!}</p>
  </div>
  @endif
  <br>
<button type="button" class="btn btn-primary margin-5" data-toggle="modal" data-target="#exampleModalLong">
  Region Map
</button>
<a class="btn btn-danger margin-5" href="?status=unloaded" role="button">Unloading Bay  <span class="badge">{{$unloaded}}</span></a>
<a class="btn btn-info margin-5" href="?status=buffer" role="button">Buffer Area  <span class="badge">{{$buffer}}</span></a>
<a class="btn btn-primary margin-5" href="?status=delivered" role="button">Delivered good  <span class="badge">{{$delivered}}</span></a>
<br>
<br>


<!-- Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Region Map</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <img style="max-height: 100%;max-width: 100%;" src="{{url('/img/map.png')}}">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
  <table class="table">
    <thead>
      <tr>
        <th scope="col">Driver id</th>
        <th scope="col">Product description</th>
        <th scope="col">Status</th>
        <th scope="col">Region</th>
        <th scope="col">Created at</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>

      @foreach($goods as $good)
      <tr>
        <td>{{$good['driver_id']}}</td>
        <td>{{$good['description']}}</td>
        <td>
        <select id="{{$good['status'].'-'.$good['id']}}" class="status">
          <option value="unloaded">unloaded</option>
          <option value="buffer">buffer</option>
          <option value="delivered">delivered</option>
        </select>
        </td>
        <td>{{$good['region_id']}}</td>
        <td>{{$good['created_at']}}</td>
        <td><a class="btn btn-danger" href="{{route('delete_good')}}?id={{$good['id']}}" role="button">Delete</a><br><br>
        </td>
      </tr>
      @endforeach
    </tbody>

  </table>
</div>
</div>
</body>

<script>
$(document).ready(function() {
    $(".status").each(function() {
        var status = $(this).attr("id").split('-')[0];
        // console.log(status);
        $(this).val(status);
    });

    $('.status').on('change', function () {
      var status = $(this).val();
        var id = $(this).attr("id").split('-')[1];
        var url = '<?php echo route('update_good');?>?status='+status+"&id="+id;
        if (url) {
            window.location = url; // redirect
        }
        return false;
    });
});
</script>
</html>
