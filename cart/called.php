<?php 
session_start();

if (isset($_REQUEST['q'])) 
{
    if ($_REQUEST['q'] == 'addtobill') 
    {
        $id = $_REQUEST['id'];
        $array = $con->query("select * from inventory where id = '$id'");
        $row = $array->fetch_assoc();
        $name = $row['itemName'];
        $price = $row['itemPrice'];
        $qty = '1';
        $item = array(
            'id' => $id,
            'name' => $name,
            'price' => $price,
            'qty' => $qty
        );

        array_push($_SESSION['bill'],$item);
        print_r($_SESSION['bill']);
    }
}
if (isset($_GET['remove'])) 
{
    $id = $_GET['remove'];
    foreach ($_SESSION['bill'] as $key => $value) 
    {
        if($_SESSION['bill'][$key]['id'] == $id){
            unset($_SESSION['bill'][$key]);
            break;
        } 
    }
    header("location:billing.php");
}
echo $_SESSION['bill'][2]['id'];
echo "<pre>";
print_r($_SESSION['bill']);
?>