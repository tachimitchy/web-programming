<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Tuition Fee Calculator</title>

<style>
body{
    font-family: Arial, Helvetica, sans-serif;
    background:#f4f6f9;
    margin:0;
    padding:30px;
}

.container{
    width:800px;
    margin:auto;
    background:#fff;
    padding:25px;
    border-radius:10px;
    box-shadow:0 0 10px rgba(0,0,0,.2);
}

h2{
    text-align:center;
    color:#1565c0;
}

label{
    font-weight:bold;
}

input, select{
    width:100%;
    padding:10px;
    margin-top:5px;
    margin-bottom:15px;
    border:1px solid #ccc;
    border-radius:5px;
    box-sizing:border-box;
}

button{
    width:100%;
    padding:12px;
    background:#1565c0;
    color:white;
    border:none;
    border-radius:5px;
    font-size:16px;
    cursor:pointer;
}

button:hover{
    background:#0d47a1;
}

table{
    width:100%;
    margin-top:20px;
    border-collapse:collapse;
}

table, th, td{
    border:1px solid #ccc;
}

th{
    background:#1565c0;
    color:white;
    padding:10px;
}

td{
    padding:10px;
}
</style>

</head>
<body>

<div class="container">

<h2>Tuition Fee Calculator</h2>

<form method ="POST">
    <label>Student Name</label>
    <input type="text" name="name" required>

    <label>Total Tuition Fee</label>
    <input type="number" name="tuition" required>

    <label>Discount</label>
    <select name="discount" required>
        <option value="">-- Select Discount --</option>
        <option value="10">10%</option>
        <option value="20">20%</option>
        <option value="50">50%</option>
        <option value="100">100%</option>
    </select>

    <label>Months to Pay</label>
    <input type="number" name="months" min="1" required>

    <button type="submit" name="compute">
        Compute Tuition
    </button>
</form>

<?Php
    if(isset($_POST["compute"])){
        $name = $_POST["name"];
        $tuition = $_POST["tuition"];
        $discount = $_POST["discount"];
        $months = $_POST["months"]; 
        //COMPUTATION
        $amount = $discount * 0.01;
        $discountamount = $amount * $tuition;
        $balance = $tuition - $discountamount;
        $mpayment = $balance / $months;
        //CONDITION FOR DISCOUNT
        if($mpayment >= 10000){
            $paystat = "High Monthly Payment";
        }
        elseif($mpayment >= 5000){
            $paystat = "Moderate Monthly Payment";
        }
        else{
            $paystat = "Affordable Monthly Payment";
        }
?>
    <table>

<tr>
    <th colspan="2">Salary Summary</th>
</tr>

<tr>
    <td>Student Name</td>
    <td><?php echo $name; ?></td>
</tr>

<tr>
    <td>Total Tuition Fee</td>
    <td>₱<?php echo number_format($tuition,2); ?></td>
</tr>

<tr>
    <td>Discount Rate</td>
    <td><?php echo "$discount%"; ?></td>
</tr>

<tr>
    <td>Discount Amount</td>
    <td style = "color:green;">₱<?php echo number_format($discountamount,2); ?></td>
</tr>

<tr>
    <td>Balance After Discount</td>
    <td>₱<?php echo number_format($balance,2); ?></td>
</tr>

<tr>
    <td>Months to Pay</td>
    <td><?php echo "$months Month(s)"; ?></td>
</tr>

<tr>
    <td><strong>Monthly Payment</strong></td>
    <td><strong>₱<?php echo number_format($mpayment,2) ?></strong></td>
</tr>
<tr>
    <td><strong>Payment Status</strong></td>
    <td style = "color:green;"<strong><?php echo $paystat ?></strong></td>
</tr>
</table>


</div>
<?php
    }
?>

</body>
</html>