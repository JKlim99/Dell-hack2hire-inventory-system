<!DOCTYPE html>
<html lang="en">
@extends('Nev')
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

    tr{
        width : 33.3%;

    }
</style>

<body>
    <div class="headerB">
        <i class="fa fa-cog"></i>
    </div>

    <div class="SectionB">
        <table>
            <tr>
                <div class="graphA">
                    <canvas id="canvasA" height="300" width="200"></canvas>
                </div>
            </tr>

            <tr>
                <div class="graphB">
                <canvas id="canvasB" height="300" width="200"></canvas>
                </div>
            </tr>

            <tr>
                <div class="graphC">
                <canvas id="canvasC" height="300" width="200"></canvas>
                </div>
            </tr>
        </table>
    </div>

    <div class="SectionC">
        <table>
            <tr>
                <div class="StockInList">

                </div>
            </tr>
            <tr>
                <div class="StockOutList">

                </div>
            </tr>
        </table>
    </div>
    
</body>
</html>