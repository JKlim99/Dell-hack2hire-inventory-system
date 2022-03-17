<!DOCTYPE html>
<html lang="en">
@extends('Nev')
<style>
    .headerB{
        width : 100%;
        top: 0;
        padding : 20px;
    }

    .container{
        position: absolute;
        text-align : center;
        margin-top: 0.5ch;
        right: 0.5ch;
        background: #a4d4ff; 
        border-radius : 0.5ch;
        min-width: 84%;
        max-width: 84%;
        max-height: 99%;
        min-height: 99%;
       
    }

    .stock{
        margin:0.5ch;
        padding:0.5ch;
        border-radius: 1ch;
        bottom : 1ch
    }


</style>

<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

<!-- for pie chart -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.js"></script>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script> 
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="headerB">
                <i class="fa fa-cog"></i>
            </div>
        </div>
        <div class="row" style="height : 30ch;">
            <div class="col-md-4" style="">
                <canvas id="canvasA" ></canvas>
            </div>
            <div class="col-md-4" style="">
                <canvas id="canvasB"></canvas>
            </div>
            <div class="col-md-4" style="">
                <canvas id="canvasC"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col">
                <div class="stock" style="background:#f0f8ff";>
                    <p>Top 10 Stock In Product</p>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item</th>
                                <th scope="col">Stock In number</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">7</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">8</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">9</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">10</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                        </tbody>  
                    </table>
                </div>
            </div>

            <div class="col">
                <div class="stock" style="background:#fff0f1">
                <p>Top 10 Stock Out Product</p>
                <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item</th>
                                <th scope="col">Stock In number</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">4</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">5</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">6</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">7</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">8</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">9</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                            <tr>
                                <th scope="row">10</th>
                                <td>Minetal water 1l</td>
                                <td>250</td>
                            </tr>
                        </tbody>  
                    </table>
                </div>
            </div>
        </div>
    </div>
    

    
</body>
<!-- for barchart -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>

<script>
    // ----------------------------------------------------------------------
    // doughnut chart data
    <?php $x_axis = json_encode(['fish ball','cocacola','meatball']); ?>
    <?php $y_axis = json_encode(['2','4','6','8','10','12']); ?>

    var x_axis = <?php echo $x_axis; ?>;
    var y_axis = <?php echo $y_axis; ?>;
    var barChartData = {
        labels: x_axis,
        datasets: [{
            label: 'User',
            backgroundColor: "pink",
            data: y_axis
        }]
    };

    // ----------------------------------------------------------------------
    // bar chart data
    <?php $x_axisB = json_encode(['fish ball','cocacola','meatball']); ?>
    <?php $y_axisB = json_encode(['2','4','6','8']); ?>

    let x_axisB = <?php echo $x_axisB; ?>;
    let y_axisB = <?php echo $y_axisB; ?>;
    let barChartDataB = {
        labels: x_axisB,
        datasets: [{
            label: 'User',
            backgroundColor: "#fff0f1",
            data: y_axisB
        }]
    };


    // ----------------------------------------------------------------------
    // line chart data
    <?php $x_axisC = json_encode(['fish ball','cocacola','meatball']); ?>
    <?php $y_axisC = json_encode(['2','4','6','8']); ?>

    let x_axisC = <?php echo $x_axisC; ?>;
    let y_axisC = <?php echo $y_axisC; ?>;
    let barChartDataC = {
        labels: x_axisC,
        datasets: [{
            label: 'User',
            backgroundColor: "#fff0f1",
            data: y_axisC
        }]
    };


    // load chart
    window.onload = function() {
        let ctx = document.getElementById("canvasA").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'doughnut',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Stock condition'
                    }
                }
            });

        let ctxB = document.getElementById("canvasB").getContext("2d");
        window.myBar = new Chart(ctxB, {
            type: 'bar',
            data: barChartDataB,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Stock condition'
                }
            }
        });
        let ctxC = document.getElementById("canvasC").getContext("2d");
        window.myBar = new Chart(ctxC, {
            type: 'line',
            data: barChartDataC,
            options: {
                elements: {
                    rectangle: {
                        borderWidth: 2,
                        borderColor: '#c1c1c1',
                        borderSkipped: 'bottom'
                    }
                },
                responsive: true,
                title: {
                    display: true,
                    text: 'Stock condition'
                }
            }
        });

    };
</script>

</html>