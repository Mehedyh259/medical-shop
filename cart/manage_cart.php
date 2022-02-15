<?php
include('../include/conn.php');

if($_SERVER["REQUEST_METHOD"]=="POST"){

	if(isset($_POST['addToCart'])){

		if(isset($_SESSION['cart'])){

			$itemNames = array_column($_SESSION['cart'], 'Item_Name');
			$itemUnits = array_column($_SESSION['cart'], 'Item_Unit');

			if(in_array($_POST['Item_Name'], $itemNames) && in_array($_POST['Item_Unit'], $itemUnits)){
				echo "<script>
					alert('Item Already Selected');
					window.location.href='../inventories';
				</script>";
				
			}
			else{
				$count = count($_SESSION['cart']);
				$_SESSION['cart'][$count] = array(
					'ItemId'=>$_POST['id'],
					'Image'=>$_POST['Image'],
					'Item_Name'=> $_POST['Item_Name'],
					'Item_Unit'=>$_POST['Item_Unit'],
					'ItemQuantity'=>$_POST['ItemQuantity'],
					'Price'=>$_POST['Price'],
					'Quantity'=>1
				);
				echo "<script>
					window.location.href='../inventories';
				</script>";
			}	

		}
		else{
			$_SESSION['cart'][0] = array(
					'ItemId'=>$_POST['id'],
					'Image'=>$_POST['Image'],
					'Item_Name'=> $_POST['Item_Name'],
					'Item_Unit'=>$_POST['Item_Unit'],
					'ItemQuantity'=>$_POST['ItemQuantity'],
					'Price'=>$_POST['Price'],
					'Quantity'=>1
			);
			echo "<script>
					window.location.href='../inventories';
				</script>";
			
		}
		
		
	}

	if(isset($_POST['Remove_Item'])){
		foreach ($_SESSION['cart'] as $key => $value) {
			if($value['Item_Name']==$_POST['Item_Name'] && $value['Item_Unit']==$_POST['Item_Unit']){
				unset($_SESSION['cart'][$key]);
			}
			
		}
		$_SESSION['cart']=array_values($_SESSION['cart']);
		echo "<script>
					
					window.location.href='../billing';
			</script>";
	}


	if(isset($_POST['Mod_Quantity'])){
		foreach ($_SESSION['cart'] as $key => $value) {
			if($value['Item_Name']==$_POST['Item_Name'] && $value['Item_Unit']==$_POST['Item_Unit']){
				
				$_SESSION['cart'][$key]['Quantity']=$_POST['Mod_Quantity'];
			}	
		}
		
		echo "<script>	
				window.location.href='../billing';
			</script>";
	
	}

}




?>