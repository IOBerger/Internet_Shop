<?php

include 'config.php';
session_start();

function AddItemToBucket($link,$itemID,$userID){

    $query = 'SELECT * FROM bucket WHERE item_id=' . $itemID.' AND user_id='.$userID;
    $result = mysqli_query($link, $query);
    if (!$result) {
        return 0;
    }
    $num_rows = mysqli_num_rows($result);
    if($num_rows==0){
        $query = "INSERT INTO bucket (item_id,user_id) VALUES ($itemID,$userID)";
        $result = mysqli_query($link, $query);
        if (!$result) {
            return 0;
        }
            
    }else{
        $query = "UPDATE bucket SET count=count+1 WHERE user_id=$userID AND item_id=$itemID";
        $result = mysqli_query($link, $query);
        if (!$result) {
            return 0;
        }
            

    }
    return 1;
}
$itemID=(int)$_GET['id'];
$userID=(int)$_SESSION['id'];
$result=AddItemToBucket($link,$itemID,$userID);

mysqli_close($link);

if($_GET['from']=='goods')
    $redirect=htmlspecialchars($_GET['from']).'.php?result='.$result;
if($_GET['from']=='view_good')
    $redirect=htmlspecialchars($_GET['from']).'.php?id='.$itemID.'&result='.$result;

    header('Location: '.$redirect);