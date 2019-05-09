<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
  <script src="{{url('/js/jquery-qrcode-0.17.0.min.js')}}"></script>
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
  <br>

  <div class="container-fluid">

    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">QR code generator</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <img style="max-height:100%;max-width: 100%;" src="{{url('/img/map.png')}}">
            <select class="form-control" id="region_id" name="region_id">
              <option value="A">Area A</option>
              <option value="B">Area B</option>
              <option value="C">Area C</option>
              <option value="D">Area D</option>
              <option value="E">Area E</option>
              <option value="F">Area F</option>
              <option value="G">Area G</option>
              <option value="H">Area H</option>
            </select>
            <div class="input-group">
              <input type="text" class="form-control" id="description" name="description" placeholder="Product description" required>
            </div>
            <div id="qr-code-div">
              <p><b>QR code tag of driver</b></p>
              <center><div id="qrcode"></div></center>
              <p>Product: <span id="product"></span></p>
              <p>Area: <span id="area"></span></p>
              <a href="#" id="good-link">Click to register good</a>
            </div>
          </div>
          <div class="modal-footer">
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          </div>
        </div>
      </div>
    </div>
    <br>
    @if (\Session::has('success'))
    <div class="alert alert-success">
      <p>{!! \Session::get('success') !!}</p>
    </div>
    @endif
    <br>

    <a class="btn btn-primary" href="{{url('/driver/register')}}" role="button">Add driver</a><br><br>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Driver ID</th>
          <th scope="col">Last Name</th>
          <th scope="col">First Name</th>
          <th scope="col">ID No.</th>
          <th scope="col">Phone No.</th>
          <th scope="col">Car liscene</th>
          <th scope="col">Country of liscene</th>
          <th scope="col">Company</th>
          <th scope="col">Registered at</th>
          <th scope="col">Unload item</th>
          <th scope="col">Delete</th>
        </tr>
      </thead>
      <tbody>

        @foreach($drivers as $driver)
        <tr>
          <td>{{$driver['id']}}</td>
          <td>{{$driver['last_name']}}</td>
          <td>{{$driver['first_name']}}</td>
          <td>{{$driver['identity']}}</td>
          <td>{{$driver['phone']}}</td>
          <td>{{$driver['car_liscene']}}</td>
          <td>{{$driver['country_of_liscene']}}</td>
          <td>{{$driver['company']}}</td>
          <td>{{$driver['created_at']}}</td>
          <td><button type="button" id="{{$driver['id']}}" class="qr-modal btn btn-info" data-toggle="modal" data-target=".bd-example-modal-lg">Click</button></td>
          <td><a class="btn btn-danger" href="{{url('/driver/delete')}}?id={{$driver['id']}}" role="button">Delete</a><br><br>
          </td>
        </tr>
        @endforeach
      </tbody>

    </table>

  </div>
</body>
<script>
$(document).ready(function(){
  var driver_id = 0;
  var area = "A";

  $(".qr-modal").on('click', function(event){
      driver_id = this.id;
      $('#description').val("");
      $('#qr-code-div').hide();
  });

  $('#region_id').on('change', function (e) {
    area = $("#region_id").children("option:selected").val();
  });

  $( "#description" ).on('input', function() {
    var description = $('#description').val();
    var description_url = encodeURIComponent(description.trim());
    if(description.length > 0 && description.trim() != ""){
      $('#qr-code-div').show();
      $("#product").text(description);
      $("#area").text(area);
    }else {
      $('#qr-code-div').hide();
    }
    $('#qrcode').empty();
    var link = "<?php echo route("good_register");?>"+"?driver_id="+driver_id+"&description="+description_url+"&region_id="+area;
    $('#qrcode').qrcode({text: link});
    $('#good-link').attr("href", link);
  });

});
</script>
</html>
