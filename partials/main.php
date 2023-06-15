<?php

// Please add your logic here

$open_json = file_get_contents("dataset/users.json",true);

if($open_json == false){
    echo "<h1 class='starting-title'>Not working!</h1>";
}
//Name input | Username input | Email input | Address input | Phone Input | Company Input | SUBMIT BUTTON
$decode = json_decode($open_json, true);
echo "
    <form method='post' class='add'>
        <label for='name'>Name</label>
        <input type='text' name='name' ></br>

        <label for='username'>Username</label>
        <input type='text' name='username'></br>

        <label for='email'>Email</label>
        <input type='email' name='email'></br>

        <label for='street'>Street</label>
        <input type='text' name='street'></br>

        <label for='suite'>Suite</label>
        <input type='text' name='suite'></br>

        <label for='city'>City</label>
        <input type='text' name='city'></br>

        <label for='zipcode'>zipcode</label>
        <input type='text' name='zipcode'></br>

        <label for='phone'>Phone</label>
        <input type='number' name='phone'></br>

        <label for='cname'>Company Name</label>
        <input type='text' name='cname'></br>
        <input type='hidden' name='add'>
        <input type='submit' value='add'></br>
    </form>
";
if(isset($_POST["add"])){
    $add_data = json_decode($open_json, true);
    $new_id = count($add_data);

    $name = $_POST["name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $street = $_POST["street"];
    $city = $_POST["city"];
    $zipcode = $_POST["zipcode"];
    $phone = $_POST["phone"];
    $cname = $_POST["cname"];

    $add_data[$new_id]['id'] = $new_id+1;
    $add_data[$new_id]['name'] = $name;
    $add_data[$new_id]['username'] = $username;
    $add_data[$new_id]['email'] = $email;
    $add_data[$new_id]['address']['street'] = $street;
    $add_data[$new_id]['address']['city'] = $city;
    $add_data[$new_id]['address']['zipcode'] = $zipcode;
    $add_data[$new_id]['phone'] = $phone;
    $add_data[$new_id]["company"]['name'] =$cname;



    $encode_data = json_encode($add_data);
    file_put_contents("dataset/users.json",$encode_data);
    echo "<meta http-equiv='refresh' content='0'>";
}
else{

}
echo "
<h2>Table</h2>
<table>
        <tr>
            <th>Name</th>
            <th>Username</th>
            <th>Email</th>
            <th>Address</th>
            <th>Phone</th>
            <th>Company</th>
            <th></th>
        </tr>";
foreach($decode as $open_json){
    $id = $open_json["id"]-1;
    $name = $open_json["name"];
    $username = $open_json["username"];
    $mail = $open_json["email"];
    $address = $open_json["address"];
    $phone = $open_json["phone"];
    $company = $open_json["company"];
    echo "<tr>
            <td>".$name."</td>
            <td>".$username."</td>
            <td>".$mail."</td>
            <td>".$address["street"].", ".$address["zipcode"]."</br> ".$address["city"]."</td>
            <td>".$phone."</td>
            <td>".$company["name"]."</td>
            <td>
            <form  method='post'>
                <input type='hidden' name='el' value='$id'>
                <input type='submit' value='delete'>
            </form>
            </td>
        </tr>";
}
echo"</table>";
if (isset($_POST['el'])) {
    $key = $_POST['el'];
        unset($decode[$key]);
        file_put_contents("dataset/users.json",json_encode($decode));
        echo "<meta http-equiv='refresh' content='0'>";
}
