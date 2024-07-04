<?php

$qry = mysqli_query($conn, 'SELECT * FROM users');
if (!$qry or !mysqli_num_rows($qry)) {
    echo "<div class='text-center fw-bold'>no driver applications currently</div>";
} else {
    $i = 0;
    while ($row = mysqli_fetch_assoc($qry)) {
        $uid = $row['uid'];
        $driverFile = file_exists("{$root}pdfs/driverdetails_$uid.pdf");
        $vehicleFile = file_exists("{$root}pdfs/vehicledetails_$uid.pdf");
        $documentFile = file_exists("{$root}pdfs/driverdocument_$uid.pdf");

        if (!$driverFile && !$vehicleFile && !$documentFile) {
            continue;
        }


        echo "<table class='table table-bordered table-dark'>
             <legend>Driver Applications: </legend>
            <thead>
                <tr>
                    <th scope='col' class='text-center'>#</th>
                    <th scope='col'>name</th>
                    <th scope='col'>email addres</th>
                    <th scope='col'>vehicle details</th>
                    <th scope='col'>driver details</th>
                    <th scope='col'>documents</th>
                <tr>
            </thead>
            <tbody>";

        $i = 1;
        $name = $row['uname'];
        $email = base64_decode($row['uemail']);

        $vehicleFileDownloadUri = 'not uploaded';
        $driverFileDownloadUri = 'not uploaded';
        $documentFileDownloadUri = 'not uploaded';

        if ($vehicleFile) {
            $vehicleFileDownloadUri = "<a href='{$baseurl}pdfs/vehicledetails_$uid.pdf' download='vehicledetails_$uid.pdf'><i class='ri-download-line'></i>download pdf</a>";
        }

        if ($documentFile) {
            $documentFileDownloadUri = "<a href='{$baseurl}pdfs/driverdocument_$uid.pdf' download='driverdocument_$uid.pdf'><i class='ri-download-line'></i>download pdf</a>";
        }

        if ($driverFile) {
            $driverFileDownloadUri = "<a href='{$baseurl}pdfs/driverdetails_$uid.pdf' download='driverdetails_$uid.pdf'><i class='ri-download-line'></i>download pdf</a>";
        }

        if ($name) {
            $name = base64_decode($name);
        } else $name = '<i>unknwon</i>';

        echo "<tr>
                 <th scope='row' class='text-center'>$i</th>
                 <td>$name</td>
                 <td>$email <a href='mailto:$email' class='redi-btn'><i class='ri-mail-add-line'></i></a></td>
                 <td>$vehicleFileDownloadUri</td>
                 <td>$driverFileDownloadUri</td>
                 <td>$documentFileDownloadUri</td>
             </tr>";
    }

    if($i==0){
        echo "<div class='text-center fw-bold'>no driver applications currently</div>";
    }
}

?>

</tbody>
</table>