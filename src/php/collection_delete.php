<script>
    function clearVal(intro){
        console.log(intro)
        console.log("-------------------")

        var id=document.getElementById(intro)
        console.log(id.innerText)
      //  if(id){
        id.remove()
      //  }
    }
</script>
<?php
@$list_id = $_POST["listID"];
@$show_id = $_POST["showID"];
echo "<script>console.log('$list_id');</script>";
if ($list_id) {
   echo "<script>clearVal('$show_id');</script>";
    $sql = "DELETE FROM `wishlist` WHERE `wishlist`.`listID` = '$list_id'";
   if ($conn->query($sql) === TRUE) {
       //echo '<script>alert(\'删除成功\')</script>';

   }
}