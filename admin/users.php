<?php

$qry = mysqli_query($conn, 'SELECT * FROM users');
if (!$qry or !mysqli_num_rows($qry)) {
    echo "<div class='text-center fw-bold'>no users currently</div>";
} else {
    echo "<table class='table table-bordered table-dark'>
             <legend>Users: </legend>
            <thead>
                <tr>
                    <th scope='col' class='text-center'>#</th>
                    <th scope='col'>name</th>
                    <th scope='col' colspan='2'>email addres</th>
                <tr>
            </thead>
            <tbody>";

    $i = 1;
    while($row = mysqli_fetch_assoc($qry)){
        $name = $row['uname'];
        $email = base64_decode($row['uemail']);

        if($name){
            $name = base64_decode($name);
        } else $name = '<i>unknwon</i>';

        echo "<tr>
                 <th scope='row' class='text-center'>$i</th>
                 <td>$name</td>
                 <td colspan='2'>$email <a href='mailto:$email' class='redi-btn'><i class='ri-mail-add-line'></i></a></td>
             </tr>";
        $i++;
    }
}

?>




    
    
</tbody>
</table>