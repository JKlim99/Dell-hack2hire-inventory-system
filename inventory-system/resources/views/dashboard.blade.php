<!DOCTYPE html>
<html lang="en">
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
@include('public')
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
                <div class="stock shadow-sm" style="background:#f0f8ff";>
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
                            <?php $index = 1;?>
                            @foreach($top10StockIn as $item)
                            <tr>
                                <th scope="row">{{$index}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->stock}}</td>
                            </tr>
                            <?php $index++;?>
                            @endforeach
                        </tbody>  
                    </table>
                </div>
            </div>

            <div class="col">
                <div class="stock shadow-sm" style="background:#fff0f1">
                <p>Top 10 Stock Out Product</p>
                <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Item</th>
                                <th scope="col">Stock Out number</th>
                            </tr>
                        </thead> 
                        <tbody>
                            <?php $index = 1;?>
                            @foreach($top10StockOut as $item)
                            <tr>
                                <th scope="row">{{$index}}</th>
                                <td>{{$item->name}}</td>
                                <td>{{$item->stock*-1}}</td>
                            </tr>
                            <?php $index++;?>
                            @endforeach
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
    <?php $x_axis = json_encode($top10StockIn->pluck('name')); ?>
    <?php $y_axis = json_encode($top10StockIn->pluck('stock')); ?>

    var x_axis = <?php echo $x_axis; ?>;
    var y_axis = <?php echo $y_axis; ?>;
    var barChartData = {
        labels: x_axis,
        datasets: [{
            label: 'Product',
            backgroundColor: ["red","blue","yellow","green","grey","purple"],
            data: y_axis
        }]
    };

    // ----------------------------------------------------------------------
    // bar chart data
    <?php $x_axisB = json_encode($top10StockOut->pluck('name')); ?>
    <?php
    $stocks = $top10StockOut->pluck('stock');
    for($i=0; $i<count($stocks); $i++){
        $stocks[$i] = $stocks[$i] * -1;
    }
    $y_axisB = json_encode($stocks); 
    ?>

    let x_axisB = <?php echo $x_axisB; ?>;
    let y_axisB = <?php echo $y_axisB; ?>;
    let barChartDataB = {
        labels: x_axisB,
        datasets: [{
            label: 'Product',
            backgroundColor: ["red","blue","yellow","green","grey","purple"],
            data: y_axisB
        }]
    };


    // ----------------------------------------------------------------------
    // line chart data
    <?php $x_axisC = json_encode($top10Stock->pluck('name')); ?>
    <?php $y_axisC = json_encode($top10Stock->pluck('stock')); ?>

    let x_axisC = <?php echo $x_axisC; ?>;
    let y_axisC = <?php echo $y_axisC; ?>;
    let barChartDataC = {
        labels: x_axisC,
        datasets: [{
            label: 'Product',
            backgroundColor: ["red","blue","yellow","green","grey","purple"],
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
                        text: 'Top 10 Stock In Product'
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
                    text: 'Top 10 Stock Out Product'
                }
            }
        });
        let ctxC = document.getElementById("canvasC").getContext("2d");
        window.myBar = new Chart(ctxC, {
            type: 'bar',
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
                    text: 'Top 10 Product Stock Count'
                }
            }
        });

    };
</script>

</html>