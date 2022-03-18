<!DOCTYPE html>
<html lang="en">
@extends('Nev')
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


</head>

<style>
    .headerB{
        width : 100%;
        top: 0;
        padding : 20px;
    }

    .headerB .location{
        text-align : left;
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
        background:#f0f8ff;
    }

    .table_container{
        background: #ffee9a;
        padding: 4ch;
        border-radius: 1ch;
    }

    table{
        width:100%;
        text-align:left;
               
    }

    .right{
        width: 85%;
    }

    .blank_row{
        height: 30px;
    }
</style>

<body>
    <div class="container">
        <div class="headerB">
            <p class="location">My Workspace > Email > Email Detail</p>
        </div>

        <div class="table_container">

        
        <table>
            <tr>
                <td colspan ="2" style=""><h2>Update 2 products</h2></td>
                
            </tr>

            <tr class="blank_row">
                <td colspan="2"> </td>
            </tr>

            <tr>
                <td><h5>Sender :</h5></td>
                <td class="right"><h5>abcd@1234.com</h5></td>
            </tr>

            <tr>
                <td><h5>Receiver :</h5></td>
                <td class="right"><h5>Abcd@1234.com</h5></td>
            </tr>

            <tr>
                <td colspan ="2"><span>22 Mar 22, 22:22</span></td>
            </tr>

            <tr>
                <td colspan = "2"><a target="_blank" href=(file.uri)>file.name</a></td>
            </tr>
            <tr>
                <td colspan = "2">
                    <article>
                        <p>This email aim to add dish ball 400g with 50 units and 100 plus 500ml with 96 unitsw eqrweftrrfe wargvegb hvrtbhrst hbrtgh br st ghbdty gfjntyj kmyukiu yl,tyjrt.</p>
                    </article>
                </td>
            </tr>
        </table>
        </div>
    </div>

</body>
</html>