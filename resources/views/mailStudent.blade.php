@component('mail::message')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" >
    <title>Document</title>
</head>
<body style="align: center">
    <table style="width:100%">
        <tr>
            <th>
                <a href="http://www.uajy.ac.id/" target="_blank">
                    <img src="http://logo.uajy.ac.id/file/uploads/2021/08/UAJY-LOGOGRAM_-01.png" width="100px" height="105px" class="rounded float-start">
                </a>
            </th>
            <th><p>190710310</p></th>
        </tr>
    </table>
    <hr>
    <br>
    <h2 align="center">Data Mahasiswa</h2>
    <br>
    <table style="width:100%" class="table table-bordered" align="center" border="solid">
        <tr>
            <th class="text-center">No</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone Number</th>
            <th>Place & Date of Birth</th>
        </tr>
        @if(count($detail))
        @foreach ($detail as $details)
        <tr>
            <td style="text-align: center;">{{ $details->id }}</td>
            <td>{{ $details->nama_depan .' '. $details->nama_belakang }}</td>
            <td>{{ $details->email }}</td>
            <td>{{ $details->no_telp }}</td>
            <td type="text">{{ $details->tempat_lahir .', '. date('d M Y', strtotime($details->tanggal_lahir)) }}</td>
        </tr>
        @endforeach
        @else
    <tr>
        <td align="center" colspan="3">Empty Data!! Have a nice day :)</td>
    </tr>
    @endif
    </table>
    
</body>
</html>
@endcomponent