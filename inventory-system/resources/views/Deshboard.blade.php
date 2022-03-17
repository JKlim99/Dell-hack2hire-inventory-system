<!DOCTYPE html>
<html lang="en">
<!-- @extends('Nev') -->
<style>
    .headerB{
        float : right;
        width : 83.5%;
        top: 0;
        padding : 20px;
        background : blue;
    }


    .SectionB{
        /* position: fixed; f0f8ff */
        float : right;
        width : 83.5%;
        background:red; 
        left : 0;
        padding : 1ch;
        border-radius : 0.5ch;
        height : 100%;
    }

</style>

    

<body>
    <div class="headerB">
        <i class="fa fa-cog"></i>
    </div>

    <div class="container">
        <div class="row">
            <div class="col" style="background:red;">
                <canvas id="canvasA" height="300" width="200"></canvas>
            </div>
            <div class="col" style="background:green;">
                <canvas id="canvasA" height="300" width="200"></canvas>
            </div>
            <div class="col" style="background:red;">
                <canvas id="canvasA" height="300" width="200"></canvas>
            </div>
        </div>

        <div class="row">
            <div class="col" style="background:yellow";>
                <div class="StockInList">
            </div>

            <div class="col" style="background:yellow">
            <div class="StockOutList">
            </div>
        </div>


    </div>
    

    <div class="SectionC">
        <table>
            <tr>
                

                </div>
            </tr>
            <tr>
                

                </div>
            </tr>
        </table>
    </div>
    
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"></script>
<script>
    var x_axis = <?php echo 'fish ball','cocacola','meatball'; ?>;
    var user = <?php echo '2','4','6','8','10','12'; ?>;
    var barChartData = {
        labels: year,
        datasets: [{
            label: 'User',
            backgroundColor: "pink",
            data: user
        }]
    };

    window.onload = function() {
        var ctx = document.getElementById("canvasA").getContext("2d");
        window.myBar = new Chart(ctx, {
            type: 'bar',
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
                    text: 'Yearly User Joined'
                }
            }
        });
    };
</script>

</html>