<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
  <title>Document</title>
</head>
<body>
<div style="display:flex;justify-content:center; align-items:center; flex-direction:column;">
  <h4>IP: <span id="ip"></span></h4>
  <h4>City: <span id="city"></span></h4>
  <h4>State: <span id="state"></span></h4>
</div>
<hr>
  <table id="example" class="display" style="width:100%;">
        <thead>
            <tr>
                <th>ID</th>
                <th>Value</th>
            </tr>
        </thead>
        <tbody>
          @foreach($new_collection as $key => $value)
            <tr>
                <td>{{$key+1}}</td>
                <td>{{$value}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div style="margin-bottom:200px; "></div>

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
    <script>
      $('#example').DataTable( {
          dom: 'Bfrtip',
          buttons: [
              'excel',
              'print'
          ]
      } );

      $.getJSON('http://www.geoplugin.net/json.gp', function(data) {
        let datat = JSON.stringify(data, null, 2);
        $('#ip').text(data.geoplugin_request);
        document.cookie = "IP="+data.geoplugin_request;
        $('#city').text(data.geoplugin_city);
        document.cookie = "CITY="+data.geoplugin_city;
        $('#state').text(data.geoplugin_region);
        document.cookie = "STATE="+data.geoplugin_region;

      });
    </script>
</body>
</html>