<?php
    $title= "Order";
    include("../log/_header.php");

if(!isset($_SESSION["loginAdmin"])){
        $_SESSION["errorStr"]="Please log in";
        header("Location:../log/login.php");
        exit();
    }

    require_once "../../src/dbutils.php";
?>

<script>
    document.getElementById("url_customer").classList.remove("active");
    document.getElementById("url_room").classList.remove("active");
    document.getElementById("url_room_type").classList.remove("active");
    document.getElementById("url_order").classList.add("active");
</script>

<div class="container">
<div class="row">


    <div class="col-md-4 col-sm-12 panel-group">
        <div id="inform" class="alert">
            <strong><span class="glyphicon"></span><span></span></strong><span></span>
        </div>
        <!-- SEARCH CUSTOMER-->
        <div class="panel panel-info">
            <div class= "panel-heading"><h4><span class="glyphicon glyphicon-search"></span> Search order</h4></div>
            <div class= "panel-body">
                <form id="formFindOrder" name="formFindOrder" class="form-horizontal">
                    <div class="form-group">
                        <div class="radio control-label col-sm-4">
                            <label for="findById">
                                <input type="radio" id="findById" name="findBy" value="byId">ID:
                            </label>
                        </div>
                        <div class="col-sm-8">
                            <input type="text" class="form-control" name="byId" id="byId">
                        </div>
                    </div>


                    <div class="form-group">
                        <div class="radio control-label col-sm-4">
                        <label for="findByOther">
                            <input type="radio" id="findByOther" name="findBy" value="byOther">By other:
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byUserId">User ID: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byUserId" name="byUserId">
                                <option value="">-- All --</option>
                                <?php
                                    $temp= getData("select distinct user_id from book");
                                    foreach($temp as $obj){
                                        echo "<option value='".$obj->cols["user_id"]."'>".$obj->cols["user_id"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byRoomId">Room ID: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byRoomId" name="byRoomId">
                                <option value="">-- All --</option>
                                <?php
                                    $temp= getData("select distinct room_id from book");
                                    foreach($temp as $obj){
                                        echo "<option value='".$obj->cols["room_id"]."'>".$obj->cols["room_id"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byRoomType">Room type: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byRoomType" name="byRoomType">
                                <option value="">-- All --</option>
                                <?php
                                    $temp= getData("select type from room_type");
                                    foreach($temp as $obj){
                                        echo "<option value='".$obj->cols["type"]."'>".$obj->cols["type"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <link rel="stylesheet prefetch" href="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css">
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byBookDate">Booked date: </label>
                        </div>
                        <div class="col-sm-8">
                            <div  class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                              <input class="form-control" readonly type="text" id="byBookDate" name= 'byBookDate'>
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                           </div>
                        </div>
                        <!--<input type="hidden" id="dtp_input1" value="" /><br/>-->
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byBeginDate">Begin date: </label>
                        </div>
                        <div class="col-sm-8">
                            <div  class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                              <input class="form-control" readonly type="text" id="byBeginDate" name= 'byBeginDate'>
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                           </div>
                        </div>
                        <!--<input type="hidden" id="dtp_input1" value="" /><br/>-->
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byEndDate">End date: </label>
                        </div>
                        <div class="col-sm-8">
                               <div  class="input-group date datepicker" data-date-format="yyyy-mm-dd">
                              <input class="form-control" readonly type="text" id="byEndDate" name= 'byEndDate'>
                              <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span> 
                           </div>    
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byOrderType">Order type: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byOrderType" name="byOrderType">
                                <option value="">-- All --</option>
                                <?php
                                    $temp= getData("select distinct type from book");
                                    foreach($temp as $obj){
                                        echo "<option value='".$obj->cols["type"]."'>".$obj->cols["type"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-4">
                            <label for="byBeginTime">Range of fee: </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="control-label col-sm-2">
                            <p for="byLowFee">from </p>
                        </div>
                        <div class="col-sm-4">
                                    <input class="form-control" type="text" id="byLowFee" name= 'byLowFee'>
                        </div>
                        <div class="control-label col-sm-2">
                            <p for="byHighFee">to </p>
                        </div>
                        <div class="col-sm-4">
                                    <input class="form-control" type="text" id="byHighFee" name= 'byHighFee'>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-8">
                            <input type="submit" class="btn btn-info pull-right" value="Find">
                        </div>
                        <div class="col-sm-4">
                            <input type="reset" class="btn btn-default pull-right" id="resetFindForm" value="Reset">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        
    </div>

<!--ORDERS INFORMATION-->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<div class= "col-md-8 col-sm-12">
    <div class="panel panel-info">
        <div class="panel-heading">
            <div class="row">
                <div class="col-md-8">
                    <h4><span class="glyphicon glyphicon-th-list"></span> Orders information</h4>
                </div>
                <div class="col-md-4" style="">
                    <div class="form-group">
                        <div class="control-label col-sm-4" style="margin-top: 10px;">
                            <label for="byOrderState">State: </label>
                        </div>
                        <div class="col-sm-8">
                            <select class="form-control" id="byOrderState" name="byOrderState">
                                <option value="">-- All --</option>
                                <?php
                                    $temp= getData("select distinct state from book");
                                    foreach($temp as $obj){
                                        echo "<option value='".$obj->cols["state"]."'>".$obj->cols["state"]."</option>";
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel-body" style="overflow: scroll; max-height: 400px;">
            <table class="table table-striped table-hover table-bordered" id="orderInfo">
              <thead>
                <tr>
                  <th>ID</th>
                  <th>User ID</th>
                  <th>Room ID</th>
                  <th>Room type</th>
                  <th>Book time</th>
                  <th>Begin time</th>
                  <th>End time</th>
                  <th>Order type</th>
                  <th>Fee ($)</th>
                </tr>
              </thead>
              <tbody>
              </tbody>
            </table>
        </div>
    </div>
</div>

<!--BILL POPUP-->
<div class="modal fade" id="billPopup" role="dialog">
    <div class="modal-dialog" style="width:400px;">
    <!-- Modal content-->
    <div class="modal-content">

        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title">Bill</h4>
        </div>

        <div class="modal-body">
            <table class="table table-striped">
                <thead>
                    <tr><th>Room ID: </th><td id="roomId"></td></tr>
                    <tr><th>Room type: </th><td id="roomType"></td></tr>
                    <tr><th>Begin time: </th><td id="beginTime"></td></tr>
                    <tr><th>End time: </th><td id="endTime"></td></tr>
                    <tr><th>Order type: </th><td id="orderType"></td></tr>
                    <tr><th>Hour price: </th><td id="hourPrice"></td></tr>
                    <tr><th>Day price: </th><td id="dayPrice"></td></tr>
                    <tr><th>Unit price: </th><td id="unitPrice"></td></tr>

                    <tr><th>Number of days: </th><td id="days"></td></tr>
                    <tr><th>Number of hours: </th><td id="hours"></td></tr>

                    <tr><th>Fee: </th><td id="fee"></td></tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>
    </div>
</div>


</div>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="http://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.16.0/jquery.validate.min.js"></script>
<!--Confirmation js-->
<script src="../../bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

<script src="order.js"></script>

<?php
    include("../log/_footer.php");
?>