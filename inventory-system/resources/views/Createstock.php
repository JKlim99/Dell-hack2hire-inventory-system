<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
    <!-- jQuery Custom Scroller CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
    
    <!-- Scrollbar Custom CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
</head>

<style>
body {
    font-family: 'Poppins', sans-serif;
    background: #fafafa;
}

p {
    font-family: 'Poppins', sans-serif;
    font-size: 1.1em;
    font-weight: 300;
    line-height: 1.7em;
    color: #999;
}

a, a:hover, a:focus {
    color: inherit;
    text-decoration: none;
    transition: all 0.3s;
}
.wrapper {
    display: flex;
    align-items: stretch;
    
}

#sidebar {
    position: fixed;
    min-width: 15%;
    max-width: 15%;
    height: 100ch;
    top: 0;
    left: 0;
    background: #7386D5;
    color: #fff;
    transition: all 0.3s;
}

#sidebar .sidebar-header {
    padding: 20px;
    background: #6d7fcc;
}

#sidebar ul.components {
    padding: 20px 0;
    border-bottom: 1px solid #47748b;
}

#sidebar ul p {
    color: #fff;
    padding: 10px;
}

#sidebar ul li a {
    padding: 10px;
    font-size: 1.1em;
    display: block;
}
#sidebar ul li a:hover {
    color: #7386D5;
    background: #fff;
}

#sidebar ul li.active > a, a[aria-expanded="true"] {
    color: #fff;
    background: #6d7fcc;
}
ul ul a {
    font-size: 0.9em !important;
    padding-left: 30px !important;
    background: #6d7fcc;
}

#sidebar.active {
    min-width: 80px;
    max-width: 80px;
    text-align: center;
}

a[data-toggle="collapse"] {
    position: relative;
}

.dropdown-toggle::after {
    display: block;
    position: absolute;
    top: 50%;
    right: 20px;
    transform: translateY(-50%);
}

@media (max-width: 768px) {
    #sidebar {
        margin-left: 15%;
    }
    #sidebar.active {
        margin-left: 0;
    }
}
/* ----------------------------------------------- */
.wrapper {
    display: block;
}





#dismiss {
    width: 35px;
    height: 35px;
    position: absolute;
    /* top right corner of the sidebar */
    top: 10px;
    right: 10px;
}
/* --------------------------------------------------- */
</style>



<script type="text/javascript">
    $(document).ready(function () {

        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function () {
            $('#sidebar').toggleClass('active');
        });

    });

    $(document).ready(function () {

        $("#sidebar").mCustomScrollbar({
            theme: "minimal"
        });

        $('#sidebarCollapse').on('click', function () {
            // open or close navbar
            $('#sidebar').toggleClass('active');
            // close dropdowns
            $('.collapse.in').toggleClass('in');
            // and also adjust aria-expanded attributes we use for the open/closed arrows
            // in our CSS
            $('a[aria-expanded=true]').attr('aria-expanded', 'false');
        });

    });



</script>


<body>

    <div class="wrapper">
        <!-- Sidebar -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3>Uncalled Four</h3>
            </div>

            <ul class="list-unstyled components">
                <li>
                    <a href="#">Dashboard</a>
                </li>
            
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Product Manage</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Product Detail</a>
                        </li>
                        <li>
                            <a href="#">Product Register</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Email</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Email Detail</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Inventory Management</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Inventory customize</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">User Management</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">User List</a>
                        </li>
                    </ul>
                </li>
                
                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">User Management</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">User List</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Stock Edit</a>
                    <ul class="collapse list-unstyled" id="pageSubmenu">
                        <li>
                            <a href="#">Product Edit</a>
                        </li>
                    </ul>
                </li>

                <li>
                    <a href="#">Logout</a>
                </li>
            </ul>
        </nav>
    </div>

    <div id="content">
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container-fluid">

                <button type="button" id="sidebarCollapse" class="btn btn-info">
                    <i class="fas fa-align-left"></i>
                    <span>Toggle Sidebar</span>
                </button>

            </div>
        </nav>
    </div>


</body>


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
        left : 0;
        padding : 1ch;
        border-radius : 0.5ch;
        height : 100%;
    }

    tr{
        width : 33.3%;

    }

    .col-15 {
    float: left;
    width: 15%;
    margin-top: 6px;
    }

    .col-85 {
    float: left;
    width: 85%;
    margin-top: 6px;
    }


    input[type=submit] {
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: left;
    margin-top: 10px;
    }
</style>

<body>
    <div class="headerB">
        <i class="fa fa-cog"></i>
    </div>

    <div class="SectionB">

    <div class="card">
    <div class="card-header">
      <h1 class="card-title">Stock Create</h1>
    </div>

    <div class="card-body">
        <form action="/action_page.php" method="post" target="_blank">
            <div class = "col-15">
            <label for="product-id">Product Id</label>
            </div>  
            <div class = "col-85">
            <input type="text" id="product-id" name="product-id"><br>
            </div>  
            <div class = "col-15">
            <label for="product-name">Product Name</label>
            </div>  
            <div class = "col-85">
            <input type="text" id="product-name" name="product-name"><br>
            </div>  
            <div class = "col-15">
            <label for="current-stock-quantity">Current Stock Quantity</label>
            </div>  
            <div class = "col-85">
            <input type="number" id="current-stock-quantity" name="current-stock-quantity"><br>
            </div>  
            <div class = "col-15">
            <label for="unit-price">Unit Price</label>
            </div>  
            <div class = "col-85">
            <input type="number" id="unit-price" name="unit-price"><br>
            </div>  
            <div class = "col-15">
            <label for="total-price">Total Price</label>
            </div>  
            <div class = "col-85">
            <input type="number" id="total-price" name="total-price"><br>
            </div>  
            <div class = "col-15">
            <label for="type">Type</label>    
            </div>  
            <div class = "col-85">
            <select name="type" id="type">
              <option value="stock-in">Stock in</option>
              <option value="stock-out">Stock out</option>
            </select>
            <br>
            </div>
            <input type="submit" value="Create">
          </form>
    </div>  
</div>   
</body>
