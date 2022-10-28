<?php

// function check_login($con)
// {
//     print("CHECKING LOGIN");
//     print($_SESSION['user_id']);
//     if(isset($_SESSION['user_id']))     #checks if there is a 'user_id' inside session
//     {
//         print("found user id");
//         $id = $_SESSION['user_id'];
//         $query = "select * from users where user_id = '$id' limit 1";

//         $result =  mysqli_query($con, $query);
//         if($result && mysqli_num_rows($result) > 0)
//         {
//             print("returning user_data");
//             $user_data = mysqli_fetch_assoc($result);
//             return $user_data;
//         }
//         //redirect to login
//         header("Location: login.php");
//         die;
//     }
//     print("found nothing");
// }

?>


<?php

function check_login($con)
{

	if(isset($_SESSION['user_id']))
	{

		$id = $_SESSION['user_id'];
		$query = "select * from users where user_id = '$id' limit 1";

		$result = mysqli_query($con,$query);
		if($result && mysqli_num_rows($result) > 0)
		{

			$user_data = mysqli_fetch_assoc($result);
			return $user_data;
		}
	}

	//redirect to login
	header("Location: login.php");
	die;

}

function random_num($length)
{
	$text = "";
    $minimum_cap = 5;   
    if ($length < $minimum_cap)
    {
        $length = $minimum_cap;
    }

	$len = rand(4,$length);

	for ($i=0; $i < $len; $i++) { 
		$text .= rand(0,9);
	}

	return $text;
}